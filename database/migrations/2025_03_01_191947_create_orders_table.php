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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')
            ->references('id')->on('users')
            ->onDelete('cascade');
            $table->unsignedBigInteger('unregistered_customer_id')->nullable();
            $table->foreign('unregistered_customer_id')
            ->references('id')->on('unregistered_customers')
            ->onDelete('cascade');
            $table->string('carrency')->default('BYN');
            $table->decimal('total_price', 10, 2)->default(0.00);
            $table->unsignedInteger('name_id')->nullable();
            $table->unsignedInteger('phone_id')->nullable();
            $table->unsignedInteger('address_id')->nullable();
            $table->text('comment')->nullable();
            $table->string('delivery')->default(0);
            $table->string('payment')->nullable();;
            $table->boolean('confirmed')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};
