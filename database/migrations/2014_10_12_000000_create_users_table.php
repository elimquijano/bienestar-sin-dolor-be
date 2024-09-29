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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('firstname');
            $table->string('lastname');
            $table->string('birthdate');
            $table->string('gender');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image')->default('images/profile.png');
            $table->string('dni')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('location')->nullable();
            $table->timestamp('email_verified_at')->nullable();
            $table->boolean('active')->default(true);
            $table->rememberToken();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};
