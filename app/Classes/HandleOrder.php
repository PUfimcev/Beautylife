<?php

namespace App\Classes;

use App\Models\User;
use App\Models\Order;
use App\Models\Product;
use App\Models\UnregisteredCustomer;
use Illuminate\Support\Facades\Auth;

class HandleOrder
{
    public function __construct()
    {
        // $this->removeSessionPrevUrl();
    }


    public static function createOrder(Product $product, $amount): void
    {
        // session()->forget('order');

        // dd($product->isProductInBasket());
        $amount = $amount['amount'];
        $currentPrice = ($product->reduced_price === '0.00') ? $product->price : $product->reduced_price;
        $sum = self::getProductsSum($amount, $currentPrice);
        $productID = $product->id;
        $product = Product::find($productID);

        if(session()->has('order')){

            $order = session()->get('order');

            $orderId = $order->id;
        } else {

            if(Auth::check()) {
                $order = self::restoreAuthReservedOrder();

            } else {

                $order = new Order();

                if(Auth::check()){

                    $userID = Auth::user()->id;

                    $user = User::find($userID);

                    $user->orders()->save($order);

                } else {
                    $unregisteredUser = UnregisteredCustomer::create();

                    $unregisteredUser->order()->save($order);

                }
            }
        }

        $order->products()->attach($product, ['amount' => $amount, 'current_price' => $currentPrice, 'sum' => $sum]);

        $order = Order::find($orderId);

        session(['order' => $order]);
    }

    public static function getProductsSum($amount, $price)
    {
        return $amount * $price;
    }

    public static function restoreAuthReservedOrder()
    {

        $userID = Auth::user()->id;

        $order = Order::where('user_id', $userID)->where('confirmed', 0)->first();

        return $order;
    }
}
