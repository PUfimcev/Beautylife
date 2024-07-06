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
