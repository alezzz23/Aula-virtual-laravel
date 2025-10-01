<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tarea', function (Blueprint $table) {
            $table->id();
            $table->text('descripcion');
            $table->string('archivo', 250);
            $table->foreignId('idMa')->constrained('materias')->onUpdate('cascade');
            $table->timestamp('fecha')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tarea');
    }
};

