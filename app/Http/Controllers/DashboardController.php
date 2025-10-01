<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Fecha;
use App\Models\Curso;
use App\Models\Materia;
use App\Models\Usuario;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $eventos = Evento::orderBy('fecha', 'desc')->get();
        $fechas = Fecha::orderBy('fecha', 'asc')->get();

        if ($user->isAdmin()) {
            $totalEstudiantes = Usuario::where('idRol', 3)->count();
            $totalProfesores = Usuario::where('idRol', 2)->count();
            $totalCursos = Curso::count();
            $totalMaterias = Materia::count();

            return view('dashboard.admin.index', compact(
                'eventos',
                'fechas',
                'totalEstudiantes',
                'totalProfesores',
                'totalCursos',
                'totalMaterias'
            ));
        }

        if ($user->isProfesor()) {
            $materias = $user->materiasComoProfesor()->with('curso')->get();
            $cursosGuia = $user->cursosComoGuia()->with('curso')->get();

            return view('dashboard.profesor.index', compact(
                'eventos',
                'fechas',
                'materias',
                'cursosGuia'
            ));
        }

        if ($user->isEstudiante()) {
            $materias = Materia::where('curso', $user->seccion)
                ->with('profesor')
                ->get();

            return view('dashboard.estudiante.index', compact(
                'eventos',
                'fechas',
                'materias'
            ));
        }

        return view('dashboard.index', compact('eventos', 'fechas'));
    }

    public function estudiante()
    {
        return $this->index();
    }
}

