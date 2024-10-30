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
        Schema::create('contratos', function (Blueprint $table) {
            $table->id();
            $table->text('date')->nullable();
            $table->text('seller_reference')->nullable();
            $table->integer('seller_id')->nullable();
            $table->text('commission_type')->nullable();
            $table->string('commission_300')->nullable();
            $table->string('commission_1000')->nullable();
            $table->string('commission_3000')->nullable();
            $table->string('commission_more_3000')->nullable();
            $table->text('notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contratos');
    }
};
