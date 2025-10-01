<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('usuarios', function (Blueprint $table) {
            $table->id();
            $table->string('usuario', 50);
            $table->string('namefull', 70)->nullable();
            $table->string('cedula', 12);
            $table->char('sexo', 1)->nullable();
            $table->date('fecha_nacimiento')->nullable();
            $table->string('password');
            $table->string('correo', 70);
            $table->string('telefono', 12);
            $table->foreignId('idRol')->constrained('roles')->onUpdate('cascade');
            $table->foreignId('seccion')->nullable()->constrained('cursos')->onUpdate('cascade')->nullOnDelete();
            $table->boolean('enviar_tareas')->default(0);
            $table->boolean('ver_notas')->default(0);
            $table->string('estado', 20)->default('Activo');
            $table->boolean('guia')->default(0);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('usuarios');
    }
};

