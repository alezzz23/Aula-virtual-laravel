<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Tarea extends Model
{
    protected $table = 'tarea';

    protected $fillable = [
        'tarea',
        'descripcion',
        'archivo',
        'idMa',
        'lapso',
        'fecha_entrega',
        'fecha',
    ];

    protected $casts = [
        'fecha' => 'datetime',
        'fecha_entrega' => 'date',
    ];

    public function materia(): BelongsTo
    {
        return $this->belongsTo(Materia::class, 'idMa');
    }

    public function tareasImg()
    {
        return $this->hasMany(TareaImg::class, 'idMa', 'idMa');
    }
}

