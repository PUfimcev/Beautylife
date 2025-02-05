<?php

namespace App\Http\Controllers\Person;

use App\Models\User;
use App\Models\Product;
use App\Models\Bookmark;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Query\Builder;

class BookmarkController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'empty_bookmarks'])->except(['addBookmarks', 'bookmarkIsEmpty']);
    }

    /**
     *  Show the list of featured wares. Bookmarks.
    */

    public function getBookmarks(Request $request)
    {
        $order = (is_null($request->input("bookmarksOrder")) || $request->input("bookmarksOrder") == 'desc') ? 'desc' : 'asc';

        $products = Bookmark::whereBelongsTo(Auth::user())
                    ->first()
                    ->products()
                    ->orderBy('bookmark_product.created_at', $order)
                    ->paginate(12)->withQueryString();

        return view('person.bookmarks', compact('products'));
    }

    /*
    *  Show notice about empty basket.
    */

    public function bookmarkIsEmpty()
    {
        return view('person.bookmarks_empty');
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
        if(!$bookmark) return;

        return $bookmark->products()->get()->map->id->toArray();
    }


    /**
    *  Add product in the list of featured wares.
    */
    public function removeBookmarks(Product $product)
    {
        $getBookmark = Bookmark::whereBelongsTo(Auth::user())
        ->first();

        $getBookmark->products()->detach($product);

        return back();
    }

}
