@extends('admin.layout.app')

@section('title', __('Category'))

@section('content')

<div class="container">

    <div class="admin__category__section-show d-flex flex-column align-items-center justify-content-start gap-3">

        @if (isset($archive))

            <h2>{{ __('Archive category') }}</h2>
        @else
            <h2>{{ __('Category') }}</h2>

        @endif

        @if (isset($archive))

            <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.category_archive') }}">{{ __('Back') }}</a>

        @else
            <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.categories.index') }}">{{ __('Back') }}</a>
        @endif


        <div class="category_details">
            <ul class="category_details_list">
                <li><span class="details-name">id: </span><span class="details-content">{{ $category->id }}</span></li>

                <li><span class="details-name">Название: </span><span class="details-content">{{ $category->name }}</span></li>


                <li><span class="details-name">Name in English: </span><span class="details-content">{{ $category->name_en }}</span></li>

                <li><span class="details-name">{{ __('Create date') }}: </span><span class="details-content">{{ $category->created_at }}</span></li>

                <li><span class="details-name">{{ __('Edit date') }}: </span><span class="details-content">{{ $category->updated_at }}</span></li>
            </ul>
        </div>

        <div class="admin__subcategory__section-show d-flex flex-column align-items-center justify-content-start gap-3">

            <h3>{{ __('Subcategories') }}</h3>
            <ul class="subcategory_details">
                @forelse ($subcategories as $subcategory)

                    <li class="details-content">{{ $i++ }}. {{ $subcategory->langField('name') }}</li>

                @empty
                    <li>{{ __('No subcategories') }}</li>
                @endforelse
            </ul>

        </div>

        <form method="POST"
            @if(isset($archive))
                action="{{ route('admin.category_full_delete', $category) }}"
            @else
                action="{{ route('admin.categories.destroy', $category) }}"
            @endif>

            @csrf
            @method('DELETE')


            @if (isset($archive))

                <a class="btn btn-primary" href="{{ route('admin.category_restore', $category) }}"><span>{{ __('Restore') }}</span></a>

            @else
                <a class="btn btn-warning" href="{{ route('admin.categories.edit', $category) }}"><span>{{ __('Edit') }}</span></a>
            @endif

            <button class="btn btn-danger" type="submit"><span>{{ __('Delete') }}</span></button>
        </form>

    </div>
</div>

@endsection
