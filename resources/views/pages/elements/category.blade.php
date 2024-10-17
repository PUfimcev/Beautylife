<a class="catalog_category" href="{{ route('catalog', $category) }}" title="{{ $category->langField('name') }}">

    <div class="catalog_category_head">


        @if(isset($category->image_route) && !empty($category->image_route))
            <img class="image" src="{{ asset('storage/'.$category->image_route) }}" alt="{{ __('Category picture') }}">
        @endif

    </div>
    <div class="catalog_category_content">

        <h3 class="catalog_category_title">{{ $category->langField('name') }}</h3>

    </div>
</a>
