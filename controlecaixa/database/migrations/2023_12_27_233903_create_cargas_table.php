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
        Schema::create('cargas', function (Blueprint $table) {
            $table->id();
            $table->date('data_enviada');
            $table->date('data_recebida')->nullable();
            $table->decimal('peso_guia', 8, 1)->nullable();
            $table->enum('tipo', ['Aereo', 'Maritimo'])->default('Aereo');
            $table->enum('embarcador', ['Peniel', 'Transway'])->default('Peniel');
            $table->enum('despachante', ['Heriberto', 'Adrian'])->default('Heriberto');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cargas');
    }
};
