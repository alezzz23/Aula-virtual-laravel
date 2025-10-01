<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guia', function (Blueprint $table) {
            $table->id();
            $table->string('descripcion', 20);
            $table->string('archivo', 250);
            $table->foreignId('idMa')->constrained('materias')->onUpdate('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guia');
    }
};

