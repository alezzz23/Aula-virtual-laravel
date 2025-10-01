<?php

namespace App\Http\Controllers;

use App\Models\Nota;
use App\Models\Curso;
use App\Models\Materia;
use App\Models\Usuario;
use App\Models\PeriodoClase;
use Illuminate\Http\Request;

class NotaController extends Controller
{
    public function index()
    {
        $cursos = Curso::with('materias')->get();
        $periodos = PeriodoClase::all();

        return view('dashboard.notas.index', compact('cursos', 'periodos'));
    }

    public function porCurso(Curso $curso)
    {
        $materias = $curso->materias;
        $periodos = PeriodoClase::all();

        return view('dashboard.notas.curso', compact('curso', 'materias', 'periodos'));
    }

    public function porMateria(Materia $materia)
    {
        $alumnos = Usuario::where('seccion', $materia->curso)
            ->where('idRol', 3)
            ->get();

        $periodos = PeriodoClase::all();
        $lapsos = ['1er Lapso', '2do Lapso', '3er Lapso'];

        return view('dashboard.notas.materia', compact('materia', 'alumnos', 'periodos', 'lapsos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'alumno' => 'required|exists:usuarios,id',
            'lapso' => 'required|string',
            '1era' => 'required|integer|min:0|max:20',
            '2da' => 'required|integer|min:0|max:20',
            '3era' => 'required|integer|min:0|max:20',
            '4ta' => 'required|integer|min:0|max:20',
            'adicionales' => 'nullable|integer|min:0',
            'idMa' => 'required|exists:materias,id',
            'curso' => 'required|exists:cursos,id',
            'periodo' => 'nullable|exists:periodo_clases,id',
        ]);

        $nota = new Nota($request->all());
        $nota->total = $nota->calcularTotal();
        $nota->save();

        return back()->with('success', 'Nota registrada exitosamente.');
    }

    public function update(Request $request, Nota $nota)
    {
        $request->validate([
            '1era' => 'required|integer|min:0|max:20',
            '2da' => 'required|integer|min:0|max:20',
            '3era' => 'required|integer|min:0|max:20',
            '4ta' => 'required|integer|min:0|max:20',
            'adicionales' => 'nullable|integer|min:0',
        ]);

        $nota->update($request->all());
        $nota->total = $nota->calcularTotal();
        $nota->save();

        return back()->with('success', 'Nota actualizada exitosamente.');
    }

    public function destroy(Nota $nota)
    {
        $nota->delete();

        return back()->with('success', 'Nota eliminada exitosamente.');
    }

    public function boleta(Usuario $alumno)
    {
        $notas = Nota::where('alumno', $alumno->id)
            ->with(['materia', 'periodo'])
            ->get()
            ->groupBy('periodo.id');

        return view('dashboard.notas.boleta', compact('alumno', 'notas'));
    }

    public function promedios(Curso $curso, PeriodoClase $periodo)
    {
        $alumnos = Usuario::where('seccion', $curso->id)
            ->where('idRol', 3)
            ->with(['notas' => function($query) use ($periodo) {
                $query->where('periodo', $periodo->id)->with('materia');
            }])
            ->get();

        return view('dashboard.notas.promedios', compact('curso', 'periodo', 'alumnos'));
    }

    public function deficientes(Curso $curso)
    {
        $alumnos = Usuario::where('seccion', $curso->id)
            ->where('idRol', 3)
            ->with('notas.materia')
            ->get()
            ->filter(function($alumno) {
                return $alumno->notas->where('total', '<', 10)->count() > 0;
            });

        return view('dashboard.notas.deficientes', compact('curso', 'alumnos'));
    }
}

