@extends('layouts.index')

@section('title', $product->langField('name') )

@section('crumbs')
    <ul class="crumbs__list d-flex justify-content-start align-items-center gap-1">
        <li><a class="crumbs__reffers" href="{{ route('index') }}">{{ __('Main page')}}</a></li>
        <li><span class="crumbs__slash">/</span></li>
        <li><a class="crumbs__reffers" href="{{ route('catalog') }}">{{ __('Catalog')}}</a></li>
        <li><span class="crumbs__slash">/</span></li>
        <li><a class="crumbs__reffers" href="{{ route('catalog', $category) }}">{{  $category->langField('name')  }}</a></li>
        <li><span class="crumbs__slash">/</span></li>
        <li><span>{{  $product->langField('name') }}</span></li>
    </ul>
@endsection

@section('content')


<section class="product__card">


    <div class="product__description-tabs tabs">
        <div class="tabs_head">
            <ul class="tabs_head-list">
                <li data-id = '1' class="show">{{ __('Details') }}</li>
                <li data-id = '2'>{{ __('Ingredients') }}</li>
                <li data-id = '3'>{{ __('Reviews') }}</li>
            </ul>
        </div>
        <ul class="tabs_content-list">
            <li data-id="1" class="content_details">
                <p class="title">{{ __('Full details') }}:</p>
                <div class="content">@php echo html_entity_decode($product->productDescription->langField('description'))@endphp</div>
                <p class="title">{{ __('Skin type') }}:</p>
                <p class="content">{{ $product->getSkinType()->langField('name') }}</p>
                <p class="title">{{ __('Age range') }}:</p>
                <p class="content">{{ $product->getAgerangeType()->langField('name') }}</p>
                <p class="title">{{ __('Consumers') }}:</p>
                <p class="content">{{ $product->getConsumer()->langField('name') }}</p>
                <p class="title">{{ __('Mode of application') }}:</p>
                <p class="content">{{ $product->productDescription->langField('application') }}</p>
                <p class="title">{{ __('Shipping from') }}:</p>
                <p class="content">{{ $product->productDescription->langField('origin') }}</p>
            </li>
            <li data-id="2" class="content_ingredients">

                @php echo html_entity_decode($product->productDescription->langField('ingredients'))@endphp
            </li>
            <li data-id="3" class="content_reviews">
                <div class="content__revies_head">
                    <h3 class="title">{{ __('Reviews') }}</h3>
                    <a id="product_review-bnt" class="btn btn-outline-secondary border-1 rounded-0 px-4" href="{{-- route('review.create', $product) --}}" role="button">{{ __('Leave a review') }}</a>
                </div>

                <p class="consumer__request">{{ __('Help other users with their choice. Leave your review') }}.</p>
                <ul class="product__reviews_list">
                    @isset($productReviews)
                        @forelse ($productReviews as $productReview)
                            @include('pages.elements.bestsellers_on_main_page', ['review' => $productReviews])
                        @empty
                        @endforelse
                        @endisset
                        <p class="no__revies">{{ __('There are no reviews') }}</p>
                </ul>

            </li>
        </ul>


    </div>

    <div class="product__card-bottom">
        <h2 class="bestsellers__title">{{ Str::upper(__('Similar products')) }}</h2>
        @if($similarProducts->count() >= 3)
            <a href="{{ route('catalog', [$category,  'subcategorySelect' => [$subcategory->id]]) }}" class="get__all__bestsellers-mobile" title="{{ __('Get similar products') }}">{{ __('see more') }}</a>
        @endif

        <div class="bestsellers__elements @if($similarProducts->count() < 3) less-items @endif">
            @isset($similarProducts)
                @forelse ($similarProducts as $similarProduct)
                @include('pages.elements.bestsellers_on_main_page', ['product' => $similarProduct, 'category' => $category, 'subcategory' => $subcategory->id,'g' => $loop->iteration, 'count' => $similarProducts->count()])
                @empty
                    <p class="no__goods">{{ __('There are no goods') }}</p>
                @endforelse
            @endisset
        </div>
    </div>

</section>

@endsection
