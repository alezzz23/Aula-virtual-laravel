<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('prof_guia', function (Blueprint $table) {
            $table->id();
            $table->foreignId('usuario')->nullable()->constrained('usuarios');
            $table->foreignId('curso')->nullable()->constrained('cursos');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('prof_guia');
    }
};

