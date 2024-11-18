<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('frames_guias', function (Blueprint $table) {
            $table->id();
            $table->foreignId('guia_ejercicio_id')->constrained('ejercicios_guias')->cascadeOnDelete();
            $table->integer('numero_frame');
            $table->json('coordenadas'); // JSON para almacenar puntos
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frames_guias');
    }
};
