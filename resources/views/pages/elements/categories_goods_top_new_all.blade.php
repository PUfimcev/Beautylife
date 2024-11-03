@extends('layouts.index')

@section('title', __( $title ) )

@section('crumbs')
    <ul class="crumbs__list d-flex justify-content-start align-items-center gap-1">
        <li><a class="crumbs__reffers" href="{{ route('index') }}">{{ __('Main page')}}</a></li>
        <li><span class="crumbs__slash">/</span></li>
        <li><a class="crumbs__reffers" href="{{ route('catalog') }}">{{ __('Catalog')}}</a></li>
        <li><span class="crumbs__slash">/</span></li>
        <li><span>{{ __( $title )}}</span></li>
    </ul>
@endsection

@section('content')

<section class="categories__goods_top_new_all">

    <div class="categories__goods_top_new_all-top">

        <h2 class="category__name">{{ Str::upper( __($title)) }}</h2>
        <div class="selection_goods">
            <span >{{ __('Sort by') }}:</span>

            <div class="select_goods_wrap">

                <select name="select__goods_top_new_all" class="select__goods_top_new_all"

                oninput="selectOtherGoods(this.value);"
                >
                    <option @selected(old('select__goods_top_new_all', 'All goods') == (($title == 'All goods') ?  'All goods' : '')) value="all-goods">{{ __('All goods') }}</option>
                    <option @selected(old('select__goods_top_new_all', 'Bestsellers') == (($title == 'Bestsellers') ?  'Bestsellers' : ''))  value="bestsellers">{{ __('Bestsellers') }}</option>
                    <option @selected(old('select__goods_top_new_all', 'New arrival') == (($title == 'New arrival') ?  'New arrival' : '')) value="new-arrivals">{{ __('New arrival') }}</option>
                    <option @selected(old('select__goods_top_new_all', 'Sale price') == (($title == 'Sale price') ?  'Sale price' : '')) value="sale-price">{{ __('Sale price') }}</option>
                </select>
                <span class="select-arrow"></span>
            </div>

        </div>
    </div>

    <div class="categories__goods_top_new_all-body">

        <aside class="categories__goods">

            <div class="category__filter-top">

                <span>{{ Str::upper(__('Filter by')) }}:</span>
            </div>


            <ul>

                @foreach ($categories as $category)
                    <li><a href="{{ route('catalog', $category) }}">{{ $category->langField('name') }}</a></li>
                @endforeach
            </ul>
        </aside>

        <div class="goods_top_new_all-result">

            <div class="goods_top_new_all-quantity"><span>{{ __('Items') }}: {{ $count }}</span></div>

            <div class="product__elements">
                @forelse ($goods as $good)

                    @include('pages.elements.product', ['product' => $good, 'i' => $loop->iteration, 'whatForProduct' => $title])
                @empty
                    <p class="no__goods">{{ __('There are no goods') }}</p>
                @endforelse
            </div>


        </div>

    </div>

    @if (!isset($goods) || !empty($goods))
    {{-- <div class="pagination">{{ $goods->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}</div> --}}
    @endif

    <div class="pagination">1 2 3 4 5 6 </div>


    @push('scripts')

        <script>
        function selectOtherGoods(route){
            if(!route) return;
            window.location.href = '{{ route('catalog_top_new','') }}/' + `${route}`;
        }

        </script>
    @endpush

</section>

@endsection
