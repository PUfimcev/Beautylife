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
     *  Show the list of featured wares. Bookmarks.
    */

   public function getBookmarks()
   {
        $wares = [];
        // $wares = ['creme'];
        // $wares = User::get();

       return view('person.bookmarks', compact('wares'));
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
