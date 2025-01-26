<?php

namespace App\Http\Controllers\Person;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class BookmarkController extends Controller
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
    *  Add product in the list of featured wares.
    */
    public function addBookmarks(Product $product) :void
    {
        dd($product);
    }

}
