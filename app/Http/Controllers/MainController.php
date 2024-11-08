<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Blog;
use App\Models\Brand;
use App\Models\Offer;
use App\Models\Review;
use App\Models\Category;
use App\Classes\GetBlogs;
use App\Classes\GetOffers;
use App\Classes\GetReviews;
use App\Classes\GetProducts;
use App\Classes\SearchClass;
use Illuminate\Http\Request;
use Illuminate\View\ViewName;
use App\Classes\CategoryFilter;
use App\Classes\RemoveSessionClass;
use Illuminate\Support\Facades\App;
use App\Classes\GetCatalogTopNewData;
use Illuminate\Support\Facades\Cookie;

class MainController extends Controller
{


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

            if(!$offer->trashed()) {
                // $products = (new GetProducts())->getProducts();
                $products = [];

                return view('pages.elements.offer_full', compact('offer', 'products'));
            } else {
                return view('pages.elements.offer_full', compact('offer'));
            }

        }
    }

    /**
     * catalog
     *
     * @param  mixed $category
     * @return void
     */
    public function catalog(Category $category = null)
    {
        (new RemoveSessionClass())->removeSessionPrevUrl();

        if(!isset($category)) {

            $categories = CategoryFilter::getCatalogs();

            return view('pages.catalog', compact('categories'));
        } else {

            list($brands, $skintypes, $ageranges, $count, $products) = CategoryFilter::getCatalogData();

            return view('pages.elements.category_full', compact('category', 'products', 'brands', 'skintypes', 'ageranges'))->with(['count' => $count, 'pages' => range(1, ceil($count/12), 1)]);}
    }

    /**
     * catalogTopNew
     *
     * @param  mixed $quality
     * @return void
     */

    public function catalogTopNew($quality)
    {
        (new RemoveSessionClass())->removeSessionPrevUrl();

        list($goods, $count, $title, $categories) = GetCatalogTopNewData::getCatalogTopNewData($quality);

        return view('pages.elements.categories_goods_top_new_all', compact('categories', 'goods'))->with(['title'=> $title, 'count' => $count]);
    }

    public function brands(Brand $brand = null)
    {
        (new RemoveSessionClass())->removeSessionPrevUrl();


        if(!isset($brand)) {

            $brands = Brand::orderBy('brand_name','asc')->paginate(9);

            return view('pages.brands', compact('brands'));

        } else {

            // $products = (new GetProducts())->getProducts();
            $products = [];

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
        $result = (new SearchClass($request->all()))->getResult();

        return response()->json($result);

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
