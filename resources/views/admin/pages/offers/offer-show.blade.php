@extends('admin.layout.app')

@section('title', __('Offer'))

@section('content')

<div class="container">

    <div class="admin__offer__section-show d-flex flex-column align-items-center justify-content-start gap-3">

        @if (isset($archive))

            <h2>{{ __('Archive offer') }}</h2>
        @else
            <h2>{{ __('Offer') }}</h2>

        @endif

        @if (isset($archive))

            <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.offers_archive') }}">{{ __('Back') }}</a>

        @else
            <a class="btn btn-light align-self-end  btn-return" href="{{ route('admin.offers.index') }}">{{ __('Back') }}</a>
        @endif


        <div class="offer_details">
            <ul class="offer_details_list">
                <li><span class="details-name">id: </span><span class="details-content">{{ $offer->id }}</span></li>

                <li><span class="details-name">Заголовок: </span><span class="details-content">{{ $offer->title }}</span></li>


                <li><span class="details-name">Title in English: </span><span class="details-content">{{ $offer->title_en }}</span></li>



                <li><span class="details-name">Аннотация предложения: </span><span class="details-content">{{ empty($offer->about) ?   __('No')  : $offer->about }}</span></li>

                <li><span class="details-name">Offer summary in English: </span><span class="details-content">{{ empty($offer->about_en) ?   __('No')  : $offer->about_en }}</span></li>


                <li><span class="details-name">{{ __('Offer picture') }}: </span><span class="details-content">@if($offer->image_route)
                    <img class="brand__image"
                    src="{{ asset('storage/'.$offer->image_route) }}" alt="{{ __('Offer picture') }}" />
                @else
                    {{  __('No') }}.
                @endif</span></li>

                <li><span class="details-name">Описание предложения: </span><span class="details-content">@php echo html_entity_decode($offer->description); @endphp</span></li>

                <li><span class="details-name">Offer description in English: </span><span class="details-content">@php echo html_entity_decode($offer->description_en); @endphp</span></li>

                <li><span class="details-name">{{ __('Discount') }}: </span><span class="details-content">{{ empty($offer->discount_size) ?   __('No')  : $offer->discount_size }}</span></li>


                <li><span class="details-name">{{ __('Period of validity') }}: </span><span class="details-content">
                    @if ((isset($offer->period_from) && isset($offer->period_to)))
                    <span class="offer__period">{{ $offer->period_from->format('H:i / d.m.Y') }}</span> - <span class="offer__period">{{ $offer->period_to->format('H:i / d.m.Y') }}  </span>
                    @else
                        <span>{{ __('No') }}</span>
                    @endif

                </span></li>
                <li><span class="details-name">{{ __('Brands') }}: </span>
                    @forelse ($brands as $name)
                        <span class="details-content">{{ $name }}</span>
                    @empty
                        <span class="details-content">{{ __('No') }}</span>
                    @endforelse
                </li>

                <li><span class="details-name">{{ __('Create date') }}: </span><span class="details-content">{{ $offer->created_at }}</span></li>
                <li><span class="details-name">{{ __('Edit date') }}: </span><span class="details-content">{{ $offer->updated_at }}</span></li>
            </ul>
        </div>

        <form method="POST"
            @if(isset($archive))
                action="{{ route('admin.offers_full_delete', $offer) }}"
            @else
                action="{{ route('admin.offers.destroy', $offer) }}"
            @endif>

            @csrf
            @method('DELETE')


            @if (isset($archive))

                <a class="btn btn-primary" href="{{ route('admin.offers_restore', $offer) }}"><span>{{ __('Restore') }}</span></a>

            @else
                <a class="btn btn-warning" href="{{ route('admin.offers.edit', $offer) }}"><span>{{ __('Edit') }}</span></a>
            @endif

            <button class="btn btn-danger" type="submit"><span>{{ __('Delete') }}</span></button>
        </form>

    </div>
</div>

@endsection
