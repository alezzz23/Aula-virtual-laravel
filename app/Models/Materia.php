<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Materia extends Model
{
    protected $table = 'materias';

    protected $fillable = [
        'materia',
        'profesor',
        'curso',
        'estado',
    ];

    protected $casts = [
        'estado' => 'boolean',
    ];

    public function profesor(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'profesor');
    }

    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class, 'curso');
    }

    // Alias para compatibilidad con vistas
    public function cursoRelacion(): BelongsTo
    {
        return $this->curso();
    }

    public function asistencias(): HasMany
    {
        return $this->hasMany(Asistencia::class, 'materia_id');
    }

    public function notas(): HasMany
    {
        return $this->hasMany(Nota::class, 'idMa');
    }

    public function tareas(): HasMany
    {
        return $this->hasMany(Tarea::class, 'idMa');
    }

    public function tareasImg(): HasMany
    {
        return $this->hasMany(TareaImg::class, 'idMa');
    }

    public function clases(): HasMany
    {
        return $this->hasMany(Clase::class, 'idMa');
    }

    public function videos(): HasMany
    {
        return $this->hasMany(Video::class, 'idMa');
    }

    public function enlaces(): HasMany
    {
        return $this->hasMany(Enlace::class, 'idMa');
    }

    public function guias(): HasMany
    {
        return $this->hasMany(Guia::class, 'idMa');
    }

    public function planes(): HasMany
    {
        return $this->hasMany(Plan::class, 'idMa');
    }

    public function reportes(): HasMany
    {
        return $this->hasMany(Reporte::class, 'idMa');
    }
}

