<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Routing\Route;
use App\Classes\RemoveSessionClass;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth']);
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        (new RemoveSessionClass())->removeSessionPrevUrl();

        return view('admin.pages.index');
    }


    /**
     * Make an allusion if authenticated but no admin.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */

    public function allusionNoAdmin()
    {
        (new RemoveSessionClass())->removeSessionPrevUrl();

        return view('components.allusion_for_not_admin');
    }

    public function getToLogin()
    {
        Auth::logout();

        return to_route('login');
    }
}
