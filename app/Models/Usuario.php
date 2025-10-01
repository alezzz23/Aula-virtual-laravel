<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Notifications\Notifiable;

class Usuario extends Authenticatable
{
    use Notifiable;

    protected $table = 'usuarios';

    protected $fillable = [
        'usuario',
        'namefull',
        'cedula',
        'sexo',
        'fecha_nacimiento',
        'password',
        'correo',
        'telefono',
        'idRol',
        'seccion',
        'enviar_tareas',
        'ver_notas',
        'estado',
        'guia',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'fecha_nacimiento' => 'date',
        'enviar_tareas' => 'boolean',
        'ver_notas' => 'boolean',
        'guia' => 'boolean',
    ];

    public function role(): BelongsTo
    {
        return $this->belongsTo(Role::class, 'idRol');
    }

    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class, 'seccion');
    }

    public function materiasComoProfesor(): HasMany
    {
        return $this->hasMany(Materia::class, 'profesor');
    }

    public function asistencias(): HasMany
    {
        return $this->hasMany(Asistencia::class, 'usuario_id');
    }

    public function notas(): HasMany
    {
        return $this->hasMany(Nota::class, 'alumno');
    }

    public function reportes(): HasMany
    {
        return $this->hasMany(Reporte::class, 'usuario');
    }

    public function sesiones(): HasMany
    {
        return $this->hasMany(UserSession::class, 'userId');
    }

    public function cursosComoGuia(): HasMany
    {
        return $this->hasMany(ProfGuia::class, 'usuario');
    }

    // Accessors
    public function getRolDescripcionAttribute()
    {
        return $this->role?->descripcion;
    }

    public function isAdmin(): bool
    {
        return $this->role?->descripcion === 'Admin';
    }

    public function isProfesor(): bool
    {
        return $this->role?->descripcion === 'Profesor/a';
    }

    public function isEstudiante(): bool
    {
        return $this->role?->descripcion === 'Estudiante';
    }

    public function isCoordinador(): bool
    {
        return in_array($this->role?->descripcion, ['Coordinador/a', 'Coordinador/a de Evaluación']);
    }
}

