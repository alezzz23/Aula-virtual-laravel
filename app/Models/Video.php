<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Video extends Model
{
    protected $table = 'videos';

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

