@extends('layouts.index')

@section('content')

        {{-- Introducing picture --}}
        <section class="main-picture">
            <div class="main__page_title">
                <img class="title" src="{{ asset('storage/images/BeautyLife_title.png') }}" alt="BeautyLife_title"></img>
                <p class="title-text">{{ __('Start your incredible journey into the world of beauty and health') }}</p>
                </div>
            <a class="main__page_title-button" href="{{ route('catalog') }}" class="title__allusion_catalog" title="{{ __('Explore') }}">{{ __('Explore') }}</a>
        </section>

        {{-- Offers --}}

        <section class="offers__main_page">
            <h2 class="offers__title">{{ __('Special offer') }}</h2>

            <div class="offers__elements">

                @forelse ($offers as $offer)

                    @include('pages.elements.offers_on_main_page', ['offer' => $offer, 'i' => $loop->iteration])
                @empty
                    <p class="no__offers">{{ __('There are no offers') }}</p>
                @endforelse
            </div>

        </section>

        {{-- New arrival --}}

        <section class="new_arrival__main_page">
            <h2 class="new_arrival__title">{{ __('New arrival') }}</h2>

            <div class="new_arrival__elements @if($newArrivals->count() < 3) less-items @endif">

                @forelse ($newArrivals as $newArrival)

                    @include('pages.elements.new_arrival_on_main_page', ['product' => $newArrival, 'i' => $loop->iteration, 'count' => $newArrivals->count()])

                    @if ($newArrivals->count() == 1)

                        <a href="{{ route('catalog_top_new', 'new-arrivals') }}" class="get__all__new_arrivals" title="{{ __('Get all new arrivals') }}">{{ __('see more') }}</a>
                    @endif
                @empty
                    <p class="no__new_arrival">{{ __('There are no new arrivals') }}</p>
                @endforelse

            </div>

            @isset($newArrivals)
                <a href="{{ route('catalog_top_new', 'new-arrivals') }}" class="get__all__new_arrivals-mobile" title="{{ __('Get all new arrivals') }}">{{ __('see more') }}</a>
            @endisset

        </section>

        {{-- Bestsellers --}}

        <section class="bestsellers__main_page">
            <h2 class="bestsellers__title">{{ __('Bestsellers') }}</h2>

            @isset($bestsellers)
            <a href="{{ route('catalog_top_new', 'bestsellers') }}" class="get__all__bestsellers-mobile" title="{{ __('Get all bestsellers') }}">{{ __('see more') }}</a>
            @endisset

            <div class="bestsellers__elements @if($bestsellers->count() < 3) less-items @endif">

                @forelse ($bestsellers as $bestseller)

                    @include('pages.elements.bestsellers_on_main_page', ['product' => $bestseller, 'g' => $loop->iteration, 'count' => $bestsellers->count()])
                @empty
                    <p class="no__bestsellers">{{ __('There are no bestsellers') }}</p>
                @endforelse
                @if($bestsellers->count() < 3)
                    <a href="{{ route('catalog_top_new', 'bestsellers') }}" class="get__all__bestsellers" title="{{ __('Get all bestsellers') }}">{{ __('see more') }}</a>
                @endif
            </div>

        </section>


        {{-- Blogs --}}

        <section class="blogs__main_page">
            <h2 class="blogs__title">{{ __('Blogs') }}</h2>

            <a href="{{ route('blogs') }}" class="get__all__blogs" title="{{ __('Get all blogs') }}">{{ __('read all') }}</a>

            <div class="blogs__elements">

                @forelse ($blogs as $blog)

                    @include('pages.elements.blog_on_main_page', ['blog' => $blog, 'i' => $loop->iteration])
                @empty
                    <p class="no__blogs">{{ __('There are no blogs') }}</p>
                @endforelse
            </div>

        </section>

        {{-- Reviews --}}

        <section class="reviews">
            <h2 class="reviews__title">{{ __('Reviews') }}</h2>
            <div class="reviews__elements">

                @forelse ($reviews as $review)
                    @include('pages.elements.review', ['review' => $review, 'i' => $loop->iteration])
                @empty
                    <p class="no__reviews">{{ __('There are no reviews') }}</p>
                @endforelse

            </div>
            @empty (!$reviews)
                <a href="{{ route('get_all_reviews') }}" class="get__all__reviews" title="{{ __('Get all reviews') }}">{{ __('read all') }}</a>
            @endempty
        </section>
@endsection
