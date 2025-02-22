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
    <div class="product__header">
        <div class="product__pictures">

        </div>
        <div class="product__summary">
            <div class="product__name">
                <p class="product_title">{{ $product->langField('name') }}</p>
                <div class="product_rating"><span class="star"></span><span>5.0</span></div>
            </div>
            <div class="product_code_availability">
                <div class="code">
                    <span>{{ __('vendor code') }}:</span>
                    <span>{{ $product->code }}</span>
                </div>
                <div class="availability">
                    @if ($product->amount > 0)
                        <div class="sign"  style = "background: #987B75" ></div>
                        <span>{{ __('in stock') }}</span>
                    @else
                        <div class="sign"  style = "background: #FAF8F6" ></div>
                        <span>{{ __('not available') }}</span>

                    @endif
                </div>
            </div>
            <p class="product_about">{{ $product->productDescription->langField('about') }}</p>
            <div class="product_order">
                <form action="{{-- route('basket_add', $product) --}}" method="{{-- post --}}">
                    @csrf
                    <div class="price-amount-to_basket">
                        <div class="price">
                            @if($product->amount > 0)
                            <p>BYN</p>
                                @if($product->reduced_price > 0)
                                    <p class="discount-price">{{ $product->reduced_price }}</p>
                                @endif

                                <p class="total-price"  @if($product->reduced_price > 0) style="text-decoration-line: line-through; opacity: 0.5" @endif>{{ $product->price }}</p>

                                <p class="text-line"></p>
                            @else

                                <p class="product_abcent">{{ __('Not available') }} </p>

                            @endif
                        </div>

                        <div class="amount_option"  @if($product->amount == 0) style="display: none" @endif>
                            <span class="minus_product" translate="no">-</span>
                            <input type="text" class="amount_option_value" name="productsAmount" value="{{ request()->has('productsAmount') ? request()->input('productsAmount') : '1' }}" size="3" translate="no">
                            <span class="plus_product" translate="no">+</span>
                        </div>

                        <div
                            @if ($product->amount > 0)
                                onclick="event.preventDefault(); document.getElementById('amount_option_value_for_cart').value = document.querySelector('.amount_option_value').value;  document.getElementById('product_card_tobasket').submit();"
                            @else
                                onclick="event.preventDefault();" style = "pointer-events: none"
                            @endif
                                class="to_basket">{{ __('Add to bag') }}
                            {{-- class="to_basket">{{ (point if there is a product in cart) ?  __('Add to bag') : __('In bag') }} --}}
                        </div>
                    </div>
                    <button @disabled(($product->amount > 0) ? false : true ) >{{ __('Buy in 1 click') }}</button>
                </form>
            </div>
        </div>
    </div>

    <div class="product__description-tabs tabs">
        <div class="tabs_head">
            <ul class="tabs_head-list">
                <li data-id = '1'>{{ __('Details') }}</li>
                <li data-id = '2'>{{ __('Ingredients') }}</li>
                <li data-id = '3'>{{ __('Reviews') }}</li>
            </ul>
        </div>
        <ul class="tabs_content-list">
            <li data-id="1" class="content_details show">
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
                    <h3>{{ __('Reviews') }}</h3>
                    <a id="product_review-bnt" href="{{-- route('review.create', $product) --}}" role="button">{{ __('Leave a review') }}</a>
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

    <form id="product_card_tobasket" action="{{ route('basket_add', $product) }}" method="POST" style="display: none">
        @csrf
        <input type="text" id="amount_option_value_for_cart" name="productsAmount" value="1">
    </form>

</section>

@endsection
