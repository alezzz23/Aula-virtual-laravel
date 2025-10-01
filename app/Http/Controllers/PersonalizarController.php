<?php

namespace App\Http\Controllers;

use App\Models\Personalizar;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PersonalizarController extends Controller
{
    public function index()
    {
        $config = Personalizar::latest()->first();
        return view('dashboard.personalizar.index', compact('config'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'colegio' => 'required|string|max:200',
            'logo' => 'nullable|image|max:2048',
            'color' => 'required|string|max:200',
        ]);

        $config = Personalizar::latest()->first();

        if (!$config) {
            $config = new Personalizar();
        }

        $data = $request->only(['colegio', 'color']);

        if ($request->hasFile('logo')) {
            // Eliminar logo anterior si existe y no es el predeterminado
            if ($config->logo && $config->logo !== 'img/logo.png' && Storage::exists('public/' . $config->logo)) {
                Storage::delete('public/' . $config->logo);
            }

            $file = $request->file('logo');
            $filename = 'logo_' . time() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('public/img', $filename);
            $data['logo'] = 'img/' . $filename;
        }

        if ($config->exists) {
            $config->update($data);
        } else {
            $data['logo'] = $data['logo'] ?? 'img/logo.png';
            $config = Personalizar::create($data);
        }

        return back()->with('success', 'Configuración actualizada exitosamente.');
    }
}

