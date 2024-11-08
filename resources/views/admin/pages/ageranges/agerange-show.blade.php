@extends('admin.layout.app')

@section('title', __('Age ranges'))

@section('content')

<div class="container">

    <div class="admin__agerange__section-show d-flex flex-column align-items-center justify-content-start gap-3">

        @if (isset($archive))

            <h2>{{ __('Archive Age ranges') }}</h2>
        @else
            <h2>{{ __('Age ranges') }}</h2>

        @endif

        @if (isset($archive))

            <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.agerange_archive') }}">{{ __('Back') }}</a>

        @else
            <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.ageranges.index') }}">{{ __('Back') }}</a>
        @endif


        <div class="agerange_details">
            <ul class="agerange_details_list">
                <li><span class="details-name">id: </span><span class="details-content">{{ $agerange->id }}</span></li>

                <li><span class="details-name">Название: </span><span class="details-content">{{ $agerange->name }}</span></li>


                <li><span class="details-name">Name in English: </span><span class="details-content">{{ $agerange->name_en }}</span></li>

                <li><span class="details-name">{{ __('Create date') }}: </span><span class="details-content">{{ $agerange->created_at }}</span></li>

                <li><span class="details-name">{{ __('Edit date') }}: </span><span class="details-content">{{ $agerange->updated_at }}</span></li>
            </ul>
        </div>

        <form method="POST"
            @if(isset($archive))
                action="{{ route('admin.agerange_full_delete', $agerange) }}"
            @else
                action="{{ route('admin.ageranges.destroy', $agerange) }}"
            @endif>

            @csrf
            @method('DELETE')


            @if (isset($archive))

                <a class="btn btn-primary" href="{{ route('admin.agerange_restore', $agerange) }}"><span>{{ __('Restore') }}</span></a>

            @else
                <a class="btn btn-warning" href="{{ route('admin.ageranges.edit', $agerange) }}"><span>{{ __('Edit') }}</span></a>
            @endif

            <button class="btn btn-danger" type="submit"><span>{{ __('Delete') }}</span></button>
        </form>

    </div>
</div>

@endsection
