<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Materia;

class MateriasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $materias = [
            [
                'materia' => 'Castellano',
                'profesor' => 161,
                'curso' => 59,
                'estado' => 1,
            ],
            [
                'materia' => 'Informática',
                'profesor' => 162,
                'curso' => 59,
                'estado' => 1,
            ],
            [
                'materia' => 'Practicas de oficina',
                'profesor' => 164,
                'curso' => 59,
                'estado' => 1,
            ],
            [
                'materia' => 'Mantenimiento',
                'profesor' => 162,
                'curso' => 59,
                'estado' => 1,
            ],
            [
                'materia' => 'Programación',
                'profesor' => 162,
                'curso' => 59,
                'estado' => 1,
            ],
            [
                'materia' => 'Estructura de Datos',
                'profesor' => 163,
                'curso' => 60,
                'estado' => 1,
            ],
            [
                'materia' => 'Sistemas Operativos',
                'profesor' => 163,
                'curso' => 60,
                'estado' => 1,
            ],
            [
                'materia' => 'Proyecto',
                'profesor' => 163,
                'curso' => 60,
                'estado' => 1,
            ],
            [
                'materia' => 'Programación II',
                'profesor' => 162,
                'curso' => 60,
                'estado' => 1,
            ],
        ];

        foreach ($materias as $materia) {
            Materia::create($materia);
        }
    }
}
