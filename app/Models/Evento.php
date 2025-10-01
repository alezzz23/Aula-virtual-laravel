<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Evento extends Model
{
    protected $table = 'eventos';

    protected $fillable = [
        'titulo',
        'descripcion',
        'archivo',
        'tipoArchivo',
        'fecha',
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    public function esImagen(): bool
    {
        return str_starts_with($this->tipoArchivo, 'image/');
    }

    public function esVideo(): bool
    {
        return str_starts_with($this->tipoArchivo, 'video/');
    }
}

