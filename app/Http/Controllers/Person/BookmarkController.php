<?php

namespace App\Http\Controllers\Person;

use App\Models\User;
use App\Models\Product;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

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
    public function addBookmarks(Product $product)
    {

        $getBookmark = User::find(Auth::id())->bookmark;

        if($getBookmark === null) {
            $userID['user_id'] = Auth::id();
            $getBookmark = Bookmark::create($userID);
            $getBookmark->products()->attach($product);
        } else {
            $arrayProductIds = self::getArrayProductIds($getBookmark);

            if(in_array($product->id, $arrayProductIds)){

                return back()->with('status', 'Product already in bookmark!');
            } else {
                $getBookmark->products()->attach($product);

                return back()->with('status', 'Product added in bookmark!');
            }

        }

    }

    public static function getArrayProductIds($bookmark)
    {
        return $bookmark->products()->get()->map->id->toArray();
    }


    /**
    *  Add product in the list of featured wares.
    */
    public function removeBookmarks(Product $product)
    {
        // $userID = Auth::id();
        // $bookmark = Bookmark::create($userID);
        // $bookmark->products()->attach($bookmark);

        // return to_route('admin.offers.index')->with('status', 'Product added in bookmark!');
    }

}
