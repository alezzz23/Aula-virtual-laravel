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
                'profesor' => 6, // Caridad Pérez
                'curso' => 9, // 5to Año U
                'estado' => 1,
            ],
            [
                'materia' => 'Informática',
                'profesor' => 7, // German Vergara
                'curso' => 9, // 5to Año U
                'estado' => 1,
            ],
            [
                'materia' => 'Practicas de oficina',
                'profesor' => 9, // Jenny Patiño
                'curso' => 9, // 5to Año U
                'estado' => 1,
            ],
            [
                'materia' => 'Mantenimiento',
                'profesor' => 7, // German Vergara
                'curso' => 9, // 5to Año U
                'estado' => 1,
            ],
            [
                'materia' => 'Programación',
                'profesor' => 7, // German Vergara
                'curso' => 9, // 5to Año U
                'estado' => 1,
            ],
            [
                'materia' => 'Estructura de Datos',
                'profesor' => 8, // Marjorie Amaro
                'curso' => 10, // 6to Año U
                'estado' => 1,
            ],
            [
                'materia' => 'Sistemas Operativos',
                'profesor' => 8, // Marjorie Amaro
                'curso' => 10, // 6to Año U
                'estado' => 1,
            ],
            [
                'materia' => 'Proyecto',
                'profesor' => 8, // Marjorie Amaro
                'curso' => 10, // 6to Año U
                'estado' => 1,
            ],
            [
                'materia' => 'Programación II',
                'profesor' => 7, // German Vergara
                'curso' => 10, // 6to Año U
                'estado' => 1,
            ],
        ];

        foreach ($materias as $materia) {
            Materia::create($materia);
        }
    }
}
