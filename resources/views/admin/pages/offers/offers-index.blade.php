@extends('admin.layout.app')

@section('title', __('Offers'))

@section('content')

<div class="container">
    <div class="admin__offers__section d-flex flex-column align-items-center justify-content-start">

        <h2>{{  __('Offers') }}</h2>

        @if (isset($archive))
        <a class="btn btn-warning message__create mt-3" href="{{ route('admin.offers.index') }}">{{ __('Active') }}</a>
        @else
            <a class="btn btn-success message__create" href="{{ route('admin.offers.create') }}">{{ __('Create') }}</a>

            <a class="btn btn-warning message__create mt-3" href="{{ route('admin.offers_archive') }}">{{ __('Archive') }}</a>
        @endif

        <table class="table table-striped table__offers">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Title') }}</th>
                    <th scope="col">{{ __('Image') }}</th>
                    <th scope="col">{{ __('Summary') }}</th>
                    <th scope="col">{{ __('Period of validity') }}</th>
                    <th scope="col">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @forelse ($offers as $offer)
                    <tr>
                        <td scope="row">{{ ++$i }}</td>
                        <td><span class="offer__title">{{ $offer->langField('title') }}</span></td>
                        <td>@if($offer->image_route)
                            <img class="offer__image"
                            src="{{ asset('storage/'.$offer->image_route) }}" alt="{{ __('Image') }}" />
                        @else
                            <span>{{  __('No') }}</span>
                        @endif
                        </td>
                        <td><span class="offer__content">{{ $offer->langField('about') }}</span></td>

                        <td>
                            @if ((isset($offer->period_from) && isset($offer->period_to)))

                                <span class="offer__period">{{ $offer->period_from->format('H:i / d.m.Y') }}</span> - </br>
                                <span class="offer__period">{{ $offer->period_to->format('H:i / d.m.Y') }}  </span>
                            @else
                                <span>{{ __('No') }}</span>
                            @endif
                        </td>

                        <td><form method="POST"

                            @if(isset($archive))
                                action="{{ route('admin.offers_full_delete', $offer) }}"
                            @else
                                action="{{ route('admin.offers.destroy', $offer) }}"
                            @endif>
                                @csrf
                                @method('DELETE')


                                @if (isset($archive))
                                    <a class="btn btn-secondary" href="{{ route('admin.offer_show', $offer) }}"><span>{{ __('Show') }}</span></a>

                                @else
                                    <a class="btn btn-secondary" href="{{ route('admin.offers.show', $offer) }}"><span>{{ __('Show') }}</span></a>
                                @endif

                                @if (isset($archive))
                                    <a class="btn btn-primary" href="{{ route('admin.offers_restore', $offer) }}"><span>{{ __('Restore') }}</span></a>
                                @else
                                    <a class="btn btn-warning" href="{{ route('admin.offers.edit', $offer) }}"><span>{{ __('Edit') }}</span></a>
                                @endif
                                <button class="btn btn-danger" type="submit"><span>{{ __('Delete') }}</span></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="no__offers">
                        <td colspan="8" class="no__offers_projects">{{ __('There are no offers') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if (!isset($offers) || !empty($offers))
            <div class="pagination">{{ $offers->onEachSide(1)->links() }}</div>
        @endif

    </div>
</div>

@endsection



