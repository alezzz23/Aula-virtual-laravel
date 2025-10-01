<?php

namespace App\Http\Controllers;

use App\Models\Tarea;
use App\Models\TareaImg;
use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class TareaController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        if ($user->isProfesor()) {
            $tareas = Tarea::whereHas('materia', function($query) use ($user) {
                $query->where('profesor', $user->id);
            })->with(['materia', 'tareasImg'])->latest()->get();
            $materias = $user->materiasComoProfesor;
        } else {
            $tareas = Tarea::with(['materia', 'tareasImg'])->latest()->get();
            $materias = Materia::all();
        }

        return view('dashboard.tareas.index', compact('tareas', 'materias'));
    }

    public function create()
    {
        $user = auth()->user();

        if ($user->isProfesor()) {
            $materias = $user->materiasComoProfesor;
        } else {
            $materias = Materia::all();
        }

        return view('dashboard.tareas.create', compact('materias'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'tarea' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'archivo' => 'nullable|file|max:10240',
            'idMa' => 'required|exists:materias,id',
            'lapso' => 'nullable|string',
            'fecha_entrega' => 'nullable|date',
        ]);

        $data = $request->only(['tarea', 'descripcion', 'idMa', 'lapso', 'fecha_entrega']);
        $data['archivo'] = '';

        if ($request->hasFile('archivo')) {
            $file = $request->file('archivo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/tareas', $filename);
            $data['archivo'] = $filename;
        }

        Tarea::create($data);

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea creada exitosamente.');
    }

    public function show(Tarea $tarea)
    {
        $tarea->load('materia.profesor');
        return view('dashboard.tareas.show', compact('tarea'));
    }

    public function edit(Tarea $tarea)
    {
        $user = auth()->user();

        if ($user->isProfesor()) {
            $materias = $user->materiasComoProfesor;
        } else {
            $materias = Materia::all();
        }

        return view('dashboard.tareas.edit', compact('tarea', 'materias'));
    }

    public function update(Request $request, Tarea $tarea)
    {
        $request->validate([
            'tarea' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'archivo' => 'nullable|file|max:10240',
            'idMa' => 'required|exists:materias,id',
            'lapso' => 'nullable|string',
            'fecha_entrega' => 'nullable|date',
        ]);

        $data = $request->only(['tarea', 'descripcion', 'idMa', 'lapso', 'fecha_entrega']);

        if ($request->hasFile('archivo')) {
            // Eliminar archivo anterior si existe
            if ($tarea->archivo && Storage::exists('public/tareas/' . $tarea->archivo)) {
                Storage::delete('public/tareas/' . $tarea->archivo);
            }

            $file = $request->file('archivo');
            $filename = time() . '_' . $file->getClientOriginalName();
            $file->storeAs('public/tareas', $filename);
            $data['archivo'] = $filename;
        }

        $tarea->update($data);

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea actualizada exitosamente.');
    }

    public function destroy(Tarea $tarea)
    {
        // Eliminar archivo si existe
        if ($tarea->archivo && Storage::exists('public/tareas/' . $tarea->archivo)) {
            Storage::delete('public/tareas/' . $tarea->archivo);
        }

        $tarea->delete();

        return redirect()->route('tareas.index')
            ->with('success', 'Tarea eliminada exitosamente.');
    }

    public function verTareas(Materia $materia)
    {
        $tareas = $materia->tareas()->latest()->get();
        return view('dashboard.tareas.ver', compact('materia', 'tareas'));
    }

    // Gestión de envío de tareas por estudiantes
    public function enviarTarea(Request $request)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'ruta' => 'required|file|max:10240',
            'idMa' => 'required|exists:materias,id',
            'descripcion' => 'required|string|max:70',
        ]);

        $file = $request->file('ruta');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/tareas/estudiantes', $filename);

        TareaImg::create([
            'nombre' => $request->nombre,
            'ruta' => $filename,
            'idMa' => $request->idMa,
            'descripcion' => $request->descripcion,
        ]);

        return back()->with('success', 'Tarea enviada exitosamente.');
    }

    public function tareasEnviadas(Materia $materia)
    {
        $tareasEnviadas = $materia->tareasImg()->with('materia')->latest()->get();
        return view('dashboard.tareas.enviadas', compact('materia', 'tareasEnviadas'));
    }
}

