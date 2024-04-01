<?php

namespace App\Http\Controllers;

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
}
