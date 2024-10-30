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
        Schema::create('items_leilao', function (Blueprint $table) {
            $table->id();
            $table->integer('items_contrato_id')->nullable();
            $table->text('status')->nullable();
            $table->boolean('sold')->nullable();
            $table->integer('leilao_id')->nullable();
            $table->integer('leilao_lote')->nullable();
            $table->integer('start_price')->nullable();
            $table->integer('min_estimate')->nullable();
            $table->integer('max_estimate')->nullable();
            $table->integer('price')->nullable();
            $table->integer('buyer_id')->nullable();
            $table->decimal('commission_buyer')->nullable();
            $table->decimal('commission_seller')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itemsleilao');
    }
};
