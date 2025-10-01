<?php

namespace App\Http\Controllers;

use App\Models\Asistencia;
use App\Models\Curso;
use App\Models\Materia;
use App\Models\Usuario;
use Illuminate\Http\Request;

class AsistenciaController extends Controller
{
    public function index()
    {
        $cursos = Curso::with('materias')->get();
        return view('dashboard.asistencia.index', compact('cursos'));
    }

    public function porCurso(Curso $curso)
    {
        $materias = $curso->materias;
        return view('dashboard.asistencia.curso', compact('curso', 'materias'));
    }

    public function porMateria(Materia $materia)
    {
        $alumnos = Usuario::where('seccion', $materia->curso)
            ->where('idRol', 3)
            ->get();

        $ultimoRegistro = Asistencia::where('materia_id', $materia->id)
            ->max('registro') ?? 0;

        return view('dashboard.asistencia.materia', compact('materia', 'alumnos', 'ultimoRegistro'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'materia_id' => 'required|exists:materias,id',
            'alumnos' => 'required|array',
            'alumnos.*.usuario_id' => 'required|exists:usuarios,id',
            'alumnos.*.asistencia' => 'required|boolean',
            'alumnos.*.comentario' => 'nullable|string',
        ]);

        $materia = Materia::findOrFail($request->materia_id);
        $registro = Asistencia::where('materia_id', $materia->id)->max('registro') ?? 0;
        $nuevoRegistro = $registro + 1;

        foreach ($request->alumnos as $alumnoData) {
            Asistencia::create([
                'usuario_id' => $alumnoData['usuario_id'],
                'curso_id' => $materia->curso,
                'materia_id' => $materia->id,
                'registro' => $nuevoRegistro,
                'asistencia' => $alumnoData['asistencia'],
                'comentario' => $alumnoData['comentario'] ?? null,
                'fecha' => now(),
            ]);
        }

        return redirect()->route('asistencia.materia', $materia)
            ->with('success', 'Asistencia registrada exitosamente.');
    }

    public function ver(Materia $materia)
    {
        $asistencias = Asistencia::where('materia_id', $materia->id)
            ->with('usuario')
            ->orderBy('registro')
            ->orderBy('fecha')
            ->get()
            ->groupBy('registro');

        return view('dashboard.asistencia.ver', compact('materia', 'asistencias'));
    }

    public function editar(Request $request, Asistencia $asistencia)
    {
        $request->validate([
            'asistencia' => 'required|boolean',
            'comentario' => 'nullable|string',
        ]);

        $asistencia->update($request->only(['asistencia', 'comentario']));

        return back()->with('success', 'Asistencia actualizada exitosamente.');
    }

    public function eliminar(Asistencia $asistencia)
    {
        $asistencia->delete();

        return back()->with('success', 'Asistencia eliminada exitosamente.');
    }

    public function reportePorAlumno(Usuario $alumno)
    {
        $asistencias = Asistencia::where('usuario_id', $alumno->id)
            ->with(['materia', 'curso'])
            ->orderBy('fecha', 'desc')
            ->get();

        return view('dashboard.asistencia.reporte-alumno', compact('alumno', 'asistencias'));
    }
}

