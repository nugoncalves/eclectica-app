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
        Schema::create('bids_imports', function (Blueprint $table) {
            $table->id();
            $table->integer('items_contrato_id')->nullable();
            $table->integer('items_leilao_id')->nullable();
            $table->text('type')->nullable();
            $table->integer('leilao_id')->nullable();
            $table->integer('lot_index')->nullable();
            $table->integer('bid_price')->nullable();
            $table->text('bid_type')->nullable();
            $table->dateTime('bid_time')->nullable();
            $table->tinyInteger('sold_bid')->nullable();
            $table->integer('bidder_id')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('bids_imports');
    }
};
