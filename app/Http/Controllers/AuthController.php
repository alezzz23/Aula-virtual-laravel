<?php

namespace App\Http\Controllers;

use App\Models\UserSession;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLoginForm()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'usuario' => 'required|string',
            'password' => 'required|string',
        ]);

        // Intentar autenticar con el campo 'usuario' en lugar de 'email'
        if (Auth::attempt(['usuario' => $credentials['usuario'], 'password' => $credentials['password']])) {
            $request->session()->regenerate();

            // Registrar la sesión
            UserSession::create([
                'userId' => Auth::id(),
                'userRole' => Auth::user()->role->descripcion,
                'login_time' => now(),
            ]);

            // Redirigir según el rol
            return $this->redirectByRole();
        }

        return back()->withErrors([
            'usuario' => 'Las credenciales no coinciden con nuestros registros.',
        ])->withInput($request->only('usuario'));
    }

    protected function redirectByRole()
    {
        $user = Auth::user();
        
        if ($user->isAdmin() || $user->isProfesor() || $user->isCoordinador()) {
            return redirect()->route('dashboard');
        }

        if ($user->isEstudiante()) {
            return redirect()->route('dashboard.estudiante');
        }

        return redirect()->route('dashboard');
    }

    public function logout(Request $request)
    {
        // Actualizar la sesión con el tiempo de salida
        $lastSession = UserSession::where('userId', Auth::id())
            ->whereNull('logout_time')
            ->latest()
            ->first();

        if ($lastSession) {
            $lastSession->update(['logout_time' => now()]);
        }

        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect()->route('login');
    }
}

