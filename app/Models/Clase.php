<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Clase extends Model
{
    protected $table = 'clases';

    protected $fillable = [
        'nombre',
        'tipo',
        'ruta',
        'descripcion',
        'idMa',
        'fecha_subida',
    ];

    protected $casts = [
        'fecha_subida' => 'datetime',
    ];

    public function materia(): BelongsTo
    {
        return $this->belongsTo(Materia::class, 'idMa');
    }
}

