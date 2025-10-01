<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\Role;
use App\Models\Curso;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsuarioController extends Controller
{
    public function index()
    {
        $usuarios = Usuario::with(['role', 'curso'])->get();
        return view('dashboard.usuarios.index', compact('usuarios'));
    }

    public function estudiantes()
    {
        $estudiantes = Usuario::where('idRol', 3)->with('curso')->get();
        return view('dashboard.usuarios.estudiantes', compact('estudiantes'));
    }

    public function profesores()
    {
        $profesores = Usuario::where('idRol', 2)->get();
        return view('dashboard.usuarios.profesores', compact('profesores'));
    }

    public function docentes()
    {
        $docentes = Usuario::whereIn('idRol', [2, 4, 5])->with('role')->get();
        return view('dashboard.usuarios.docentes', compact('docentes'));
    }

    public function create()
    {
        $roles = Role::all();
        $cursos = Curso::where('estado', 1)->get();

        return view('dashboard.usuarios.create', compact('roles', 'cursos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'usuario' => 'required|string|max:50|unique:usuarios',
            'namefull' => 'nullable|string|max:70',
            'cedula' => 'required|string|max:12',
            'sexo' => 'nullable|in:M,F',
            'fecha_nacimiento' => 'nullable|date',
            'password' => 'required|string|min:6',
            'correo' => 'required|email|max:70',
            'telefono' => 'required|string|max:12',
            'idRol' => 'required|exists:roles,id',
            'seccion' => 'nullable|exists:cursos,id',
            'enviar_tareas' => 'nullable|boolean',
            'ver_notas' => 'nullable|boolean',
        ]);

        $data = $request->all();
        $data['password'] = Hash::make($request->password);
        $data['enviar_tareas'] = $request->has('enviar_tareas') ? 1 : 0;
        $data['ver_notas'] = $request->has('ver_notas') ? 1 : 0;

        Usuario::create($data);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario creado exitosamente.');
    }

    public function show(Usuario $usuario)
    {
        $usuario->load(['role', 'curso', 'notas.materia', 'asistencias.materia']);
        return view('dashboard.usuarios.show', compact('usuario'));
    }

    public function edit(Usuario $usuario)
    {
        $roles = Role::all();
        $cursos = Curso::where('estado', 1)->get();

        return view('dashboard.usuarios.edit', compact('usuario', 'roles', 'cursos'));
    }

    public function update(Request $request, Usuario $usuario)
    {
        $request->validate([
            'usuario' => 'required|string|max:50|unique:usuarios,usuario,' . $usuario->id,
            'namefull' => 'nullable|string|max:70',
            'cedula' => 'required|string|max:12',
            'sexo' => 'nullable|in:M,F',
            'fecha_nacimiento' => 'nullable|date',
            'correo' => 'required|email|max:70',
            'telefono' => 'required|string|max:12',
            'idRol' => 'required|exists:roles,id',
            'seccion' => 'nullable|exists:cursos,id',
            'enviar_tareas' => 'nullable|boolean',
            'ver_notas' => 'nullable|boolean',
            'estado' => 'required|in:Activo,Inactivo',
        ]);

        $data = $request->except('password');
        $data['enviar_tareas'] = $request->has('enviar_tareas') ? 1 : 0;
        $data['ver_notas'] = $request->has('ver_notas') ? 1 : 0;

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $usuario->update($data);

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario actualizado exitosamente.');
    }

    public function destroy(Usuario $usuario)
    {
        $usuario->delete();

        return redirect()->route('usuarios.index')
            ->with('success', 'Usuario eliminado exitosamente.');
    }
}

