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
        Schema::create('blogs', function (Blueprint $table) {
            $table->id();
            $table->string('blog_title');
            $table->string('blog_title_en');
            $table->string('slug')->unique();
            $table->string('blog_image_route')->nullable();
            $table->text('blog_summary')->nullable();
            $table->text('blog_summary_en')->nullable();
            $table->string('blog_subtitle_1')->nullable();
            $table->string('blog_subtitle_1_en')->nullable();
            $table->text('blog_paragraph_1')->nullable();
            $table->text('blog_paragraph_1_en')->nullable();
            $table->string('blog_subtitle_2')->nullable();
            $table->string('blog_subtitle_2_en')->nullable();
            $table->text('blog_paragraph_2')->nullable();
            $table->text('blog_paragraph_2_en')->nullable();
            $table->string('blog_subtitle_3')->nullable();
            $table->string('blog_subtitle_3_en')->nullable();
            $table->text('blog_paragraph_3')->nullable();
            $table->text('blog_paragraph_3_en')->nullable();
            $table->string('blog_subtitle_4')->nullable();
            $table->string('blog_subtitle_4_en')->nullable();
            $table->text('blog_paragraph_4')->nullable();
            $table->text('blog_paragraph_4_en')->nullable();
            $table->string('blog_subtitle_5')->nullable();
            $table->string('blog_subtitle_5_en')->nullable();
            $table->text('blog_paragraph_5')->nullable();
            $table->text('blog_paragraph_5_en')->nullable();
            $table->string('blog_subtitle_6')->nullable();
            $table->string('blog_subtitle_6_en')->nullable();
            $table->text('blog_paragraph_6')->nullable();
            $table->text('blog_paragraph_6_en')->nullable();
            $table->string('blog_subtitle_7')->nullable();
            $table->string('blog_subtitle_7_en')->nullable();
            $table->text('blog_paragraph_7')->nullable();
            $table->text('blog_paragraph_7_en')->nullable();
            $table->string('blog_subtitle_8')->nullable();
            $table->string('blog_subtitle_8_en')->nullable();
            $table->text('blog_paragraph_8')->nullable();
            $table->text('blog_paragraph_8_en')->nullable();
            $table->string('blog_subtitle_9')->nullable();
            $table->string('blog_subtitle_9_en')->nullable();
            $table->text('blog_paragraph_9')->nullable();
            $table->text('blog_paragraph_9_en')->nullable();
            $table->string('blog_subtitle_10')->nullable();
            $table->string('blog_subtitle_10_en')->nullable();
            $table->text('blog_paragraph_10')->nullable();
            $table->text('blog_paragraph_10_en')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('blogs');
    }
};
