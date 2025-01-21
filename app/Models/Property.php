<?php

namespace App\Models;

use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Property extends Model
{
    use HasFactory;

         /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'category_id',
        'subcategory_id',
        'brand_id',
        'skin_type_id',
        'agerange_id',
        'consumer_id',
    ];

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }


    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function subcategory(): BelongsTo
    {
        return $this->belongsTo(Subcategory::class);
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function brand(): BelongsTo
    {
        return $this->belongsTo(Brand::class);
    }
    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function skinType(): BelongsTo
    {
        return $this->belongsTo(SkinType::class);
    }
    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function agerange(): BelongsTo
    {
        return $this->belongsTo(Agerange::class);
    }
    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
    */
    public function consumer(): BelongsTo
    {
        return $this->belongsTo(Consumer::class);
    }



}
