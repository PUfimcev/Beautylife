<?php

namespace App\Models;

use Carbon\Carbon;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Message extends Model
{
    use HasFactory, Translatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'subject',
        'subject_en',
        'type',
        'additional_info',
        'additional_info_en',
    ];

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

        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->setTimezone($local_timezone)->format('H:i / d.m.Y');

     }

}
