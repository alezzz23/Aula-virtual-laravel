<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Personalizar extends Model
{
    protected $table = 'personalizar';

    protected $fillable = [
        'colegio',
        'logo',
        'color',
    ];

    public static function configuracion()
    {
        return self::latest()->first() ?? self::create([
            'colegio' => '*Insertar Titulo*',
            'logo' => 'img/logo.png',
            'color' => '#00704f',
        ]);
    }
}

