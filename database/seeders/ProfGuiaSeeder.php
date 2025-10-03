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
                'usuario' => 163,
                'curso' => 60,
            ],
            [
                'usuario' => 164,
                'curso' => 58,
            ],
            [
                'usuario' => 164,
                'curso' => 57,
            ],
            [
                'usuario' => 162,
                'curso' => 59,
            ],
        ];

        foreach ($profGuia as $prof) {
            ProfGuia::create($prof);
        }
    }
}
