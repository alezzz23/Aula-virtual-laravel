<?php

namespace App\Http\Controllers;

use App\Models\Curso;
use App\Models\Usuario;
use App\Models\ProfGuia;
use Illuminate\Http\Request;

class CursoController extends Controller
{
    public function index()
    {
        $cursos = Curso::with(['materias', 'usuarios', 'profesoresGuia.usuario'])->get();
        $profesores = Usuario::where('idRol', 2)->get();
        return view('dashboard.cursos.index', compact('cursos', 'profesores'));
    }

    public function create()
    {
        return view('dashboard.cursos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'seccion' => 'required|string|max:100',
            'estado' => 'required|boolean',
        ]);

        Curso::create($request->all());

        return redirect()->route('cursos.index')
            ->with('success', 'Curso creado exitosamente.');
    }

    public function show(Curso $curso)
    {
        $curso->load(['materias.profesor', 'usuarios', 'profesoresGuia.usuario']);
        return view('dashboard.cursos.show', compact('curso'));
    }

    public function edit(Curso $curso)
    {
        return view('dashboard.cursos.edit', compact('curso'));
    }

    public function update(Request $request, Curso $curso)
    {
        $request->validate([
            'seccion' => 'required|string|max:100',
            'estado' => 'required|boolean',
        ]);

        $curso->update($request->all());

        return redirect()->route('cursos.index')
            ->with('success', 'Curso actualizado exitosamente.');
    }

    public function destroy(Curso $curso)
    {
        $curso->delete();

        return redirect()->route('cursos.index')
            ->with('success', 'Curso eliminado exitosamente.');
    }

    public function alumnos(Curso $curso)
    {
        $alumnos = Usuario::where('seccion', $curso->id)
            ->where('idRol', 3)
            ->get();

        return view('dashboard.cursos.alumnos', compact('curso', 'alumnos'));
    }

    public function asignarProfesorGuia(Request $request, Curso $curso)
    {
        $request->validate([
            'profesor_id' => 'required|exists:usuarios,id',
        ]);

        ProfGuia::create([
            'usuario' => $request->profesor_id,
            'curso' => $curso->id,
        ]);

        return back()->with('success', 'Profesor guía asignado exitosamente.');
    }

    public function eliminarProfesorGuia(ProfGuia $profGuia)
    {
        $profGuia->delete();

        return back()->with('success', 'Profesor guía eliminado exitosamente.');
    }
}

