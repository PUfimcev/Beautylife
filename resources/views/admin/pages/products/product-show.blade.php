@extends('admin.layout.app')

@section('title', $product->langField('name'))

@section('content')

<div class="container">

    <div class="admin__product__section-show d-flex flex-column align-items-center justify-content-start gap-3">

        @if (isset($archive))

            <h2>{{ __('Archive product') }}</h2>
        @else
            <h2>{{ __('Product') }}</h2>

        @endif

        @if (isset($archive))

            <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.products_archive') }}">{{ __('Back') }}</a>

        @else
            <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.products.index') }}">{{ __('Back') }}</a>
        @endif


        <div class="product_details">
            <ul class="product_details_list">
                <li><span class="details-name">id: </span><span class="details-content">{{ $product->id }}</span></li>

                <li><span class="details-name">Артикул товара: </span><span class="details-content">{{ $product->code }}</span></li>

                <li><span class="details-name">Наименование: </span><span class="details-content">{{ $product->name }}</span></li>


                <li><span class="details-name">Name in English: </span><span class="details-content">{{ $product->name_en }}</span></li>


                <li><span class="details-name">Аннотация товара: </span><span class="details-content">{{ empty($product->description->about) ?   __('No')  : $product->about }}</span></li>

                <li><span class="details-name">Product summary in English: </span><span class="details-content">{{ empty($product->description->about_en) ?   __('No')  : $product->about_en }}</span></li>

                <li><span class="details-name">Описание товара: </span><span class="details-content">{{ empty($product->description->description) ?   __('No')  : $product->description->description }}</span></li>

                <li><span class="details-name">Product description in English: </span><span class="details-content">{{ empty($product->description->description_en) ?   __('No')  : $product->description->description_en }}</span></li>

                <li><span class="details-name">Применение товара: </span><span class="details-content">{{ empty($product->description->application) ?   __('No')  : $product->description->application }}</span></li>

                <li><span class="details-name">Product application in English: </span><span class="details-content">{{ empty($product->description->application_en) ?   __('No')  : $product->description->application_en }}</span></li>

                <li><span class="details-name">Происхождение товра: </span><span class="details-content">{{ empty($product->description->origin) ?   __('No')  : $product->description->origin }}</span></li>

                <li><span class="details-name">Product origin in English: </span><span class="details-content">{{ empty($product->description->origin_en) ?   __('No')  : $product->description->origin_en }}</span></li>

                <li><span class="details-name">Состав товара: </span><span class="details-content">{{ empty($product->description->ingredients) ?   __('No')  : $product->description->ingredients }}</span></li>

                <li><span class="details-name">Product ingredients in English: </span><span class="details-content">{{ empty($product->description->ingredients_en) ?   __('No')  : $product->description->ingredients_en }}</span></li>


                <li><span class="details-name">Категория товара: </span><span class="details-content">{{ empty($product->getCategory($product->id)->name) ?   __('No')  : $product->getCategory($product->id)->name }}</span></li>

                <li><span class="details-name">Product category in English: </span><span class="details-content">{{ empty($product->getCategory($product->id)->name_en) ?   __('No')  : $product->getCategory($product->id)->name_en }}</span></li>


                <li><span class="details-name">Подкатегория товара: </span><span class="details-content">{{ empty($product->getSubCategory()->name) ?   __('No')  : $product->getSubCategory()->name }}</span></li>

                <li><span class="details-name">Product subcategory in English: </span><span class="details-content">{{ empty($product->getSubCategory()->name_en) ?   __('No')  : $product->getSubCategory()->name_en }}</span></li>


                <li><span class="details-name">Бренд товара: </span><span class="details-content">{{ empty($product->getBrand()->brand_name) ?   __('No')  : $product->getBrand()->brand_name }}</span></li>

                <li><span class="details-name">Для типа кожи: </span><span class="details-content">{{ empty($product->getSkinType()->name) ?   __('No')  : $product->getSkinType()->name }}</span></li>

                <li><span class="details-name">Product skin type in English: </span><span class="details-content">{{ empty($product->getSkinType()->name_en) ?   __('No')  : $product->getSkinType()->name_en }}</span></li>

                <li><span class="details-name">Для какого возраста: </span><span class="details-content">{{ empty($product->getAgerangeType()->name) ?   __('No')  : $product->getAgerangeType()->name }}</span></li>

                <li><span class="details-name">Product age range in English: </span><span class="details-content">{{ empty($product->getAgerangeType()->name_en) ?   __('No')  : $product->getAgerangeType()->name_en }}</span></li>


                <li><span class="details-name">Потребители товара: </span><span class="details-content">{{ empty($product->getConsumer()->name) ?   __('No')  : $product->getConsumer()->name }}</span></li>

                <li><span class="details-name">Product consumer in English: </span><span class="details-content">{{ empty($product->getConsumer()->name_en) ?   __('No')  : $product->getConsumer()->name_en }}</span></li>
`

                <li><span class="details-name">{{ __('Product pictures') }}: </span><span class="details-content">
                    @if($product->productImages->count() > 0)
                        <ul class="product__images">
                            @foreach ($product->productImages as $image)

                                <li>
                                <img class="product__image" src="{{ asset('storage/'.$image->route) }}" alt="{{ __('Image') }}" />
                                </li>
                            @endforeach
                        </ul>
                    @else
                        {{  __('No') }}.
                    @endif</span></li>

                <li><span class="details-name">{{ __('Amount') }}: </span><span class="details-content">{{ empty($product->amount) ?   __('No')  : $product->amount }}</span></li>

                <li><span class="details-name">{{ __('Price') }}: </span><span class="details-content">{{ empty($product->price) ?   __('No')  : $product->price }}</span></li>


                <li><span class="details-name">{{ __('Discount') }}: </span><span class="details-content">{{ empty($product->reduced_price) ?   __('No')  : $product->reduced_price }}</span></li>

                <li><span class="details-name">{{ __('Top') }}: </span><span class="details-content">{{ $product->top === 1 ? __('Yes') : __('No')  }}</span></li>

                <li><span class="details-name">{{ __('New') }}: </span><span class="details-content">{{ $product->new === 1 ? __('Yes') : __('No') }}</span></li>


                <li><span class="details-name">{{ __('Create date') }}: </span><span class="details-content">{{ $product->created_at }}</span></li>
                <li><span class="details-name">{{ __('Edit date') }}: </span><span class="details-content">{{ $product->updated_at }}</span></li>
            </ul>
        </div>

        <form method="POST"
            @if(isset($archive))
                action="{{ route('admin.product_full_delete', $product) }}"
            @else
                action="{{ route('admin.products.destroy', $product) }}"
            @endif>

            @csrf
            @method('DELETE')


            @if (isset($archive))

                <a class="btn btn-primary" href="{{ route('admin.product_restore', $product) }}"><span>{{ __('Restore') }}</span></a>

            @else
                <a class="btn btn-warning" href="{{ route('admin.products.edit', $product) }}"><span>{{ __('Edit') }}</span></a>
            @endif

            <button class="btn btn-danger" type="submit"><span>{{ __('Delete') }}</span></button>
        </form>

    </div>
</div>

@endsection
