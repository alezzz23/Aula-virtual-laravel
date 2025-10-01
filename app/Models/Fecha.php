<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Fecha extends Model
{
    protected $table = 'fechas';

    protected $fillable = [
        'informacion',
        'lapso',
        'fecha',
    ];

    protected $casts = [
        'fecha' => 'datetime',
    ];
}

