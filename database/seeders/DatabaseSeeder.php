<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RolesSeeder::class,
            CursosSeeder::class,
            UsuariosSeeder::class,
            MateriasSeeder::class,
            PeriodoClasesSeeder::class,
            ProfGuiaSeeder::class,
            EventosSeeder::class,
            FechasSeeder::class,
            NotasSeeder::class,
            AsistenciaSeeder::class,
            PersonalizarSeeder::class,
        ]);
    }
}
