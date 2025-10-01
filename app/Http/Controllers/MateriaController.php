<?php

namespace App\Http\Controllers;

use App\Models\Materia;
use App\Models\Curso;
use App\Models\Usuario;
use Illuminate\Http\Request;

class MateriaController extends Controller
{
    public function index()
    {
        $materias = Materia::with(['profesor', 'curso'])->where('estado', 1)->get();
        $cursos = Curso::where('estado', 1)->get();
        $profesores = Usuario::where('idRol', 2)->get();
        
        return view('dashboard.materias.index', compact('materias', 'cursos', 'profesores'));
    }

    public function create()
    {
        $cursos = Curso::where('estado', 1)->get();
        $profesores = Usuario::where('idRol', 2)->get();

        return view('dashboard.materias.create', compact('cursos', 'profesores'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'materia' => 'required|string|max:100',
            'profesor' => 'required|exists:usuarios,id',
            'curso' => 'required|exists:cursos,id',
            'estado' => 'required|boolean',
        ]);

        Materia::create($request->all());

        return redirect()->route('materias.index')
            ->with('success', 'Materia creada exitosamente.');
    }

    public function show(Materia $materia)
    {
        $materia->load([
            'profesor',
            'curso',
            'tareas',
            'clases',
            'videos',
            'enlaces',
            'guias',
            'planes',
            'reportes.usuario'
        ]);

        return view('dashboard.materias.show', compact('materia'));
    }

    public function edit(Materia $materia)
    {
        $cursos = Curso::where('estado', 1)->get();
        $profesores = Usuario::where('idRol', 2)->get();

        return view('dashboard.materias.edit', compact('materia', 'cursos', 'profesores'));
    }

    public function update(Request $request, Materia $materia)
    {
        $request->validate([
            'materia' => 'required|string|max:100',
            'profesor' => 'required|exists:usuarios,id',
            'curso' => 'required|exists:cursos,id',
            'estado' => 'required|boolean',
        ]);

        $materia->update($request->all());

        return redirect()->route('materias.index')
            ->with('success', 'Materia actualizada exitosamente.');
    }

    public function destroy(Materia $materia)
    {
        $materia->delete();

        return redirect()->route('materias.index')
            ->with('success', 'Materia eliminada exitosamente.');
    }

    public function actividades(Materia $materia)
    {
        $materia->load([
            'tareas',
            'tareasImg',
            'clases',
            'videos',
            'enlaces',
            'guias',
            'planes'
        ]);

        return view('dashboard.materias.actividades', compact('materia'));
    }
}

