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
        Schema::table('Offers', function (Blueprint $table) {
            // $table->string('slug')->unique()->after('title_en');
            // $table->string('slug_en')->unique()->after('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('Offers', function (Blueprint $table) {
            // $table->dropColumn('slug');
            // $table->dropColumn('slug_en');
        });
    }
};
