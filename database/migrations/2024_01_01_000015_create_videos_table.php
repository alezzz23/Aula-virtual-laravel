<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('nombre');
            $table->string('tipo', 50);
            $table->string('ruta');
            $table->string('descripcion', 70);
            $table->foreignId('idMa')->constrained('materias')->onUpdate('cascade');
            $table->timestamp('fecha_subida')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('videos');
    }
};

