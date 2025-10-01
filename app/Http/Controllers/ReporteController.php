<?php

namespace App\Http\Controllers;

use App\Models\Reporte;
use App\Models\Materia;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    public function index(Materia $materia)
    {
        $reportes = $materia->reportes()->with('usuario')->orderBy('fecha', 'desc')->get();
        return view('dashboard.reportes.index', compact('materia', 'reportes'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'comentario' => 'required|string|max:999',
            'idMa' => 'required|exists:materias,id',
        ]);

        Reporte::create([
            'usuario' => auth()->id(),
            'comentario' => $request->comentario,
            'idMa' => $request->idMa,
            'rol' => auth()->user()->role->descripcion,
        ]);

        return back()->with('success', 'Comentario agregado exitosamente.');
    }

    public function destroy(Reporte $reporte)
    {
        // Solo el creador o un admin pueden eliminar
        if ($reporte->usuario !== auth()->id() && !auth()->user()->isAdmin()) {
            abort(403, 'No autorizado');
        }

        $reporte->delete();

        return back()->with('success', 'Comentario eliminado exitosamente.');
    }
}

