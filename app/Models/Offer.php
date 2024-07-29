<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Brand;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
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
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function brands()
    {
        return $this->belongsToMany(Brand::class);
    }

    /**
     * Create accessor for attribute period_from
     * @return updated_at
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
     * @return updated_at
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
