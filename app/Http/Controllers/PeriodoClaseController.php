<?php

namespace App\Http\Controllers;

use App\Models\PeriodoClase;
use Illuminate\Http\Request;

class PeriodoClaseController extends Controller
{
    public function index()
    {
        $periodos = PeriodoClase::all();
        return view('dashboard.periodos.index', compact('periodos'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'fecha_inicio' => 'required|integer|min:1900|max:2100',
            'fecha_final' => 'required|integer|min:1900|max:2100|gt:fecha_inicio',
        ]);

        PeriodoClase::create($request->all());

        return back()->with('success', 'Periodo creado exitosamente.');
    }

    public function destroy(PeriodoClase $periodo)
    {
        $periodo->delete();

        return back()->with('success', 'Periodo eliminado exitosamente.');
    }
}

