<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Asistencia extends Model
{
    protected $table = 'asistencia';

    protected $fillable = [
        'usuario_id',
        'curso_id',
        'materia_id',
        'registro',
        'asistencia',
        'comentario',
        'fecha',
    ];

    protected $casts = [
        'asistencia' => 'boolean',
        'fecha' => 'datetime',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario_id');
    }

    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class, 'curso_id');
    }

    public function materia(): BelongsTo
    {
        return $this->belongsTo(Materia::class, 'materia_id');
    }
}

