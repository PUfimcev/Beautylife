<?php

namespace App\Models;

use App\Models\Product;
use App\Traits\Translatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class ProductDescription extends Model
{
    use HasFactory, Translatable;

         /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'about',
        'about_en',
        'description',
        'description_en',
        'application',
        'application_en',
        'origin',
        'origin_en',
        'ingredients',
        'ingredients_en',
    ];

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

}
