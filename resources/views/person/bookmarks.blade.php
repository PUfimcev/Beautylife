@extends('layouts.index')

@section('title', __('Bookmarks'))

@section('content')
    <div class="container">

        <div id="bookmarks">

            <h2 class="bookmarks__title">{{ __('Bookmarks') }}</h2>

            <div class="bookmarks__select_sorting">

                <select form="sorting__option" name="bookmarksOrder" class="sorting__option" onchange="event.preventDefault(); document.getElementById('sorting__option').submit();">
                    <option  @selected(old('bookmarksOrder', 'desc') == request()->input("bookmarksOrder")) value="desc">{{ __('Start from new') }}</option>
                    <option  @selected(old('bookmarksOrder', 'asc') == request()->input("bookmarksOrder"))  value="asc">{{ __('Start from old') }}</option>
                </select>
                <span class="select-arrow"></span>
            </div>

            <ul class="bookmarks__products_list">
                @each('pages.elements.bookmark_product', $products, 'product')
            </ul>
        </div>


    </div>
    <form id="sorting__option" action="{{ route('person.bookmarks') }}" method="GET" style="display: none">
        @csrf
    </form>

@endsection
