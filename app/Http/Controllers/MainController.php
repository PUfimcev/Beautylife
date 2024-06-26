<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Review;
use App\Classes\GetReviews;
use App\Classes\SearchClass;
use Illuminate\Http\Request;
use Illuminate\View\ViewName;
use App\Classes\RemoveSessionClass;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cookie;

class MainController extends Controller
{


    public function main()
    {
        (new RemoveSessionClass())->removeSessionPrevUrl();

        // $reviews = (new GetReviews())->getReviews();

        // return view('pages.main', compact('reviews'));
        return view('pages.main');

    }

    public function about()
    {
        (new RemoveSessionClass())->removeSessionPrevUrl();

        return view('pages.about');
    }

    public function offers()
    {

        (new RemoveSessionClass())->removeSessionPrevUrl();

        return view('pages.offers');
    }

    public function catalog()
    {
        (new RemoveSessionClass())->removeSessionPrevUrl();

        return view('pages.catalog');
    }

    public function brands()
    {
        (new RemoveSessionClass())->removeSessionPrevUrl();

        return view('pages.brands');
    }

    public function conditions()
    {
        (new RemoveSessionClass())->removeSessionPrevUrl();

        return view('pages.conditions');
    }

    public function blogs()
    {
        (new RemoveSessionClass())->removeSessionPrevUrl();

        return view('pages.blogs');
    }


    public function setLocale($locale = null)
    {

        if (!isset($locale) || !in_array($locale, config('app.available_locales'))) {
            $locale = config('app.locale');
        }

        session(['locale' => $locale]);
        App::setLocale($locale);

        return redirect()->back();

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
