<?php

namespace App\Http\Controllers;

use App\Models\Clase;
use App\Models\Video;
use App\Models\Enlace;
use App\Models\Guia;
use App\Models\Plan;
use App\Models\Materia;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ArchivoController extends Controller
{
    // Clases
    public function indexClases(Materia $materia)
    {
        $clases = $materia->clases;
        return view('dashboard.archivos.clases.index', compact('materia', 'clases'));
    }

    public function storeClase(Request $request, Materia $materia)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ruta' => 'required|file|max:10240',
            'descripcion' => 'required|string|max:70',
        ]);

        $file = $request->file('ruta');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/clases', $filename);

        Clase::create([
            'nombre' => $request->nombre,
            'tipo' => $file->getMimeType(),
            'ruta' => $filename,
            'descripcion' => $request->descripcion,
            'idMa' => $materia->id,
        ]);

        return back()->with('success', 'Clase subida exitosamente.');
    }

    public function destroyClase(Clase $clase)
    {
        if (Storage::exists('public/clases/' . $clase->ruta)) {
            Storage::delete('public/clases/' . $clase->ruta);
        }
        $clase->delete();

        return back()->with('success', 'Clase eliminada exitosamente.');
    }

    // Videos
    public function indexVideos(Materia $materia)
    {
        $videos = $materia->videos;
        return view('dashboard.archivos.videos.index', compact('materia', 'videos'));
    }

    public function storeVideo(Request $request, Materia $materia)
    {
        $request->validate([
            'nombre' => 'required|string|max:255',
            'ruta' => 'required|file|mimes:mp4,avi,mov,wmv|max:102400',
            'descripcion' => 'required|string|max:70',
        ]);

        $file = $request->file('ruta');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/videos', $filename);

        Video::create([
            'nombre' => $request->nombre,
            'tipo' => $file->getMimeType(),
            'ruta' => $filename,
            'descripcion' => $request->descripcion,
            'idMa' => $materia->id,
        ]);

        return back()->with('success', 'Video subido exitosamente.');
    }

    public function destroyVideo(Video $video)
    {
        if (Storage::exists('public/videos/' . $video->ruta)) {
            Storage::delete('public/videos/' . $video->ruta);
        }
        $video->delete();

        return back()->with('success', 'Video eliminado exitosamente.');
    }

    // Enlaces
    public function indexEnlaces(Materia $materia)
    {
        $enlaces = $materia->enlaces;
        return view('dashboard.archivos.enlaces.index', compact('materia', 'enlaces'));
    }

    public function storeEnlace(Request $request, Materia $materia)
    {
        $request->validate([
            'url' => 'required|url|max:225',
            'descripcion' => 'required|string|max:225',
        ]);

        Enlace::create([
            'url' => $request->url,
            'descripcion' => $request->descripcion,
            'idMa' => $materia->id,
        ]);

        return back()->with('success', 'Enlace agregado exitosamente.');
    }

    public function destroyEnlace(Enlace $enlace)
    {
        $enlace->delete();
        return back()->with('success', 'Enlace eliminado exitosamente.');
    }

    // Guías
    public function indexGuias(Materia $materia)
    {
        $guias = $materia->guias;
        return view('dashboard.archivos.guias.index', compact('materia', 'guias'));
    }

    public function storeGuia(Request $request, Materia $materia)
    {
        $request->validate([
            'descripcion' => 'required|string|max:20',
            'archivo' => 'required|file|max:10240',
        ]);

        $file = $request->file('archivo');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/guias', $filename);

        Guia::create([
            'descripcion' => $request->descripcion,
            'archivo' => $filename,
            'idMa' => $materia->id,
        ]);

        return back()->with('success', 'Guía subida exitosamente.');
    }

    public function destroyGuia(Guia $guia)
    {
        if (Storage::exists('public/guias/' . $guia->archivo)) {
            Storage::delete('public/guias/' . $guia->archivo);
        }
        $guia->delete();

        return back()->with('success', 'Guía eliminada exitosamente.');
    }

    // Planes
    public function indexPlanes(Materia $materia)
    {
        $planes = $materia->planes;
        return view('dashboard.archivos.planes.index', compact('materia', 'planes'));
    }

    public function storePlan(Request $request, Materia $materia)
    {
        $request->validate([
            'nombre' => 'required|string|max:50',
            'ruta' => 'required|file|max:10240',
        ]);

        $file = $request->file('ruta');
        $filename = time() . '_' . $file->getClientOriginalName();
        $file->storeAs('public/planes', $filename);

        Plan::create([
            'nombre' => $request->nombre,
            'ruta' => $filename,
            'idMa' => $materia->id,
        ]);

        return back()->with('success', 'Plan subido exitosamente.');
    }

    public function destroyPlan(Plan $plan)
    {
        if (Storage::exists('public/planes/' . $plan->ruta)) {
            Storage::delete('public/planes/' . $plan->ruta);
        }
        $plan->delete();

        return back()->with('success', 'Plan eliminado exitosamente.');
    }
}

