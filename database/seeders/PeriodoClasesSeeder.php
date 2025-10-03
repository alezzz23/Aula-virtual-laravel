<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PeriodoClase;

class PeriodoClasesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $periodos = [
            [
                'fecha_inicio' => 2024,
                'fecha_final' => 2025,
            ],
            [
                'fecha_inicio' => 2025,
                'fecha_final' => 2026,
            ],
        ];

        foreach ($periodos as $periodo) {
            PeriodoClase::create($periodo);
        }
    }
}
