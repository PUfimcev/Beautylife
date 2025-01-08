<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\Product;
use Illuminate\Support\Str;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class SkinType extends Model
{
    use HasFactory, Translatable,  SoftDeletes;

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
        'code',
        'name',
        'name_en',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'code';
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function properties(): HasMany
    {
        return $this->hasMany(Property::class);
    }

    /**
      * Create mutator for attribute code
      *
      * @param  mixed $value
      * @return void
      */
      public function setCodeAttribute($value)
      {
         $this->attributes['code'] = Str::slug(Str::lower($value));
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
