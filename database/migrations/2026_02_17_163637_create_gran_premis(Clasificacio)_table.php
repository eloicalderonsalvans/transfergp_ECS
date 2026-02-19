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
        Schema::create('clasificacions', function (Blueprint $table) {
            $table->id();
            $table->foreignId('ID_Pilot')->constrained('pilots')->onDelete('cascade');
            $table->foreignId('ID_GranPremi')->constrained('gran_premis')->onDelete('cascade');
            $table->integer('posicio');
            $table->integer('Punts');
            $table->boolean('Estat');
            $table->decimal('Volta_rapida', 8, 3)->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clasificacions');
    }
};
