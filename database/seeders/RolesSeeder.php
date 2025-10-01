<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RolesSeeder extends Seeder
{
    public function run(): void
    {
        $roles = [
            ['id' => 1, 'descripcion' => 'Admin'],
            ['id' => 2, 'descripcion' => 'Profesor/a'],
            ['id' => 3, 'descripcion' => 'Estudiante'],
            ['id' => 4, 'descripcion' => 'Coordinador/a'],
            ['id' => 5, 'descripcion' => 'Coordinador/a de Evaluación'],
        ];

        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}

