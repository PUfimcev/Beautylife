<?php

namespace App\Models;

use App\Models\Order;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class UnregisteredCustomer extends Model
{
    use HasFactory, Translatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'firstName',
        'lastName',
        'phone',
        'email',
        'street',
        'city',
        'country'
    ];

    /**
    * @return \Illuminate\Database\Eloquent\Relations\HasOne
    */
    public function order(): HasOne
    {
        return $this->hasOne(Order::class);
    }

}
