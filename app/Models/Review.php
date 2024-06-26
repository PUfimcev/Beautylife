<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\Translatable;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Review extends Model
{
    use HasFactory, Translatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'reviewer_name',
        'reviewer_image_route',
        'backdrop_image',
        'evaluation',
        'review_content',
        'edited',
    ];

    /**
     * Create scope for attribute edited
     * @return created_at
     */
    public function scopeEdited($query)
    {
        return $query->where('edited', 1);
    }

    /**
     * Create accessor for attribute edited
     * @return created_at
     */

    public function getEditedAttribute($value)
    {

        if(App::getLocale() === 'en'){

            return $value == '0' ? 'No' : 'Yes';
        }

        return $value == '0' ? 'Нет' : 'Да';

    }

    /**
     * Create accessor for attribute edited
     * @return created_at
     */

    public function getReviewerImageRouteAttribute($value)
    {
        return isset($value) ? '/'.config('app.name').'/storage/app/'.$value : '';
    }

    /**
     * Create accessor for attribute created_at
     * @return created_at
     */

    public function getCreatedAtAttribute($value)
    {
       $local_timezone = session()->get('timezone');
       return Carbon::createFromFormat('Y-m-d H:i:s', $value)->setTimezone($local_timezone)->format('H:i / d.m.Y');
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
