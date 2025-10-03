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
                'usuario_id' => 157,
                'curso_id' => 60,
                'materia_id' => 118,
                'registro' => 1,
                'asistencia' => 1,
                'comentario' => '',
                'fecha' => '2025-02-10 02:21:06',
            ],
            [
                'usuario_id' => 159,
                'curso_id' => 60,
                'materia_id' => 118,
                'registro' => 1,
                'asistencia' => 1,
                'comentario' => null,
                'fecha' => '2025-02-10 02:21:07',
            ],
            [
                'usuario_id' => 157,
                'curso_id' => 60,
                'materia_id' => 120,
                'registro' => 1,
                'asistencia' => 1,
                'comentario' => '',
                'fecha' => '2025-02-10 02:21:15',
            ],
            [
                'usuario_id' => 159,
                'curso_id' => 60,
                'materia_id' => 120,
                'registro' => 1,
                'asistencia' => 1,
                'comentario' => null,
                'fecha' => '2025-02-10 02:21:15',
            ],
            [
                'usuario_id' => 157,
                'curso_id' => 60,
                'materia_id' => 119,
                'registro' => 1,
                'asistencia' => 1,
                'comentario' => '',
                'fecha' => '2025-02-10 02:21:23',
            ],
            [
                'usuario_id' => 159,
                'curso_id' => 60,
                'materia_id' => 119,
                'registro' => 1,
                'asistencia' => 1,
                'comentario' => null,
                'fecha' => '2025-02-10 02:21:24',
            ],
            [
                'usuario_id' => 160,
                'curso_id' => 59,
                'materia_id' => 116,
                'registro' => 1,
                'asistencia' => 1,
                'comentario' => null,
                'fecha' => '2025-02-10 02:28:16',
            ],
            [
                'usuario_id' => 158,
                'curso_id' => 59,
                'materia_id' => 116,
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
