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
        Schema::create('properties', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id')
            ->references('id')->on('products')
            ->onDelete('cascade');
            $table->unsignedBigInteger('category_id');
            $table->foreign('category_id')
            ->references('id')->on('categories')
            ->onDelete('cascade');
            $table->unsignedBigInteger('subcategory_id');
            $table->foreign('subcategory_id')
            ->references('id')->on('subcategories')
            ->onDelete('cascade');
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')
            ->references('id')->on('brands')
            ->onDelete('cascade');
            $table->unsignedBigInteger('skin_type_id');
            $table->foreign('skin_type_id')
            ->references('id')->on('skin_types')
            ->onDelete('cascade');
            $table->unsignedBigInteger('agerange_id');
            $table->foreign('agerange_id')
            ->references('id')->on('ageranges')
            ->onDelete('cascade');
            $table->unsignedBigInteger('consumer_id');
            $table->foreign('consumer_id')
            ->references('id')->on('consumers')
            ->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
