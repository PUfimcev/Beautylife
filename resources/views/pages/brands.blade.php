@extends('layouts.index')

@section('title', __('brands'))

@section('crumbs')
    <ul class="crumbs__list d-flex justify-content-start align-items-center gap-1">
        <li><a class="crumbs__reffers" href="{{ route('index') }}">{{ __('Main page')}}</a></li>
        <li><span class="crumbs__slash">/</span></li>
        <li><span>{{ __('Brands')}}</span></li>
    </ul>
@endsection

@section('content')


    <section class="brands">
        <h2 class="brands__title">{{ __('Brands') }}</h2>

        <div class="brands__elements">

            @forelse ($brands as $brand)
                @include('pages.elements.brand', ['brand' => $brand])
            @empty
                <p class="no__brands">{{ __('There are no brands') }}</p>
            @endforelse
        </div>

        @if (!isset($brands) || !empty($brands))
            <div class="pagination">{{ $brands->onEachSide(1)->links() }}</div>
        @endif

    </section>

@endsection
