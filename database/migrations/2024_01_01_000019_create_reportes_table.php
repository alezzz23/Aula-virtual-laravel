<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('reportes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario')->constrained('usuarios');
            $table->string('comentario', 999);
            $table->foreignId('idMa')->constrained('materias')->onUpdate('cascade');
            $table->string('rol', 12);
            $table->timestamp('fecha')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('reportes');
    }
};

