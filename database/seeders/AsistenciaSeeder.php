<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Asistencia;

class AsistenciaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $asistencias = [
            [
                'usuario_id' => 4, // Deiner Montes de Oca
                'curso_id' => 10, // 6to Año U
                'materia_id' => 6, // Estructura de Datos
                'registro' => 1,
                'asistencia' => 1,
                'comentario' => '',
                'fecha' => '2025-02-10 02:21:06',
            ],
            [
                'usuario_id' => 6, // José Pérez
                'curso_id' => 10, // 6to Año U
                'materia_id' => 6, // Estructura de Datos
                'registro' => 1,
                'asistencia' => 1,
                'comentario' => null,
                'fecha' => '2025-02-10 02:21:07',
            ],
            [
                'usuario_id' => 4, // Deiner Montes de Oca
                'curso_id' => 10, // 6to Año U
                'materia_id' => 8, // Proyecto
                'registro' => 1,
                'asistencia' => 1,
                'comentario' => '',
                'fecha' => '2025-02-10 02:21:15',
            ],
            [
                'usuario_id' => 6, // José Pérez
                'curso_id' => 10, // 6to Año U
                'materia_id' => 8, // Proyecto
                'registro' => 1,
                'asistencia' => 1,
                'comentario' => null,
                'fecha' => '2025-02-10 02:21:15',
            ],
            [
                'usuario_id' => 4, // Deiner Montes de Oca
                'curso_id' => 10, // 6to Año U
                'materia_id' => 7, // Sistemas Operativos
                'registro' => 1,
                'asistencia' => 1,
                'comentario' => '',
                'fecha' => '2025-02-10 02:21:23',
            ],
            [
                'usuario_id' => 6, // José Pérez
                'curso_id' => 10, // 6to Año U
                'materia_id' => 7, // Sistemas Operativos
                'registro' => 1,
                'asistencia' => 1,
                'comentario' => null,
                'fecha' => '2025-02-10 02:21:24',
            ],
            [
                'usuario_id' => 7, // Alejandro Sojo
                'curso_id' => 9, // 5to Año U
                'materia_id' => 4, // Mantenimiento
                'registro' => 1,
                'asistencia' => 1,
                'comentario' => null,
                'fecha' => '2025-02-10 02:28:16',
            ],
            [
                'usuario_id' => 5, // Elio Martinez
                'curso_id' => 9, // 5to Año U
                'materia_id' => 4, // Mantenimiento
                'registro' => 1,
                'asistencia' => 1,
                'comentario' => null,
                'fecha' => '2025-02-10 02:28:16',
            ],
        ];

        foreach ($asistencias as $asistencia) {
            Asistencia::create($asistencia);
        }
    }
}
