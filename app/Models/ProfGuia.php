<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ProfGuia extends Model
{
    protected $table = 'prof_guia';

    protected $fillable = [
        'usuario',
        'curso',
    ];

    public function usuario(): BelongsTo
    {
        return $this->belongsTo(Usuario::class, 'usuario');
    }

    public function curso(): BelongsTo
    {
        return $this->belongsTo(Curso::class, 'curso');
    }
}

