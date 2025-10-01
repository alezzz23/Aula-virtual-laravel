<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('materias', function (Blueprint $table) {
            $table->id();
            $table->string('materia', 100);
            $table->foreignId('profesor')->constrained('usuarios');
            $table->foreignId('curso')->nullable()->constrained('cursos');
            $table->boolean('estado')->default(1);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('materias');
    }
};

