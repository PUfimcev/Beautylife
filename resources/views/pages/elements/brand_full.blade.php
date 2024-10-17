@extends('layouts.index')

@section('title', $brand->brand_name)

@section('crumbs')
    <ul class="crumbs__list d-flex justify-content-start align-items-center gap-1">
        <li><a class="crumbs__reffers" href="{{ route('index') }}">{{ __('Main page')}}</a></li>
        <li><span class="crumbs__slash">/</span></li>
        <li><a class="crumbs__reffers" href="{{ route('brands') }}">{{ __('Brands')}}</a></li>
        <li><span class="crumbs__slash">/</span></li>
        <li><span>{{  $brand->brand_name }}</span></li>
    </ul>
@endsection

@section('content')

<section class="full_brand">
    <a href="{{ route('brands') }}" class="link__to_brands">{{ __('Brands list') }}</a>

    <div class="full_brand_top">

        <div class="full_brand_head">


            @if(isset($brand->brand_image_route) && !empty($brand->brand_image_route))
                <img class="image" src="{{ asset('storage/'.$brand->brand_image_route) }}" alt="{{ __('Brand logo') }}">
            @endif

        </div>
        <div class="full_brand_content">

            <h3 class="brand_title">{{ $brand->brand_name }}</h3>

            <p class="brand_summary">{{ $brand->langField('brand_about') }}</p>

            <p class="brand_description">@php echo html_entity_decode($brand->langField('brand_description'));@endphp
            </p>

        </div>


    </div>

    <h3>{{ __('Goods') }}</h3>

    <div class="full_brand_products">


        @forelse ($products as $product)
            {{-- @include('pages.elements.brand', ['brand' => $brand]) --}}
        @empty
            <p class="no__goods">{{ __('There are no goods') }}</p>
        @endforelse

        @if (!isset($products) || !empty($products))
        <div class="pagination">{{ $products->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}</div>
        <div class="pagination-tablet">{{ $products->links('vendor.pagination.simple-default')}}</div>
        @endif
    </div>

</section>

@endsection
