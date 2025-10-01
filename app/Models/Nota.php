<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Nota extends Model
{
    protected $table = 'notas';

    protected $fillable = [
        'alumno',
        'lapso',
        '1era',
        '2da',
        '3era',
        '4ta',
        'adicionales',
        'total',
        'idMa',
        'curso',
        'periodo',
    ];

    protected $casts = [
        '1era' => 'integer',
        '2da' => 'integer',
        '3era' => 'integer',
        '4ta' => 'integer',
        'adicionales' => 'integer',
        'total' => 'integer',
    ];

    public function alumno(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'alumno');
    }

    public function materia(): BelongsTo
    {
        return $this->belongsTo(Materia::class, 'idMa');
    }

    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class, 'curso');
    }

    public function periodo(): BelongsTo
    {
        return $this->belongsTo(PeriodoClase::class, 'periodo');
    }

    public function calcularTotal(): int
    {
        return (int) round(
            ($this->{'1era'} + $this->{'2da'} + $this->{'3era'} + $this->{'4ta'} + $this->adicionales) / 4
        );
    }
}

