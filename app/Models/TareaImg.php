<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TareaImg extends Model
{
    protected $table = 'tareaimg';

    protected $fillable = [
        'nombre',
        'ruta',
        'idMa',
        'descripcion',
        'fecha',
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    public function materia(): BelongsTo
    {
        return $this->belongsTo(Materia::class, 'idMa');
    }
}

