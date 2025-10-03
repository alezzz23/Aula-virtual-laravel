<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Fecha;

class FechasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $fechas = [
            [
                'informacion' => 'Consejo de Profesores',
                'lapso' => null,
                'fecha' => '2025-07-19 00:41:00',
            ],
            [
                'informacion' => 'Corte de Notas',
                'lapso' => '3er Lapso',
                'fecha' => '2025-07-22 08:01:00',
            ],
        ];

        foreach ($fechas as $fecha) {
            Fecha::create($fecha);
        }
    }
}
