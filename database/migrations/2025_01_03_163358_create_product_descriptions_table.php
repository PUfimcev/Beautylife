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
        Schema::create('product_descriptions', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')
            ->references('id')->on('products')
            ->onDelete('cascade');
            $table->text('about')->nullable();
            $table->text('about_en')->nullable();
            $table->text('description')->nullable();
            $table->text('description_en')->nullable();
            $table->text('application')->nullable();
            $table->text('application_en')->nullable();
            $table->string('origin')->nullable();
            $table->string('origin_en')->nullable();
            $table->text('ingredients')->nullable();
            $table->text('ingredients_en')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_descriptions');
    }
};
