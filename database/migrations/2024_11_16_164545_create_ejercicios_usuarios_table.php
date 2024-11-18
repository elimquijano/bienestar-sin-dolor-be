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
        Schema::create('ejercicios_usuarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('sesion_usuario_id')->constrained('sesion_usuarios')->cascadeOnDelete();
            $table->foreignId('ejercicio_guia_id')->constrained('ejercicios_guias')->cascadeOnDelete();
            $table->decimal('progreso_ejercicio', 5, 2)->default(0.00); // Progreso específico del usuario
            $table->enum('estado', ['Pendiente', 'Completo', 'Requiere Repetición'])->default('Pendiente');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ejercicios_usuarios');
    }
};
