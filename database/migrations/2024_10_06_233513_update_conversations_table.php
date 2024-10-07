<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('conversations', function (Blueprint $table) {
            $table->integer('tipo_id')->default(1)->after('id'); // Agregar tipo_id
            // Puedes agregar más columnas o cambios aquí
        });
    }

    public function down()
    {
        Schema::table('conversations', function (Blueprint $table) {
            $table->dropColumn('tipo_id'); // Eliminar tipo_id si se revierte
            // Eliminar más columnas o cambios aquí si es necesario
        });
    }
};
