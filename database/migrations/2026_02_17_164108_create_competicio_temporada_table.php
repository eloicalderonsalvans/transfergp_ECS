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
        Schema::create('competicio_temporada', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ID_Competicio')->constrained('competicions')->onDelete('cascade');
            $table->foreignId('ID_Temporada')->constrained('temporadas')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('competicio_temporada');
    }
};
