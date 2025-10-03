<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Nota;

class NotasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $notas = [
            [
                'alumno' => 4, // Deiner Montes de Oca
                'lapso' => '1er Lapso',
                '1era' => 15,
                '2da' => 20,
                '3era' => 20,
                '4ta' => 18,
                'adicionales' => 0,
                'total' => 18,
                'idMa' => 2, // Informática
                'curso' => 9, // 5to Año U
                'periodo' => 1, // 2024-2025
            ],
            [
                'alumno' => 4, // Deiner Montes de Oca
                'lapso' => '1er Lapso',
                '1era' => 13,
                '2da' => 17,
                '3era' => 15,
                '4ta' => 20,
                'adicionales' => 0,
                'total' => 16,
                'idMa' => 4, // Mantenimiento
                'curso' => 9, // 5to Año U
                'periodo' => 1, // 2024-2025
            ],
            [
                'alumno' => 4, // Deiner Montes de Oca
                'lapso' => '1er Lapso',
                '1era' => 16,
                '2da' => 20,
                '3era' => 14,
                '4ta' => 20,
                'adicionales' => 0,
                'total' => 18,
                'idMa' => 5, // Programación
                'curso' => 9, // 5to Año U
                'periodo' => 1, // 2024-2025
            ],
            [
                'alumno' => 4, // Deiner Montes de Oca
                'lapso' => '2do Lapso',
                '1era' => 17,
                '2da' => 10,
                '3era' => 17,
                '4ta' => 17,
                'adicionales' => 0,
                'total' => 15,
                'idMa' => 2, // Informática
                'curso' => 9, // 5to Año U
                'periodo' => 1, // 2024-2025
            ],
            [
                'alumno' => 4, // Deiner Montes de Oca
                'lapso' => '2do Lapso',
                '1era' => 13,
                '2da' => 19,
                '3era' => 15,
                '4ta' => 15,
                'adicionales' => 0,
                'total' => 16,
                'idMa' => 4, // Mantenimiento
                'curso' => 9, // 5to Año U
                'periodo' => 1, // 2024-2025
            ],
            [
                'alumno' => 4, // Deiner Montes de Oca
                'lapso' => '2do Lapso',
                '1era' => 18,
                '2da' => 13,
                '3era' => 12,
                '4ta' => 20,
                'adicionales' => 0,
                'total' => 16,
                'idMa' => 5, // Programación
                'curso' => 9, // 5to Año U
                'periodo' => 1, // 2024-2025
            ],
            [
                'alumno' => 4, // Deiner Montes de Oca
                'lapso' => '3er Lapso',
                '1era' => 20,
                '2da' => 15,
                '3era' => 17,
                '4ta' => 14,
                'adicionales' => 0,
                'total' => 17,
                'idMa' => 2, // Informática
                'curso' => 9, // 5to Año U
                'periodo' => 1, // 2024-2025
            ],
            [
                'alumno' => 4, // Deiner Montes de Oca
                'lapso' => '3er Lapso',
                '1era' => 11,
                '2da' => 17,
                '3era' => 18,
                '4ta' => 20,
                'adicionales' => 0,
                'total' => 17,
                'idMa' => 4, // Mantenimiento
                'curso' => 9, // 5to Año U
                'periodo' => 1, // 2024-2025
            ],
            [
                'alumno' => 4, // Deiner Montes de Oca
                'lapso' => '3er Lapso',
                '1era' => 12,
                '2da' => 12,
                '3era' => 16,
                '4ta' => 14,
                'adicionales' => 0,
                'total' => 14,
                'idMa' => 5, // Programación
                'curso' => 9, // 5to Año U
                'periodo' => 1, // 2024-2025
            ],
            [
                'alumno' => 4, // Deiner Montes de Oca
                'lapso' => '1er Lapso',
                '1era' => 16,
                '2da' => 11,
                '3era' => 13,
                '4ta' => 14,
                'adicionales' => 0,
                'total' => 14,
                'idMa' => 1, // Castellano
                'curso' => 9, // 5to Año U
                'periodo' => 1, // 2024-2025
            ],
            [
                'alumno' => 4, // Deiner Montes de Oca
                'lapso' => '1er Lapso',
                '1era' => 12,
                '2da' => 10,
                '3era' => 12,
                '4ta' => 13,
                'adicionales' => 0,
                'total' => 12,
                'idMa' => 3, // Prácticas de oficina
                'curso' => 9, // 5to Año U
                'periodo' => 1, // 2024-2025
            ],
            [
                'alumno' => 4, // Deiner Montes de Oca
                'lapso' => '2do Lapso',
                '1era' => 11,
                '2da' => 11,
                '3era' => 9,
                '4ta' => 13,
                'adicionales' => 0,
                'total' => 11,
                'idMa' => 1, // Castellano
                'curso' => 9, // 5to Año U
                'periodo' => 1, // 2024-2025
            ],
            [
                'alumno' => 4, // Deiner Montes de Oca
                'lapso' => '2do Lapso',
                '1era' => 8,
                '2da' => 12,
                '3era' => 5,
                '4ta' => 20,
                'adicionales' => 0,
                'total' => 11,
                'idMa' => 3, // Prácticas de oficina
                'curso' => 9, // 5to Año U
                'periodo' => 1, // 2024-2025
            ],
            [
                'alumno' => 4, // Deiner Montes de Oca
                'lapso' => '3er Lapso',
                '1era' => 10,
                '2da' => 10,
                '3era' => 13,
                '4ta' => 14,
                'adicionales' => 0,
                'total' => 12,
                'idMa' => 1, // Castellano
                'curso' => 9, // 5to Año U
                'periodo' => 1, // 2024-2025
            ],
            [
                'alumno' => 4, // Deiner Montes de Oca
                'lapso' => '3er Lapso',
                '1era' => 10,
                '2da' => 13,
                '3era' => 13,
                '4ta' => 20,
                'adicionales' => 0,
                'total' => 14,
                'idMa' => 3, // Prácticas de oficina
                'curso' => 9, // 5to Año U
                'periodo' => 1, // 2024-2025
            ],
        ];

        foreach ($notas as $nota) {
            Nota::create($nota);
        }
    }
}
