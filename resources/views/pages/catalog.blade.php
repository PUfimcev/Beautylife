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


        <h1>Catalog</h1>

    <ul class="categories__list">

        @forelse ($categories as $category)
            <li class="category catalog-filter"><span class="category__name">{{ $category->langField('name') }}</span><span class="category__name_plus">+</span></li>
        @empty
            <li>{{ __('There are no categories') }}</li>
        @endforelse
    </ul>



@endsection
