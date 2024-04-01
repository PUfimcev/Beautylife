<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use App\Classes\RemoveSessionClass;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Traits\PreviousUrl;
use Illuminate\Support\Facades\Session;
use Illuminate\Foundation\Auth\AuthenticatesUsers;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers, PreviousUrl;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */

    public function redirectTo()
    {
        request()->session()->flash('status', 'You are logged in!');
        return (RouteServiceProvider::redirectTo());
    }

    /**
     * Show the application's login form.
     *
     * @return \Illuminate\View\View
     */
    public function showLoginForm()
    {

        $this->getPreviousUrl();

        return view('auth.login');
    }


    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function validateLogin(Request $request)
    {
        $request->validate([
            $this->username() => 'required|string',
            'password' => 'required|string',
            'g-recaptcha-response' => 'required|recaptcha',
        ]);
    }

    /**
     * Log the user out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        (new RemoveSessionClass())->removeSessionPrevUrl();

        $locale = session('locale');

        $this->guard()->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        if ($response = $this->loggedOut($request, $locale)) {
            return $response;
        }

        // if(Str::contains(url()->previous(), 'admin')){

        //     return $request->wantsJson()
        //     ? new JsonResponse([], 204)
        //     : redirect('/');

        // } else {

        //     return $request->wantsJson()
        //         ? new JsonResponse([], 204)
        //         : back();
        // }

    }

    /**
     * The user has logged out of the application.
     *
     * Plus we save correct unchanged lang while logging out
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request, $locale)
    {

        Session::put('locale',$locale);

        if(Str::contains(url()->previous(), 'admin')){  // Str::contains(url()->previous(), 'admin'): They check if they log out from admin panel

            return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');

        } else if(Str::contains(url()->previous(), 'personal')) {
            return $request->wantsJson()
            ? new JsonResponse([], 204)
            : redirect('/');
        } else {

            return $request->wantsJson()
                ? new JsonResponse([], 204)
                : back();
        }
    }
}
