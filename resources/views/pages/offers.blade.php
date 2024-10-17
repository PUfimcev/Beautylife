@extends('layouts.index')

@section('title', __('offers'))

@section('crumbs')
    <ul class="crumbs__list d-flex justify-content-start align-items-center gap-1">
        <li><a class="crumbs__reffers" href="{{ route('index') }}">{{ __('Main page')}}</a></li>
        <li><span class="crumbs__slash">/</span></li>
        <li><span>{{ __('Offers')}}</span></li>
    </ul>
@endsection

@section('content')


        <section class="offers offers_active">
            <h2 class="offers__title">{{ __('Offers active') }}</h2>

            <div class="offers__elements">

                @forelse ($offers as $offer)
                    @include('pages.elements.offer', ['offer' => $offer])
                @empty
                    <p class="no__offers">{{ __('There are no offers') }}</p>
                @endforelse
            </div>

            @if (!isset($offers) || !empty($offers))
                <div class="pagination">{{ $offers->onEachSide(1)->links() }}</div>
            @endif

        </section>
        <section class="offers offers_archive">
            <h2 class="offers__title">{{ __('Offers inactive') }}</h2>

            <div class="offers__elements">

                @forelse ($offersArch as $offerArch)
                    @include('pages.elements.offer', ['offer' => $offerArch])
                @empty
                    <p class="no__offers">{{ __('There are no offers') }}</p>
                @endforelse
            </div>

            @if (!isset($offersArch) || !empty($offersArch))
            <div class="pagination">{{ $offersArch->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}</div>

            <div class="pagination-tablet">{{ $offersArch->links('vendor.pagination.simple-default')}}</div>
            @endif

        </section>



@endsection
