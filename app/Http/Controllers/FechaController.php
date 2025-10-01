<?php

namespace App\Http\Controllers;

use App\Models\Fecha;
use Illuminate\Http\Request;

class FechaController extends Controller
{
    public function index()
    {
        $fechas = Fecha::orderBy('fecha', 'asc')->get();
        return view('dashboard.fechas.index', compact('fechas'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'informacion' => 'required|string|max:70',
            'lapso' => 'nullable|string|max:30',
            'fecha' => 'required|date',
        ]);

        Fecha::create($request->all());

        return back()->with('success', 'Fecha agregada exitosamente.');
    }

    public function update(Request $request, Fecha $fecha)
    {
        $request->validate([
            'informacion' => 'required|string|max:70',
            'lapso' => 'nullable|string|max:30',
            'fecha' => 'required|date',
        ]);

        $fecha->update($request->all());

        return back()->with('success', 'Fecha actualizada exitosamente.');
    }

    public function destroy(Fecha $fecha)
    {
        $fecha->delete();

        return back()->with('success', 'Fecha eliminada exitosamente.');
    }
}

