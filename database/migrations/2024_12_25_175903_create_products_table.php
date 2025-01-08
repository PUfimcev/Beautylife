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
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('slug_en');
            $table->string('code');
            $table->string('name');
            $table->string('name_en');
            $table->decimal('price', 10, 2)->default(0.00);
            $table->decimal('reduced_price', 10, 2)->default(0.00);
            $table->mediumInteger('amount')->default(0);
            $table->tinyInteger('new')->default(0);
            $table->tinyInteger('top')->default(0);
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('products');
    }
};
