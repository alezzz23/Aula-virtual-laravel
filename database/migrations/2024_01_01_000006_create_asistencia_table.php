<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('asistencia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario_id')->constrained('usuarios');
            $table->foreignId('curso_id')->constrained('cursos');
            $table->foreignId('materia_id')->constrained('materias');
            $table->integer('registro')->default(1);
            $table->boolean('asistencia');
            $table->text('comentario')->nullable();
            $table->timestamp('fecha')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('asistencia');
    }
};

