<?php

namespace Database\Seeders;

use App\Models\Personalizar;
use Illuminate\Database\Seeder;

class PersonalizarSeeder extends Seeder
{
    public function run(): void
    {
        Personalizar::create([
            'colegio' => '*Insertar Titulo*',
            'logo' => 'img/logo.png',
            'color' => '#00704f',
        ]);
    }
}

