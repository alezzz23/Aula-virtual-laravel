<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('personalizar', function (Blueprint $table) {
            $table->id();
            $table->string('colegio', 200);
            $table->string('logo', 200);
            $table->string('color', 200);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('personalizar');
    }
};

