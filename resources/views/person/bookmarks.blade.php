@extends('layouts.index')

@section('title', __('Bookmarks'))

@section('content')
    <div class="container">

        <div id="bookmarks">

            <h2 class="bookmarks__title">{{ __('Bookmarks') }}</h2>

            <div class="bookmarks__select_sorting">

                <select form="sorting__option" name="bookmarksOrder" id="sorting_in_bookmark" class="sorting__option" onchange="event.preventDefault(); document.getElementById('sorting__option').submit();">
                    <option  @selected(old('bookmarksOrder', 'desc') == request()->input("bookmarksOrder")) label="{{ __('Start from new') }}" value="desc"></option>
                    <option  @selected(old('bookmarksOrder', 'asc') == request()->input("bookmarksOrder")) label="{{ __('Start from old') }}" value="asc"></option>
                </select>
                <span class="select-arrow"></span>
            </div>

            <ul class="bookmarks__products_list">
                @each('pages.elements.bookmark_product', $products, 'product')
            </ul>

            @if (isset($products) && !empty($products))
                <div class="pagination desk">{{ $products->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}</div>
            @endif
        </div>


    </div>
    <form id="sorting__option" action="{{ route('person.bookmarks') }}" method="GET" style="display: none">
        @csrf
    </form>

@endsection
