<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('notas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('alumno')->constrained('usuarios');
            $table->string('lapso', 20);
            $table->integer('1era')->default(0);
            $table->integer('2da')->default(0);
            $table->integer('3era')->default(0);
            $table->integer('4ta')->default(0);
            $table->integer('adicionales')->default(0);
            $table->integer('total')->default(0);
            $table->foreignId('idMa')->constrained('materias')->onUpdate('cascade');
            $table->foreignId('curso')->constrained('cursos')->onUpdate('cascade');
            $table->foreignId('periodo')->nullable()->constrained('periodo_clases')->onUpdate('cascade')->nullOnDelete();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('notas');
    }
};

