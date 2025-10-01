<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Curso extends Model
{
    protected $table = 'cursos';

    protected $fillable = [
        'seccion',
        'estado',
    ];

    protected $casts = [
        'estado' => 'boolean',
    ];

    public function usuarios(): HasMany
    {
        return $this->hasMany(Usuario::class, 'seccion');
    }

    public function materias(): HasMany
    {
        return $this->hasMany(Materia::class, 'curso');
    }

    public function asistencias(): HasMany
    {
        return $this->hasMany(Asistencia::class, 'curso_id');
    }

    public function notas(): HasMany
    {
        return $this->hasMany(Nota::class, 'curso');
    }

    public function profesoresGuia(): HasMany
    {
        return $this->hasMany(ProfGuia::class, 'curso');
    }
}

