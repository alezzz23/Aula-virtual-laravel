<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PeriodoClase extends Model
{
    protected $table = 'periodo_clases';

    protected $fillable = [
        'fecha_inicio',
        'fecha_final',
    ];

    public function notas(): HasMany
    {
        return $this->hasMany(Nota::class, 'periodo');
    }

    public function getPeriodoAttribute(): string
    {
        return "{$this->fecha_inicio}-{$this->fecha_final}";
    }
}

