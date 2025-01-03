@extends('layouts.index')

@section('title', __('catalog'))

@section('crumbs')
    <ul class="crumbs__list d-flex justify-content-start align-items-center gap-1">
        <li><a class="crumbs__reffers" href="{{ route('index') }}">{{ __('Main page')}}</a></li>
        <li><span class="crumbs__slash">/</span></li>
        <li><span>{{ __('Catalog')}}</span></li>
    </ul>
@endsection

@section('content')

        <section class="catalog">
            <h2 class="catalog__title">{{ __('Catalog') }}</h2>

            <div class="catalog__elements">

                @if(!empty($categories))
                    @each('pages.elements.category', $categories, 'category')

                @else
                    <p class="no__catalog">{{ __('The catalog is empty') }}</p>
                @endif

            </div>

        </section>

@endsection
