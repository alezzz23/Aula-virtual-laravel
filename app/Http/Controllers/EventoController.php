<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EventoController extends Controller
{
    public function index()
    {
        $eventos = Evento::orderBy('fecha', 'desc')->get();
        return view('dashboard.eventos.index', compact('eventos'));
    }

    public function create()
    {
        return view('dashboard.eventos.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'archivo' => 'required|file|mimes:jpg,jpeg,png,gif,mp4,avi,mov|max:51200',
        ]);

        $file = $request->file('archivo');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/eventos', $filename);

        Evento::create([
            'titulo' => $request->titulo,
            'descripcion' => $request->descripcion,
            'archivo' => $filename,
            'tipoArchivo' => $file->getMimeType(),
        ]);

        return redirect()->route('eventos.index')
            ->with('success', 'Evento publicado exitosamente.');
    }

    public function show(Evento $evento)
    {
        return view('dashboard.eventos.show', compact('evento'));
    }

    public function edit(Evento $evento)
    {
        return view('dashboard.eventos.edit', compact('evento'));
    }

    public function update(Request $request, Evento $evento)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'archivo' => 'nullable|file|mimes:jpg,jpeg,png,gif,mp4,avi,mov|max:51200',
        ]);

        $data = $request->only(['titulo', 'descripcion']);

        if ($request->hasFile('archivo')) {
            // Eliminar archivo anterior
            if (Storage::exists('public/eventos/' . $evento->archivo)) {
                Storage::delete('public/eventos/' . $evento->archivo);
            }

            $file = $request->file('archivo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/eventos', $filename);
            $data['archivo'] = $filename;
            $data['tipoArchivo'] = $file->getMimeType();
        }

        $evento->update($data);

        return redirect()->route('eventos.index')
            ->with('success', 'Evento actualizado exitosamente.');
    }

    public function destroy(Evento $evento)
    {
        // Eliminar archivo
        if (Storage::exists('public/eventos/' . $evento->archivo)) {
            Storage::delete('public/eventos/' . $evento->archivo);
        }

        $evento->delete();

        return redirect()->route('eventos.index')
            ->with('success', 'Evento eliminado exitosamente.');
    }
}

