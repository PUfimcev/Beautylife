<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class EmptyBookmarks
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $getBookmark = User::find(Auth::id())->bookmark;

        $bookmarkProductIds =  $getBookmark->products()->count();

        if(is_null($getBookmark) || $bookmarkProductIds < 1) {
            return to_route('person.bookmarks_empty');
        }

        return $next($request);
    }
}
