<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use Carbon\Carbon;
use App\Models\Bookmark;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    /**
    * @return \Illuminate\Database\Eloquent\Relations\HasOne
    */
    public function bookmark(): HasOne
    {
        return $this->hasOne(Bookmark::class);
    }

    /**
     * Varifying the status of a user as administrator
     * @return :bool
     */

    public function isAdmin() :bool
    {
        return $this->is_admin === 1;
    }

    /**
     * Create accessor for attribute created_at
     * @return created_at
     */

     public function getCreatedAtAttribute($value)
     {
        return Carbon::createFromFormat('Y-m-d H:i:s', $value)->format('d.m.Y');
     }

}
