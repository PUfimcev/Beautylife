@extends('admin.layout.app')

@section('title', __('Subcategory'))

@section('content')

<div class="container">

    <div class="admin__subcategory__section-show d-flex flex-column align-items-center justify-content-start gap-3">

        <h2>{{ __('Category') }}: {{ $category->langField('name') }}</h2>

        @if (isset($archive))

            <h3>{{ __('Archive subcategory') }}</h3>
        @else
            <h3>{{ __('Subcategory') }}</h3>

        @endif

        @if (isset($archive))

            <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.subcategory_archive', $category) }}">{{ __('Back') }}</a>

        @else
            <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.subcategories.index', $category) }}">{{ __('Back') }}</a>
        @endif


        <div class="subcategory_details">
            <ul class="subcategory_details_list">
                <li><span class="details-name">id: </span><span class="details-content">{{ $subcategory->id }}</span></li>

                <li><span class="details-name">Название: </span><span class="details-content">{{ $subcategory->name }}</span></li>


                <li><span class="details-name">Name in English: </span><span class="details-content">{{ $subcategory->name_en }}</span></li>

                <li><span class="details-name">{{ __('Create date') }}: </span><span class="details-content">{{ $subcategory->created_at }}</span></li>

                <li><span class="details-name">{{ __('Edit date') }}: </span><span class="details-content">{{ $subcategory->updated_at }}</span></li>
            </ul>
        </div>

        <form method="POST"
            @if(isset($archive))
                action="{{ route('admin.subcategory_full_delete', [$category, $subcategory]) }}"
            @else
                action="{{ route('admin.subcategories.destroy', [$category, $subcategory]) }}"
            @endif>

            @csrf
            @method('DELETE')


            @if (isset($archive))

                <a class="btn btn-primary" href="{{ route('admin.subcategory_restore', [$category, $subcategory]) }}"><span>{{ __('Restore') }}</span></a>

            @else
                <a class="btn btn-warning" href="{{ route('admin.subcategories.edit', [$category, $subcategory]) }}"><span>{{ __('Edit') }}</span></a>
            @endif

            <button class="btn btn-danger" type="submit"><span>{{ __('Delete') }}</span></button>
        </form>

    </div>
</div>

@endsection
