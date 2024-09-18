<?php

namespace App\Http\Controllers\Person;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class PersonController extends Controller
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
     *  Show the order hidtory.
    */

   public function getOrderHistory()
   {
        $wares = [];
        // $wares = ['creme'];
        // $wares = User::get();

       return view('person.order-history', compact('wares'));
   }


}
