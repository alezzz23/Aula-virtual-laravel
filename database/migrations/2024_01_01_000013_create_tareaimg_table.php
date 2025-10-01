<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('tareaimg', function (Blueprint $table) {
            $table->id();
            $table->string('nombre', 50);
            $table->string('ruta', 200);
            $table->foreignId('idMa')->constrained('materias')->onUpdate('cascade');
            $table->string('descripcion', 70);
            $table->timestamp('fecha')->useCurrent();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('tareaimg');
    }
};

