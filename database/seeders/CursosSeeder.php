<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Curso;

class CursosSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $cursos = [
            ['seccion' => '1er Año A', 'estado' => 1],
            ['seccion' => '1er Año B', 'estado' => 1],
            ['seccion' => '2do Año A', 'estado' => 1],
            ['seccion' => '2do Año B', 'estado' => 1],
            ['seccion' => '3er Año A', 'estado' => 1],
            ['seccion' => '3er Año B', 'estado' => 1],
            ['seccion' => '4to Año A', 'estado' => 1],
            ['seccion' => '4to Año B', 'estado' => 1],
            ['seccion' => '5to Año U', 'estado' => 1],
            ['seccion' => '6to Año U', 'estado' => 1],
        ];

        foreach ($cursos as $curso) {
            Curso::create($curso);
        }
    }
}
