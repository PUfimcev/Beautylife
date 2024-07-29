<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Blog extends Model
{
    use HasFactory, Translatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'blog_title',
        'blog_title_en',
        'slug',
        'blog_image_route',
        'blog_summary',
        'blog_summary_en',
        'blog_subtitle_1',
        'blog_subtitle_1_en',
        'blog_paragraph_1',
        'blog_paragraph_1_en',
        'blog_subtitle_2',
        'blog_subtitle_2_en',
        'blog_paragraph_2',
        'blog_paragraph_2_en',
        'blog_subtitle_3',
        'blog_subtitle_3_en',
        'blog_paragraph_3',
        'blog_paragraph_3_en',
        'blog_subtitle_4',
        'blog_subtitle_4_en',
        'blog_paragraph_4',
        'blog_paragraph_4_en',
        'blog_subtitle_5',
        'blog_subtitle_5_en',
        'blog_paragraph_5',
        'blog_paragraph_5_en',
        'blog_subtitle_6',
        'blog_subtitle_6_en',
        'blog_paragraph_6',
        'blog_paragraph_6_en',
        'blog_subtitle_7',
        'blog_subtitle_7_en',
        'blog_paragraph_7',
        'blog_paragraph_7_en',
        'blog_subtitle_8',
        'blog_subtitle_8_en',
        'blog_paragraph_8',
        'blog_paragraph_8_en',
        'blog_subtitle_9',
        'blog_subtitle_9_en',
        'blog_paragraph_9',
        'blog_paragraph_9_en',
        'blog_subtitle_10',
        'blog_subtitle_10_en',
        'blog_paragraph_10',
        'blog_paragraph_10_en',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug';
    }


    /**
     * Create accessor for attribute created_at
     * @return updated_at
     */

     public function getCreatedAtAttribute($value)
     {
        $local_timezone = session()->get('timezone');
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->setTimezone($local_timezone);
     }

    /**
     * Create accessor for attribute updated_at
     * @return updated_at
     */

     public function getUpdatedAtAttribute($value)
     {
        $local_timezone = session()->get('timezone');
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->setTimezone($local_timezone);
     }
}
