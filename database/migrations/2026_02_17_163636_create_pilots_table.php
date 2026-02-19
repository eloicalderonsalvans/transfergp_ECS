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
        Schema::create('pilots', function (Blueprint $table) {
            $table->id();
            $table->string('Nom');
            $table->string('Cognom');
            $table->string('Nacionalitat');
            $table->date('Data_neixament');
            $table->integer('Numero');
            $table->boolean('Estat_actiu');
            $table->integer('Mundials_guanyats')->default(0);
            $table->foreignId('ID_Equip')->constrained('equips')->onDelete('cascade');
             $table->string('Foto_url')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pilots');
    }
};
