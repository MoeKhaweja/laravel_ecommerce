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
            $table->string('username')->unique()->notNullable();
            $table->string('password')->notNullable();
            $table->string('email')->unique()->notNullable();
            $table->string('first_name')->notNullable();
            $table->string('last_name')->notNullable();
            $table->unsignedBigInteger('user_type_id')->notNullable();
            $table->timestamps();
            
            $table->foreign('user_type_id')->references('id')->on('user_types');
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
