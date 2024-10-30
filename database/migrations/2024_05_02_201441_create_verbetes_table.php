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
        Schema::create('verbetes', function (Blueprint $table) {
            $table->id();
            $table->text('name')->nullable();
            $table->text('author')->nullable();
            $table->text('title')->nullable();
            $table->text('mentions')->nullable();
            $table->tinyText('place')->nullable();
            $table->tinyText('printer')->nullable();
            $table->tinyText('date')->nullable();
            $table->tinyText('colaccao')->nullable();
            $table->longText('comment')->nullable();
            $table->longText('comment_en')->nullable();
            $table->text('bibliography')->nullable();
            $table->tinyText('tags')->nullable();
            $table->text('notes')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('verbetes');
    }
};
