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
        Schema::create('saloons', function (Blueprint $table) {
            $table->id();
            $table->integer('city_id');
            $table->string('street');
            $table->string('home');
            $table->string('picture');
            $table->time('open');
            $table->time('close');
            $table->string('number_phone');
            $table->text('description')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('saloons');
    }
};
