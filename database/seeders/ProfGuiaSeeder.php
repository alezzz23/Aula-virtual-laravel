<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProfGuia;

class ProfGuiaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $profGuia = [
            [
                'usuario' => 8, // Marjorie Amaro
                'curso' => 10, // 6to Año U
            ],
            [
                'usuario' => 9, // Jenny Patiño
                'curso' => 8, // 4to Año B
            ],
            [
                'usuario' => 9, // Jenny Patiño
                'curso' => 7, // 4to Año A
            ],
            [
                'usuario' => 7, // German Vergara
                'curso' => 9, // 5to Año U
            ],
        ];

        foreach ($profGuia as $prof) {
            ProfGuia::create($prof);
        }
    }
}
