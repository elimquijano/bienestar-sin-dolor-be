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
        Schema::create('frames_usuarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ejercicio_usuario_id')->constrained('ejercicios_usuarios')->cascadeOnDelete();
            $table->integer('numero_frame');
            $table->json('coordenadas'); // Coordenadas captadas del usuario (JSON)
            $table->boolean('valido')->default(false); // Si el frame cumple con los parámetros guía
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('frames_usuarios');
    }
};
