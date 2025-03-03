<?php

namespace App\Http\Middleware;

use Closure;
use App\Classes\HandleOrder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class BasketIsNotEmpty
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if(session()->has('order')){

            $order = session('order');
        } else {

            if(Auth::check()) $order = HandleOrder::restoreAuthReservedOrder();

            $order = null;
        }

        dd($order->products);
        if(is_null($order)) {
            return to_route('basket_empty');
        }

        return $next($request);
    }
}
