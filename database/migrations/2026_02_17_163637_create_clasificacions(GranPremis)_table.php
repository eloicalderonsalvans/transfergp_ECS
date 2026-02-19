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
        Schema::create('gran_premis', function (Blueprint $table) {
            $table->id();
            $table->string('Nom_gp');
            $table->string('Nom_circuit');
            $table->string('Localitzacio');
            $table->integer('Capacitat')->nullable();
            $table->foreignId('ID_Temporada')->constrained('temporadas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gran_premis');
    }
};
