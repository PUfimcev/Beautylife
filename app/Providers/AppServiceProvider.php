<?php

namespace App\Providers;

use Illuminate\View\View;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\URL;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     * @return void
     */
    public function boot(): void
    {
        // set locale
        view()->composer('*', function(View $view) {
            $view->with('current_locale', App::getLocale());
            $view->with('available_locales', config('app.available_locales'));
        });

        // get previous pathname
        view()->composer('*', function(View $view) {

            if(session()->has('prevUrl')){

                $view->with('prevUrl', session()->get('prevUrl'));
            } else {
                $view->with('prevUrl', null);
            }

        });

        // input timezone
        view()->composer('*', function(View $view) {

            if(session()->has('timezone')){

                $view->with('local_timezone', session()->get('timezone'));
            } else {
                $view->with('local_timezone', config('app.timezone'));
            }
        });

        // For emphasizing routes
        Blade::directive('routeactive', function ($expression) {
            return "<?php echo (request()->routeIs($expression)) ? 'active' : '' ?>";
        });


        // Paginator::useBootstrapFive();
        Paginator::defaultView('pagination::bootstrap-5');

        // set current password for validation
        Validator::extend('current_password', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value, auth()->user()->password);
        });

        // set recaptcha for validation
        Validator::extend('recaptcha', function ($attribute, $value, $parameters, $validator) {
            $getResponseToken = (string) $value;

            $response = Http::asForm()->post(
                'https://www.google.com/recaptcha/api/siteverify',
                ['secret' => env('RECAPTCHA_SECRET_KEY'), 'response' => $getResponseToken]
            );

            if($response) {

                $body = json_decode($response->body(), true);
            }

            return $body['success'];
        });
    }
}
