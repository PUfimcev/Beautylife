<?php

namespace App\Models;

use App\Models\User;
use App\Traits\Translatable;
use App\Models\UnregisteredCustomer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Order extends Model
{
    use HasFactory, Translatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'user_id',
        'unregistered_customer_id',
        'carrency',
        'total_price',
        'name_id',
        'phone_id',
        'address_id',
        'comment',
        'delivery',
        'payment',
        'confirmed'
    ];

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }



    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function unregisteredCustomer(): BelongsTo
    {
        return $this->belongsTo(UnregisteredCustomer::class);
    }


}
