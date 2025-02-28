<?php

namespace App\Classes;

// use App\Models\Product;
use App\Models\Product;
use Illuminate\Support\Facades\App;
use Illuminate\Database\Query\Builder;
use App\Classes\MainAbstractProductFilter;

class GetProducts extends MainAbstractProductFilter
{

    public function getNewArrivals(int $numberOffers = null)
    {
        if($numberOffers) {
            $newProducts =  $this->productBuilder->where('new', '1')->inRandomOrder()->limit($numberOffers)->get();
        } else {
            $newProducts =  $this->productBuilder->where('new', '1')->get();
        }

        return $newProducts;
    }


    public function getBestsellers(int $numberOffers = 0)
    {
        if($numberOffers) {
            $topProducts =  $this->productBuilder->where('top', '1')->inRandomOrder()->limit($numberOffers)->get();
        } else {
            $topProducts =  $this->productBuilder->where('top', '1')->get();
        }

        return $topProducts;
    }


    public function getBrandProducts($queryBrand)
    {
        $this->productBuilder->whereIn('id', function (Builder $query) use ($queryBrand) {
            $query->select('product_id')
                ->from('properties')
                ->whereColumn('properties.product_id', 'products.id')->where('properties.brand_id', $queryBrand);
            })->where('top', '1')->inRandomOrder()->limit(3);
    }


    public function getResult($searchQuery)
    {

        if(!$searchQuery) return [];

        if(session('locale') == 'en'){
            $nameColumn = 'name_en';
            $slug = 'products.slug_en';
            $name = 'products.name_en';
            $about = 'product_descriptions.about_en';
        } elseif (session('locale') == 'ru'){
            $nameColumn = 'name';
            $slug = 'products.slug_en';
            $name = 'products.name';
            $about = 'product_descriptions.about';
        }

        $searchQuery = $this->productBuilder->join('product_descriptions', 'products.id', '=', 'product_descriptions.product_id')->select('products.id', $slug, $name, 'products.price', 'products.reduced_price', 'products.amount', $about)->where($nameColumn , 'like',"%$searchQuery%")->chunk(8, function($products){

            foreach($products as $product){

                if(session('locale') == 'en'){
                    $name = $product->name_en;
                    $about = $product->about_en;
                    $currancy = 'USD';
                    $productAvailability = 'Not available';
                    $slug = $product->slug_en;
                } elseif (session('locale') == 'ru'){
                    $name = $product->name;
                    $about = $product->about;
                    $currancy = 'BYN';
                    $productAvailability = 'Нет в наличии';
                    $slug = $product->slug_en;
                }


                $category = $product->getCategory()->first();
                $subcategory = $product->getSubcategory()->first();

                $urlMain = explode('/', request()->url());
                array_pop($urlMain);
                $urlMain = implode('/', $urlMain);

                $urlImg = $urlMain.'/storage/'.$product->productImages[0]->route;

                $urlProduct = $urlMain.'/'.$category->code.'/'.$subcategory->code.'/'.$slug;

                $showHidePrice = ($product->amount > 0) ? 'display: flex' : 'display: none';
                $showHideAvailability = ($product->amount > 0) ? 'display: none' : 'display: flex';
                $showHideReducedPrice = ($product->reduced_price > 0) ? 'display: block' : 'display: none';
                $crossedPrice = ($product->reduced_price > 0) ? 'class="crossedPrice"' : '';

                    echo  "
                        <li class=\"product__founded\" >
                            <a href=\"$urlProduct\" title=\"$name\">
                                <div class=\"search_desktop\">
                                    <div class=\"product__image\" ><img src=\"$urlImg\" alt=\"Image\" /></div>
                                    <div class=\"product__description\">
                                        <p class=\"product__name\">$name</з>
                                        <p>{$about}</p>
                                    </div>
                                    <div style=\"$showHidePrice\" class=\"product__price\">
                                        <span >$currancy</span>
                                        <span $crossedPrice>$product->price</span>
                                        <span style=\"$showHideReducedPrice\">$product->reduced_price</span>
                                    </div>
                                    <div style=\"$showHideAvailability\" class=\"product__availability\">
                                        <span >$productAvailability</span>
                                    </div>
                                </div>
                                <div class=\"search_mob\">
                                    <div class=\"product__image\" >
                                        <img src=\"$urlImg\" alt=\"Image\" />
                                        <div style=\"$showHidePrice\" class=\"product__price\">
                                            <span >$currancy</span>
                                            <span $crossedPrice>$product->price</span>
                                            <span style=\"$showHideReducedPrice\">$product->reduced_price</span>
                                        </div>
                                        <div style=\"$showHideAvailability\" class=\"product__availability\">
                                            <span >$productAvailability</span>
                                        </div>
                                    </div>
                                    <div class=\"product__description\">
                                        <p class=\"product__name\">$name</з>
                                        <p>{$about}</p>
                                    </div>
                                </div>
                            </a>

                        </li>
                    ";
            }
        });
    }

}
