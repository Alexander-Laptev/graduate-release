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
        Schema::create('employees', function (Blueprint $table) {
            $table->id();
            $table->integer('user_id')->nullable();
            $table->string('name')->nullable();
            $table->string('surname');
            $table->string('patronymic')->nullable();
            $table->date('birthday')->nullable();
            $table->date('workday')->nullable();
            $table->boolean('gender')->nullable();
            $table->integer('experience')->nullable();
            $table->string('address')->nullable();
            $table->string('number_phone')->unique();
            $table->integer('post_id');
            $table->integer('saloon_id');
            $table->string('picture')->nullable();
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('employees');
    }
};
