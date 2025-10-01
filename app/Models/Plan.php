<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Plan extends Model
{
    protected $table = 'plan';

    protected $fillable = [
        'nombre',
        'ruta',
        'idMa',
    ];

    public function materia(): BelongsTo
    {
        return $this->belongsTo(Materia::class, 'idMa');
    }
}

