<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('periodo_clases', function (Blueprint $table) {
            $table->id();
            $table->integer('fecha_inicio');
            $table->integer('fecha_final');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('periodo_clases');
    }
};

