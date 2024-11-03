@extends('admin.layout.app')

@section('title', __('Skin types'))

@section('content')

<div class="container">

    <div class="admin__skintype__section-show d-flex flex-column align-items-center justify-content-start gap-3">

        @if (isset($archive))

            <h2>{{ __('Archive Skin type') }}</h2>
        @else
            <h2>{{ __('Skin types') }}</h2>

        @endif

        @if (isset($archive))

            <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.skintype_archive') }}">{{ __('Back') }}</a>

        @else
            <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.skintypes.index') }}">{{ __('Back') }}</a>
        @endif


        <div class="skintype_details">
            <ul class="skintype_details_list">
                <li><span class="details-name">id: </span><span class="details-content">{{ $skintype->id }}</span></li>

                <li><span class="details-name">Название: </span><span class="details-content">{{ $skintype->name }}</span></li>


                <li><span class="details-name">Name in English: </span><span class="details-content">{{ $skintype->name_en }}</span></li>

                <li><span class="details-name">{{ __('Create date') }}: </span><span class="details-content">{{ $skintype->created_at }}</span></li>

                <li><span class="details-name">{{ __('Edit date') }}: </span><span class="details-content">{{ $skintype->updated_at }}</span></li>
            </ul>
        </div>

        <form method="POST"
            @if(isset($archive))
                action="{{ route('admin.skintype_full_delete', $skintype) }}"
            @else
                action="{{ route('admin.skintypes.destroy', $skintype) }}"
            @endif>

            @csrf
            @method('DELETE')


            @if (isset($archive))

                <a class="btn btn-primary" href="{{ route('admin.skintype_restore', $skintype) }}"><span>{{ __('Restore') }}</span></a>

            @else
                <a class="btn btn-warning" href="{{ route('admin.skintypes.edit', $skintype) }}"><span>{{ __('Edit') }}</span></a>
            @endif

            <button class="btn btn-danger" type="submit"><span>{{ __('Delete') }}</span></button>
        </form>

    </div>
</div>

@endsection
