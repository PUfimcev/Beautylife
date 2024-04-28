<?php

namespace App\Http\Controllers\Person;

use App\Models\User;
use App\Traits\PreviousUrl;
use Facade\FlareClient\View;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\ResetsPasswords;

class UserController extends Controller
{

    use PreviousUrl, ResetsPasswords;

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
     * Display user account.
     */
    public function index()
    {

        if(Auth::check()) {
            $user = User::findOrFail(Auth::id(),['id', 'name', 'email', 'created_at']);
        }

        return view('person.setting-account.get_user_data', compact('user'));
    }

    /**
     * Show the form for editing User's name.
     */
    public function editName(User $user)
    {
        return view('person.setting-account.reset_username', compact('user'));
    }

    /**
     * Update User's name.
     */
    public function updateName(Request $request, User $user)
    {
        $request->validate(['name' => 'required']);

        $user->update(['name' => $request->input('name')]);

        return to_route('person.user_account')->with('status', 'You\'re successfully changed your Name!');
    }

    /**
     * Show the form for checking User's password.
     */
    public function formForCheckPassword()
    {
        return view('person.setting-account.check_password_for_reset_data');
    }

    /**
     * Show the form for editing User's email.
     */
    public function formForEditEmail(Request $request)
    {

        $request->validate($this->rules());

        if(Auth::check()) {
            $user = User::findOrFail(Auth::id(),['id', 'name', 'email', 'created_at']);
        }

        return view('person.setting-account.form_for_reset_email', compact('user'));
    }

    /**
     * Update the specified User's email.
     */
    public function updateEmail(Request $request, User $user)
    {
        $request->validate(['email' => 'required|string|email:filter|max:255|unique:users']);

        $user->update(['email' => $request->input('email')]);

        return to_route('person.user_account')->with('status', 'You\'re successfully changed your Email!');
    }

    /**
     * Display the password reset view for the given token.
     *
     * If no token is present, display the link request form.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */

    public function showResetForm()
    {

        return view('auth.passwords.email');
    }

    public function checkPassword(Request $request)
    {
        if($request->validate($this->rules())) {

            return to_route('person.reset_password_form');
        }

    }

    /**
     * Get the password email reset form validation rules.
     *
     * @return array
     */
    protected function rules()
    {
        return [
            'password' => 'required|string|min:8|current_password',
            'g-recaptcha-response' => 'required|recaptcha',
        ];
    }

}
