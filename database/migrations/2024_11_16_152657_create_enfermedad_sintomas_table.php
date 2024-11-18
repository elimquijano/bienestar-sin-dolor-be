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
        Schema::create('enfermedad_sintomas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('enfermedad_id')->constrained('enfermedads')->cascadeOnDelete();
            $table->foreignId('sintoma_id')->constrained('sintomas')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('enfermedad_sintomas');
    }
};
