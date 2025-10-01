<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Reporte extends Model
{
    protected $table = 'reportes';

    protected $fillable = [
        'usuario',
        'comentario',
        'idMa',
        'rol',
        'fecha',
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario');
    }

    public function materia(): BelongsTo
    {
        return $this->belongsTo(Materia::class, 'idMa');
    }
}

