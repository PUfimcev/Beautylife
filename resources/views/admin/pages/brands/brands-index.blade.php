@extends('admin.layout.app')

@section('title', __('Brands'))

@section('content')

<div class="container">
    <div class="admin__brands__section d-flex flex-column align-items-center justify-content-start">

        <h2>{{  __('Brands') }}</h2>

        <a class="btn btn-success message__create" href="{{ route('admin.brands.create') }}">{{ __('Create') }}</a>

        <table class="table table-striped table__brand">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Brand') }}</th>
                    <th scope="col">{{ __('Image') }}</th>
                    <th scope="col">{{ __('Summary') }}</th>
                    <th scope="col">{{ __('Created') }}</th>
                    <th scope="col">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @forelse ($brands as $brand)
                    <tr>
                        <td scope="row">{{ ++$i }}</td>
                        <td><span class="brand__title">{{ $brand->brand_name }}</span></td>
                        <td>@if($brand->brand_image_route)
                            <img class="brand__image"
                            src="{{ asset('storage/'.$brand->brand_image_route) }}" alt="{{ __('Image') }}" />
                        @else
                            <span>{{  __('No') }}</span>
                        @endif
                        </td>
                        <td><span class="brand__content">{{ $brand->langField('brand_about') }}</span></td>
                        <td><span class="brand__date">{{ $brand->updated_at->format('H:i / d.m.Y') }}</span></td>

                        <td><form method="POST" action="{{ route('admin.brands.destroy', $brand) }}">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-secondary" href="{{ route('admin.brands.show', $brand) }}"><span>{{ __('Show') }}</span></a>
                                <a class="btn btn-warning" href="{{ route('admin.brands.edit', $brand) }}"><span>{{ __('Edit') }}</span></a>
                                <button class="btn btn-danger" type="submit"><span>{{ __('Delete') }}</span></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="no__brands">
                        <td colspan="8" class="no__brands_projects">{{ __('There are no brands') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if (!isset($brands) || !empty($brands))
            <div class="pagination">{{ $brands->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}</div>
        @endif

    </div>
</div>

@endsection
