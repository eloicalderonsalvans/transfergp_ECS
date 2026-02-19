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
        Schema::create('historial_v_mercats', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ID_Pilot')->constrained('pilots')->onDelete('cascade');
            $table->date('Data_valoracio');
            $table->decimal('Valor_mercat', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('historial_v_mercats');
    }
};
