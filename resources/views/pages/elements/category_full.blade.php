@use(App\Models\Product;)
@extends('layouts.index')

@section('title', $category->langField('name') )

@section('crumbs')
    <ul class="crumbs__list d-flex justify-content-start align-items-center gap-1">
        <li><a class="crumbs__reffers" href="{{ route('index') }}">{{ __('Main page')}}</a></li>
        <li><span class="crumbs__slash">/</span></li>
        <li><a class="crumbs__reffers" href="{{ route('catalog') }}">{{ __('Catalog')}}</a></li>
        <li><span class="crumbs__slash">/</span></li>
        <li><span>{{  $category->langField('name') }}</span></li>
    </ul>
@endsection

@section('content')

<section class="full_category">
        <div class="full_category-top">

        <h2 class="category__name">{{ Str::upper($category->langField('name')) }}</h2>

        <div class="selection_goods">
            <span >{{ __('Sort by') }}:</span>

            <div class="select_goods_wrap">

                <select form="category__filter-id" name="selectGoods" class="select__goods">
                    <option  @selected(old('selectGoods', 'all-goods') == request()->input("selectGoods")) value="all-goods">{{ __('All goods') }}</option>
                    <option  @selected(old('selectGoods', 'bestsellers') == request()->input("selectGoods"))  value="bestsellers">{{ __('Bestsellers') }}</option>
                    <option  @selected(old('selectGoods','new-arrivals') == request()->input("selectGoods"))  value="new-arrivals">{{ __('New arrivals') }}</option>
                    <option  @selected(old('selectGoods', 'sale-price') == request()->input("selectGoods"))  value="sale-price">{{ __('Sale price') }}</option>
                </select>
                <span class="select-arrow"></span>
            </div>

        </div>
    </div>

    {{-- <section class="filer__mobile">

        <div class="full_category-top-mobile">

            <h2 class="category__name">{{ Str::upper($category->langField('name')) }}</h2>

        </div>

        <div class="category__filter-top-mobile">
            <div>{{ __('Filter by') }} <span class="dropdown__arrow"></span></div>
            <div>{{ __('Sort by') }} <span class="dropdown__arrow"></span></div>
         </div>

        <form class="category__filter-mobile" method="GET" action="">

                <ul class="select_goods_wrap">
                    <li>
                        <input type="radio" class="subcategory_select-mobile" name="selectGoods" id="select__goods-all-goods" value="all-goods"

                        {{ request()->input('selectGoods') == 'all-goods' ? 'checked' : '' }}
                        >
                        <label class="select__goods-type" for="select__goods-all-goods">{{  __('All goods') }}</label>
                    </li>
                    <li>
                        <input type="radio" class="subcategory_select-mobile" name="selectGoods" id="select__goods-bestsellers" value="bestsellers"

                        {{ request()->input('selectGoods' ) == 'bestsellers' ? 'checked' : '' }}
                        >
                        <label class="select__goods-type" for="select__goods-bestsellers">{{  __('Bestsellers') }}</label>
                    </li>
                    <li>
                        <input type="radio" class="subcategory_select-mobile" name="selectGoods" id="select__goods-new-arrivals" value="new-arrivals"

                        {{ request()->input('selectGoods') == 'new-arrivals' ? 'checked' : '' }}
                        >
                        <label class="select__goods-type" for="select__goods-new-arrivals">{{ __('New arrival') }}</label>
                    </li>
                    <li>
                        <input type="radio" class="subcategory_select-mobile" name="selectGoods" id="select__goods-sale-price" value="sale-price"

                        {{ request()->input('selectGoods') == 'sale-price' ? 'checked' : '' }}
                        >
                        <label class="select__goods-type" for="select__goods-sale-price">{{  __('Sale price') }}</label>
                    </li>
                </ul>

                <div class="filter__products-mobile">

                    <div class="category">
                        <div class="category__title" onclick="getMenue(this)"><span>{{ $category->langField('name') }}</span><span>+</span></span><span>-</span></div>

                        <ul class="subcategory__names">

                            @foreach ($category->subcategories as $subcategory)
                                <li>
                                    <input type="checkbox" class="subcategory_select-mobile" name="subcategory{{ $loop->iteration }}" id="subcategory-mobile-{{ $loop->iteration }}"

                                    value="{{ $subcategory->name_en }}"

                                    {{ request()->has('subcategory'. $loop->iteration ) ? 'checked' : '' }}
                                    >
                                    <label class="subcategory__name" for="subcategory-mobile-{{ $loop->iteration }}">{{ $subcategory->langField('name') }}</label>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="brand-mobile">
                        <div class="brand__title" onclick="getMenue(this)"><span>{{ __('Brand') }}</span><span>+</span></span><span>-</span></div>

                        <ul class="brands__names">

                            @foreach ($brands as $brand)
                                <li>
                                    <input type="checkbox" class="subcategory_select-mobile" name="brand{{ $loop->iteration }}" id="brand-mobile-{{ $loop->iteration }}"

                                    value="{{ $brand->brand_name }}"

                                    {{ request()->has('brand'. $loop->iteration ) ? 'checked' : '' }}
                                    >
                                    <label class="brand__name" for="brand-mobile-{{ $loop->iteration }}">{{ $brand->brand_name }}</label>
                                </li>
                            @endforeach
                        </ul>
                    </div>

                    <div class="price-mobile">
                        <div class="price__title" onclick="getMenue(this)"><span>{{ __('Price') }}</span><span>+</span></span><span>-</span></div>

                        <div class="price__option">Something</div>
                    </div>

                    <div class="skintype-mobile">
                        <div class="skintype__title" onclick="getMenue(this)"><span>{{ __('Skin type') }}</span><span>+</span></span><span>-</span></div>

                        <ul class="skin__types">

                            @foreach ($skintypes as $skintype)
                            <li>
                                <input type="checkbox" class="subcategory_select-mobile" name="skintype-{{ $loop->iteration }}" id="skintype-.admin__consumers__section-{{ $loop->iteration }}"

                                value="{{ $skintype->name_en }}"

                                @checked(old('skintype-{{ $loop->iteration }}', $skintype->name_en))
                                >
                                <label class="skintype__name" for="skintype-mobile-{{ $loop->iteration }}">{{ $skintype->langField('name') }}</label>
                            </li>
                        @endforeach
                        </ul>
                    </div>

                    <div class="age-mobile">
                        <div class="age__title" onclick="getMenue(this)"><span>{{ __('Age') }}</span><span>+</span></span><span>-</span></div>

                        <ul class="age__types">
                            @foreach ($ageranges as $agerange)
                            <li>
                                <input type="checkbox" class="subcategory_select-mobile" name="agerange-{{ $loop->iteration }}" id="agerange_mobile-{{ $loop->iteration }}"

                                value="{{ $agerange->name_en }}"
                                data-id="agerange_mobile-{{ $loop->iteration }}"
                                @checked(old('agerange-{{ $loop->iteration }}', $agerange->name_en))
                                >
                                <label class="agerange__name" for="agerange_mobile-{{ $loop->iteration }}">{{ $agerange->langField('name') }}</label>
                            </li>
                        @endforeach
                        </ul>
                    </div>

                    <div class="forwhom-mobile">
                        <div class="forwhom__title" onclick="getMenue(this)"><span>{{ __('For whom') }}</span><span>+</span></span><span>-</span></div>

                        <ul class="objects__types">
                            @foreach ($consumers as $consumer)
                        <li>
                            <input type="checkbox" class="subcategory_select-mobile" name="consumer-{{ $loop->iteration }}" id="consumer_mobile-{{ $loop->iteration }}"

                            value="{{ $consumer->name_en }}"
                            data-id="consumer_mobile-{{ $loop->iteration }}"
                            @checked(old('consumer-{{ $loop->iteration }}', $consumer->name_en))
                            >
                            <label class="consumer__name" for="consumer_mobile-{{ $loop->iteration }}">{{ $consumer->langField('name') }}</label>
                        </li>
                    @endforeach
                        </ul>
                    </div>
                </div>

                <input type="hidden" name="_token" id="token" value="{{ csrf_token() }}">
                <input type="hidden" name="category" id="category-name" value="{{ $category->code }}">



                <div class="reset__apply_btns">
                    <a class="reset__btn" href="{{ route('catalog', $category) }}">{{ __('Clear all') }}</a>

                    <button class="apply__btn" type="submit">{{ __('Apply') }}</button>

                </div>

        </form>


    </section> --}}



    <div class="full_category-body">

        <aside class="category__subcategory">

            <div class="category__filter-top"><span>{{ Str::upper(__('Filter by')) }}:</span></div>


            <form id="category__filter-id" class="category__filter" method="GET" action="{{ route('catalog', $category) }}">

                <div class="filter-items">
                    <div class="title" onclick="getMenue(this)"><span>{{ $category->langField('name') }}</span><span>+</span></span><span>-</span></div>

                    <ul class="subcategory__names subcategory">

                        @foreach ($category->subcategories as $subcategory)
                            <li>
                                <input type="checkbox" class="subcategory-select" name="subcategorySelect[]" id="subcategory_item-{{ $loop->iteration }}"

                                {{ in_array($subcategory->id, request()->input('subcategorySelect') ?? []) ? 'checked' : ''}}

                                value="{{ $subcategory->id }}"
                                data-id="subcategory_item-{{ $loop->iteration }}"
                                >
                                <label class="subcategory__name" for="subcategory_item-{{ $loop->iteration }}">{{ $subcategory->langField('name') }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="filter-items">
                    <div class="title" onclick="getMenue(this)"><span>{{ __('Brand') }}</span><span>+</span></span><span>-</span></div>

                    <ul class="subcategory__names brand">

                        @foreach ($brands as $brand)

                        <li>
                            <input type="checkbox" class="subcategory-select" name="brandSelect[]" id="brand_item-{{ $loop->iteration }}"
                            {{ in_array($brand->id, request()->input('brandSelect') ?? []) ? 'checked' : ''}}
                            value="{{ $brand->id }}"
                            data-id="brand_item-{{ $loop->iteration }}">
                            <label class="brand__name" for="brand_item-{{ $loop->iteration }}">{{ $brand->brand_name }}</label>
                        </li>
                        @endforeach
                    </ul>
                </div>

                {{-- <div class="filter-items">
                    <div class="title" onclick="getMenue(this)"><span>{{ __('Price') }}</span><span>+</span></span><span>-</span></div>

                    <div class="subcategory__names">Something</div>
                </div> --}}

                <div class="filter-items">
                    <div class="title" onclick="getMenue(this)"><span>{{ __('Skin type') }}</span><span>+</span></span><span>-</span></div>

                    <ul class="subcategory__names skintype">
                        @foreach ($skintypes as $skintype)
                            <li>
                                <input type="checkbox" class="subcategory-select" name="skintypeSelect[]" id="skintype_item-{{ $loop->iteration }}"
                                {{ in_array($skintype->id, request()->input('skintypeSelect') ?? []) ? 'checked' : ''}}
                                value="{{ $skintype->id }}"
                                data-id="skintype_item-{{ $loop->iteration }}"
                                >
                                <label class="skintype__name" for="skintype_item-{{ $loop->iteration }}">{{ $skintype->langField('name') }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="filter-items">
                    <div class="title" onclick="getMenue(this)"><span>{{ __('Age') }}</span><span>+</span></span><span>-</span></div>
                    <ul class="subcategory__names agerange">
                        @foreach ($ageranges as $agerange)
                            <li>
                                <input type="checkbox" class="subcategory-select" name="agerangeSelect[]" id="agerange_item-{{ $loop->iteration }}"

                                value="{{ $agerange->id }}"
                                data-id="agerange_item-{{ $loop->iteration }}"
                                {{ in_array($agerange->id, request()->input('agerangeSelect') ?? []) ? 'checked' : ''}}
                                >
                                <label class="agerange__name" for="agerange_item-{{ $loop->iteration }}">{{ $agerange->langField('name') }}</label>
                            </li>
                        @endforeach
                    </ul>
                </div>

                <div class="filter-items">
                    <div class="title" onclick="getMenue(this)"><span>{{ __('For whom') }}</span><span>+</span></span><span>-</span></div>

                    <ul class="subcategory__names consumers">
                        @foreach ($consumers as $consumer)
                        <li>
                            <input type="checkbox" class="subcategory-select" name="consumerSelect[]" id="consumer_item-{{ $loop->iteration }}"

                            value="{{ $consumer->id }}"
                            data-id="consumer_item-{{ $loop->iteration }}"
                            {{ in_array($consumer->id, request()->input('consumerSelect') ?? []) ? 'checked' : ''}}
                            >
                            <label class="consumer__name" for="consumer_item-{{ $loop->iteration }}">{{ $consumer->langField('name') }}</label>
                        </li>
                    @endforeach
                    </ul>
                </div>

                @csrf
            </form>

            <div class="reset__btn"><a href="{{ route('catalog', $category) }}">{{ __('Clear all') }}</a>
            </div>

        </aside>

        <div class="goods_top_new_all-result">

            <div class="goods_top_new_all-quantity"><span>{{ __('Items') }}: {{ $count }}</span></div>

            <div class="product__elements">
                @forelse ($products as $product)

                    @include('pages.elements.product', ['product' => $product, 'category' => $category, 'i' => $loop->iteration])
                @empty
                    <p class="no__goods">{{ __('There are no goods') }}</p>
                @endforelse
            </div>
        </div>


    </div>

    <div class="view-all__btn"><a href="{{ route('catalog_top_new', 'all-goods') }}">{{ __('View all') }}</a></div>

    {{-- @if(session('screenWidth') !== 'mobile' && $pages > 0)
        <div class="pagination">
            <ul class="pagination__pages">
                @foreach ($pages as $page)
                    <li>
                        <input form="category__filter-id" type="radio" class="radio-select" name="page" id="page-{{ $loop->iteration }}"

                        value="{{ $page }}"
                        data-id="page-{{ $loop->iteration }}"
                        @checked(old('agerange-{{ $loop->iteration }}', $agerange->name_en))
                        >
                        <label class="page__numb" for="page-{{ $loop->iteration }}">{{ $page }}</label>
                    </li>
                @endforeach
            </ul>
        </div>
    @endif --}}


    @if (!isset($products) || !empty($products))
        <div class="pagination">{{ $products->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}</div>
    @endif

    <div class="full_category-bottom">
        <h2 class="bestsellers__title">{{ Str::upper(__('You might also like')) }}</h2>

        @isset($bestsellers)
            <a href="{{ route('catalog_top_new', 'bestsellers') }}" class="get__all__bestsellers-mobile" title="{{ __('Get all bestsellers') }}">{{ __('see more') }}</a>
        @endisset

        <div class="bestsellers__elements">

            @forelse ($bestsellers as $bestseller)

                @include('pages.elements.bestsellers_on_main_page', ['product' => $bestseller, 'g' => $loop->iteration, 'count' => $bestsellers->count()])
            @empty
                <p class="no__bestsellers">{{ __('There are no bestsellers') }}</p>
            @endforelse
        </div>


    </div>

</section>

@push('scripts')

    <script>
        function getMenue(elem){
        if(!elem) return;
        elem.classList.toggle('open');
        elem.nextElementSibling.classList.toggle('open');

        }

    </script>
@endpush

@endsection
