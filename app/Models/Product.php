<?php

namespace App\Models;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Str;
use App\Classes\HandleOrder;
use App\Traits\Translatable;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Http\Controllers\Person\BookmarkController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\{HasOne, HasMany, BelongsTo, BelongsToMany, HasOneThrough};
use App\Models\{Brand, Agerange, Bookmark, Category, Consumer, Property, ProductImage, ProductDescription, SkinType, Subcategory};

class Product extends Model
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
        'slug',
        'slug_en',
        'code',
        'name',
        'name_en',
        'price',
        'reduced_price',
        'amount',
        'new',
        'top',
    ];

    /**
     * Get the route key for the model.
     */
    public function getRouteKeyName(): string
    {
        return 'slug_en';
    }

    /**
    * Create mutator for attribute slug
    *
    * @param  mixed $value
    * @return void
    */
    public function setSlugAttribute($value)
    {
       $this->attributes['slug'] = Str::slug(Str::lower($value));
    }

    public function setSlugEnAttribute($value)
    {
        $this->attributes['slug_en'] = Str::slug(Str::lower($value));
    }

    public function setPriceAttribute($value)
    {
         $this->attributes['price'] = ($value === null) ? 0 : $value;
    }

    public function setReducedPriceAttribute($value)
    {
         $this->attributes['reduced_price'] = ($value === null) ? 0 : $value;
    }

    public function setAmountAttribute($value)
    {

         $this->attributes['amount'] = ($value === null) ? 0 : $value;
    }

    public function setNewAttribute($value)
    {

        $this->attributes['new'] = $value === null ? 0 : 1;
    }

    public function setTopAttribute($value)
    {

         $this->attributes['top'] = ($value === null) ? 0 : 1;
    }

    public function isNew()
    {
        return $this->new === 1;
    }

    public function isTop()
    {
        return $this->top === 1;
    }

    public function isSale()
    {
        return $this->reduced_price > 0;
    }


    /**
    * @return \Illuminate\Database\Eloquent\Relations\HasMany
    */
    public function productImages(): HasMany
    {
        return $this->hasMany(ProductImage::class);
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\HasOne
    */
    public function property(): HasOne
    {
        return $this->hasOne(Property::class);
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\HasOne
    */
    public function productDescription(): HasOne
    {
        return $this->hasOne(ProductDescription::class);
    }

    /**
    * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
    */
    public function bookmarks(): BelongsToMany
    {
        // return $this->belongsToMany(Bookmark::class)->withTimestamps()->withPivot('created_at');
        return $this->belongsToMany(Bookmark::class)->withTimestamps();

    }


    /**
    * @return BelongsToMany
    */
    public function orders()
    {
        return $this->belongsToMany(Order::class)->withPivot('amount', 'current_price', 'sum');
    }

    /**
     *
     */
    public function scopeSearch($query, string $keyword)
    {
        return $query->where('code', 'like',"%$keyword%")->orWhere('name', 'like', "%$keyword%")->orWhere('name_en', 'like', "%$keyword%");
    }


    public function scopeGetCategory($query)
    {

        if(isset($this->category_id)){
            $category = Category::withTrashed()->findOrFail($this->category_id);
        } else {

            $category = Product::withTrashed()->findOrFail($this->id)->property->category;
        }

        return $category;
    }

    public function scopeGetSubcategory($query)
    {

        if(isset($this->subcategory_id)){
            $subcategory = Subcategory::withTrashed()->findOrFail($this->subcategory_id);
        } else {

            $subcategory = Product::withTrashed()->findOrFail($this->id)->property->subcategory;
        }

        return $subcategory;
    }

    public function scopeGetSubcategories($query)
    {
        $subcategories = Product::withTrashed()->findOrFail($this->id)->property->category->subcategories;

        return $subcategories;
    }

    public function scopeGetBrand($query)
    {
        $brand = Product::withTrashed()->findOrFail($this->id)->property->brand;

        return $brand;
    }
    public function scopeGetSkinType($query)
    {
        $skinType = Product::withTrashed()->findOrFail($this->id)->property->skinType;

        return $skinType;
    }
    public function scopeGetAgerangeType($query)
    {
        $agerangeType = Product::withTrashed()->findOrFail($this->id)->property->agerange;

        return $agerangeType;
    }

    public function scopeGetConsumer($query)
    {
        $consumer = Product::withTrashed()->findOrFail($this->id)->property->consumer;

        return $consumer;
    }

    public function scopeGetPicture($query, $id)
    {

        return Product::withTrashed()->findOrFail($this->id)->productImages->where('id', $id)->first();
    }

    public function scopeSimilarProducts($query, $subcategoryId)
    {
        $similarProducts = Product::whereIn('id', function (Builder $query) use ($subcategoryId) {
            $query->select('product_id')
                ->from('properties')
                ->whereColumn('properties.product_id', 'products.id')->where('properties.subcategory_id', $subcategoryId);
            })->whereNot('id', $this->id);
        return $similarProducts;
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

     /**
      *  To check if there is a product in bookmark
       * @return boolean
      */
     public function isProductInBookmark()
     {
        $getBookmark = User::find(Auth::id())->bookmark;

        $arrayProductIds = BookmarkController::getArrayProductIds($getBookmark);

        if(!$arrayProductIds || $arrayProductIds === []) return;

        return in_array($this->id, $arrayProductIds) ? true : false;

     }

     /**
      *  To check if there is a product in basket
       * @return boolean
      */
     public function isProductInBasket()
     {
        // if(session()->has('order')){

        //     $order = session()->get('order');

        // }
        // else {

            if(!Auth::check()) return false;

            $order = HandleOrder::restoreAuthReservedOrder();

        // }


        return ($order->products->contains($this)) ? true : false;
        // return $order->products;

     }



}
