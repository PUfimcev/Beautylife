<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Offer;
use App\Models\Review;
use App\Models\Product;
use App\Models\Category;
use App\Classes\GetBlogs;
use App\Classes\GetOffers;
use App\Classes\GetReviews;
use App\Models\Subcategory;
use Illuminate\Support\Str;
use App\Classes\GetProducts;
use App\Classes\SearchClass;
use App\Traits\Translatable;
use Illuminate\Http\Request;
use Illuminate\View\ViewName;
use App\Classes\CategoryFilter;
use Illuminate\Support\Facades\DB;
use App\Classes\RemoveSessionClass;
use Illuminate\Support\Facades\App;
use App\Classes\GetCatalogTopNewData;
use Illuminate\Database\Query\Builder;
use Illuminate\Support\Facades\Cookie;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Query\JoinClause;

class MainController extends Controller
{

    use Translatable;

    public function main()
    {
        (new RemoveSessionClass())->removeSessionPrevUrl();

        return view('pages.main');

    }

    public function about()
    {
        (new RemoveSessionClass())->removeSessionPrevUrl();

        return view('pages.about');
    }

    public function offers(Offer $offer = null)
    {

        (new RemoveSessionClass())->removeSessionPrevUrl();

        if(!isset($offer)) {

            $offers = (new GetOffers())->getOffers();
            $offersArch = (new GetOffers(0,'archive'))->getOffers();

            return view('pages.offers', compact('offers', 'offersArch'));

        } else {

            return view('pages.elements.offer_full', compact('offer'));
        }
    }

    /**
     * catalog
     *
     * @param  mixed $category
     * @return void
     */
    public function catalog(Request $request, Category $category = null)
    {
        (new RemoveSessionClass())->removeSessionPrevUrl();

        if(!isset($category)) {

            $categories = CategoryFilter::getCatalogs();

            return view('pages.catalog', compact('categories'));
        } else {
            list($brands, $skintypes, $ageranges, $consumers) = CategoryFilter::getCatalogOptionData();

            if(count($request->all()) == 0){

                $query['getCatalogProducts'] = $category->id;

                $productQuery = Product::with(['productImages', 'property']);

                $productsPre = (new CategoryFilter($productQuery, $query))->apply();

                $products = $productsPre->paginate(12);

                $productsQuantity = $productsPre->count();

                return view('pages.elements.category_full', compact('products'))->with(['count' => $productsQuantity, 'category' => $category, 'brands' => $brands, 'skintypes' => $skintypes, 'ageranges' => $ageranges, 'consumers' => $consumers]);

            } else {
                $query = $request->all();
                $query['getCatalogProducts'] = $category->id;

                $productQuery = Product::with(['productImages', 'property']);

                $productsPre = (new CategoryFilter($productQuery, $query))->apply();

                $products = $productsPre->paginate(12);


                $productsQuantity = $productsPre->count();

                return view('pages.elements.category_full', compact('products'))->with(['count' => $productsQuantity, 'category' => $category, 'brands' => $brands, 'skintypes' => $skintypes, 'ageranges' => $ageranges, 'consumers' => $consumers]);

            }

        }
    }

    /**
     * catalogTopNew
     *
     * @param  mixed $quality
     * @return view
     */

    public function catalogTopNew($quality)
    {
        (new RemoveSessionClass())->removeSessionPrevUrl();

        $query['getCatalogTopNewData'] = $quality;
        $productQuery = Product::with(['productImages', 'property.category']);

        $productsPre = (new GetCatalogTopNewData($productQuery, $query))->apply();

        $products = $productsPre->paginate(12);

        $productsCount = $productsPre->count();

        // dd($productsCount);


        $categories = CategoryFilter::getCatalogs();

        return view('pages.elements.categories_goods_top_new_all', compact('products', 'categories'))->with(['title'=> Str::ucfirst(Str::of($quality)->replace('-', ' ')), 'count' => $productsCount]);
    }

    public function getProduct(Category $category, Subcategory $subcategory, Product $product)
    {
        if(session('locale') == 'en'){

            dd('Producr '.$product->name_en);
        } else {
            dd('Producr '.$product->name);

        }
    }

    public function brands(Brand $brand = null)
    {
        (new RemoveSessionClass())->removeSessionPrevUrl();


        if(!isset($brand)) {

            $brands = Brand::orderBy('brand_name','asc')->paginate(9);

            return view('pages.brands', compact('brands'));

        } else {

            $query['getBrandProducts'] = $brand->id;

            $productQuery = Product::with(['productImages']);

            $products = (new GetProducts($productQuery, $query))->apply()->get();

            // dd($products);

            return view('pages.elements.brand_full', compact('brand', 'products'));
        }
    }

    public function conditions()
    {
        (new RemoveSessionClass())->removeSessionPrevUrl();

        return view('pages.conditions');
    }

    // get all blogs or selected

    public function blogs(Blog $blog = null)
    {
        (new RemoveSessionClass())->removeSessionPrevUrl();


        if(!isset($blog)) {
            $blogs = (new GetBlogs())->getBlogs();

            return view('pages.blogs', compact('blogs'));
        } else {

            return view('pages.elements.blog_full', compact('blog'));
        }

    }


    public function setLocale($locale = null)
    {

        if (!isset($locale) || !in_array($locale, config('app.available_locales'))) {
            $locale = config('app.locale');
        }

        // process code to swap slug/slug_en route in page offer depending on locale (en or ru) & by toggling lang link and get appropriate related data


        $getOffer = GetOffers::getLocaleOffer();

        session(['locale' => $locale]);
        App::setLocale($locale);

        if($getOffer == null) return redirect()->back();

        return to_route('offers', $getOffer);

    }

    public function getResultSearching(Request $request)
    {

        $query['getResult'] = $request->input('popup_searching');

        $productQuery = Product::with(['productImages']);

        $products = (new GetProducts($productQuery, $query))->apply()->get();

    }


    // save timezone from js into session
    public function getTimezone(Request $request){

        session(['timezone' => $request->input('timezone')]);

        return redirect()->back();
    }


    // get all reviews

    public function getAllReviews(Review $review = null)
    {

        if(!isset($review)) {
            $reviews = (new GetReviews(0))->getReviews();
        } else {
            $reviews[] = $review;
        }

        return view('pages.elements.reviews', compact('reviews'));

    }

    // get screen width from js into session

    public function getScreenWidth(Request $request){

        if($request->input('screenWidth') == 'mobile') session(['screenWidth' => $request->input('screenWidth')]);

        if($request->input('screenWidth') == 'desk') {

            session(['screenWidth' => $request->input('screenWidth')]);
        }

    }
}
