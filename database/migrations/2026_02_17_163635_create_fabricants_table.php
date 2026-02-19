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
        Schema::create('fabricants', function (Blueprint $table) {
            $table->id();
            $table->string('Nom');
            $table->text('Descripcio')->nullable();
            $table->string('Pais_origen');
            $table->integer('M_constructors')->nullable();
            $table->boolean('Actiu');
            $table->string('Logo_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('fabricants');
    }
};
