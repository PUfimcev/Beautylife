<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Brand;
use Illuminate\Support\Str;
use App\Traits\Translatable;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Offer extends Model
{
    use HasFactory, Translatable, SoftDeletes;

    /**
     * The attributes that are transfigured into date.
     *
     * @var array<int, string>
     */

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */

    protected $fillable = [
        'title',
        'title_en',
        'slug',
        'slug_en',
        'about',
        'about_en',
        'image_route',
        'description',
        'description_en',
        'discount_size',
        'period_from',
        'period_to',

    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        $slug = 'slug';

        if(session('locale') == 'en'){

            $slug = 'slug_en';
        } else if (session('locale') == 'ru'){

            $slug = 'slug';
        }

        return $slug;

    }

    public function scopeGetOffer($query, $url)
    {
        return $query->where('slug_en', $url)->orWhere('slug', $url);
    }


    protected function setSlugAttribute($value) :void
    {
        $this->attributes['slug'] = Str::slug($value);
    }

    protected function setSlugEnAttribute($value) :void
    {
        $this->attributes['slug_en'] = Str::slug($value);
    }


    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function brands()
    {
        return $this->belongsToMany(Brand::class);
    }

    /**
     * Create accessor for attribute period_from
     * @return period_from
     */

     public function getPeriodFromAttribute($value)
     {
        // $local_timezone = session()->get('timezone');

        if($value == null) return;

        // return Carbon::createFromFormat('Y-m-d H:i:s', $value)->setTimezone($local_timezone);
        return Carbon::createFromFormat('Y-m-d H:i:s', $value);

     }

    /**
     * Create accessor for attribute period_to
     * @return period_to
     */

     public function getPeriodToAttribute($value)
     {
        // $local_timezone = session()->get('timezone');

        if($value == null) return;

        // return Carbon::createFromFormat('Y-m-d H:i:s', $value)->setTimezone($local_timezone);
        return Carbon::createFromFormat('Y-m-d H:i:s', $value);

     }

    /**
     * Create accessor for attribute created_at
     * @return created_at
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
