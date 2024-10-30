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
        Schema::create('items_contrato', function (Blueprint $table) {
            $table->id();
            $table->integer('verbete_id')->nullable();
            $table->text('date_entry')->nullable();
            $table->text('date_out')->nullable();
            $table->integer('contrato_id')->nullable();
            $table->integer('contrato_index')->nullable();
            $table->integer('seller_id')->nullable();
            $table->string('status')->nullable();
            $table->string('seller_reference')->nullable();
            $table->integer('reserve')->nullable();
            $table->longText('main_lang_name')->nullable();
            $table->longText('second_lang_name')->nullable();
            $table->longText('main_lang_desc')->nullable();
            $table->longText('second_lang_desc')->nullable();
            $table->mediumText('notes')->nullable();
            $table->tinyText('tags')->nullable();
            $table->float('commission_client')->nullable();
            $table->float('commission_seller_300')->nullable();
            $table->float('commission_seller_1000')->nullable();
            $table->float('commission_seller_3000')->nullable();
            $table->float('commission_seller_more_3000')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('itemscontrato');
    }
};
