<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Guia extends Model
{
    protected $table = 'guia';

    protected $fillable = [
        'descripcion',
        'archivo',
        'idMa',
    ];

    public function materia(): BelongsTo
    {
        return $this->belongsTo(Materia::class, 'idMa');
    }
}

