<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enlace', function (Blueprint $table) {
            $table->id();
            $table->string('url', 225);
            $table->string('descripcion', 225);
            $table->foreignId('idMa')->constrained('materias')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enlace');
    }
};

