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
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('carga_id');
            $table->foreign('carga_id')->references('id')->on('cargas');
            $table->unsignedBigInteger('cliente_id');
            $table->foreign('cliente_id')->references('id')->on('clientes');
            $table->decimal('peso_real', 8, 1); // Exemplo: Decimal com 8 dígitos totais e 2 casas decimais
            $table->decimal('peso_cobrado', 8, 1);
            $table->decimal('valor_cobrado', 10, 2); // Exemplo: Decimal com 10 dígitos totais e 2 casas decimais
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('invoices');
    }
};
