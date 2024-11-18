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
        Schema::create('sesion_usuarios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('tratamiento_usuario_id')->constrained('tratamientos_usuarios')->cascadeOnDelete();
            $table->foreignId('sesion_guia_id')->constrained('sesiones_guias')->cascadeOnDelete();
            $table->date('fecha');
            $table->decimal('progreso_sesion', 5, 2)->default(0.00); // Porcentaje alcanzado en la sesión
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sesion_usuarios');
    }
};
