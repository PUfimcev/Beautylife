@extends('admin.layout.app')

@section('title', __('Consumer'))

@section('content')

<div class="container">

    <div class="admin__consumer__section-show d-flex flex-column align-items-center justify-content-start gap-3">

        @if (isset($archive))

            <h2>{{ __('Archive Consumer') }}</h2>
        @else
            <h2>{{ __('Consumer') }}</h2>

        @endif

        @if (isset($archive))

            <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.consumer_archive') }}">{{ __('Back') }}</a>

        @else
            <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.consumers.index') }}">{{ __('Back') }}</a>
        @endif


        <div class="consumer_details">
            <ul class="consumer_details_list">
                <li><span class="details-name">id: </span><span class="details-content">{{ $consumer->id }}</span></li>

                <li><span class="details-name">Потребитель: </span><span class="details-content">{{ $consumer->name }}</span></li>


                <li><span class="details-name">Consumer in English: </span><span class="details-content">{{ $consumer->name_en }}</span></li>

                <li><span class="details-name">{{ __('Create date') }}: </span><span class="details-content">{{ $consumer->created_at }}</span></li>

                <li><span class="details-name">{{ __('Edit date') }}: </span><span class="details-content">{{ $consumer->updated_at }}</span></li>
            </ul>
        </div>

        <form method="POST"
            @if(isset($archive))
                action="{{ route('admin.consumer_full_delete', $consumer) }}"
            @else
                action="{{ route('admin.consumers.destroy', $consumer) }}"
            @endif>

            @csrf
            @method('DELETE')


            @if (isset($archive))

                <a class="btn btn-primary" href="{{ route('admin.consumer_restore', $consumer) }}"><span>{{ __('Restore') }}</span></a>

            @else
                <a class="btn btn-warning" href="{{ route('admin.consumers.edit', $consumer) }}"><span>{{ __('Edit') }}</span></a>
            @endif

            <button class="btn btn-danger" type="submit"><span>{{ __('Delete') }}</span></button>
        </form>

    </div>
</div>

@endsection
