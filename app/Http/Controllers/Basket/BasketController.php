<?php

namespace App\Http\Controllers\Basket;

use App\Models\Product;
use App\Classes\HandleOrder;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BasketController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('basket_is_not_empty')->except(['basketIsEmpty', 'addProductToBasket']);
    }

    /**
     *  Show  basket.
    */

    public function getBasket()
    {

        return view('basket.basket');
    }

    /**
     *  Show notice about empty basket.
    */

    public function basketIsEmpty()
    {
        return view('basket.basket_is_empty');
    }

    /**
    *  Add product to the basket.
    */
    public function addProductToBasket(Request $request, Product $product)
    {
        // dd($product->id);
        // dd($product->isProductInBasket());
        $amount['amount'] =  ($request->input('productsAmount') === null) ? '1' : $request->input('productsAmount');
        // HandleOrder::createOrder($product, $amount);

        return back();
    }

}
