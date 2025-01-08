@extends('admin.layout.app')

@section('title', __('Products'))

@section('content')

<div class="container">
    <div class="admin__products__section d-flex flex-column align-items-center justify-content-start">

        <h2>{{  __('Products') }}</h2>

        <form method="GET"

            @if (isset($archive))

                action="{{ route('admin.products_archive') }}"

            @else
                action="{{ route('admin.products.index') }}"

            @endif>
            @method('POST')
            <div class="search-elem input-group mb-3">
                @if (isset($archive))

                    <a href="{{ route('admin.products_archive') }}" class="btn btn-outline-secondary border-0" type="submit">{{ __('Clear') }}</a>

                @else

                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary border-0" type="submit">{{ __('Clear') }}</a>

                @endif

                <input type="text" class="form-control" name="findData" placeholder="{{ __('Find product') }}" aria-describedby="button-addon2">
                <button class="btn btn-outline-secondary border-0" type="submit" id="button-addon2">{{ __('Find') }}</button>
            </div>
            @csrf
        </form>


        @if (isset($archive))
        <a class="btn btn-warning product__create mt-3" href="{{ route('admin.products.index') }}">{{ __('Active') }}</a>
        @else
            <a class="btn btn-success product__create" href="{{ route('admin.products.create') }}">{{ __('Create') }}</a>

            <a class="btn btn-warning product__create mt-3" href="{{ route('admin.products_archive') }}">{{ __('Archive') }}</a>
        @endif

        <table class="table table-striped table__products">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Code') }}</th>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Price') }}</th>
                    <th scope="col">{{ __('Reduced price') }}</th>
                    <th scope="col">{{ __('Amount') }}</th>
                    <th scope="col">{{ __('New') }}</th>
                    <th scope="col">{{ __('Top') }}</th>
                    <th scope="col">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @forelse ($products as $product)
                    <tr>
                        <td scope="row">{{ ++$i }}</td>
                        <td><span class="category__code">{{ $product->code }}</span></td>
                        <td><span class="category__name">{{ $product->langField('name') }}</span></td>
                        <td><span class="category__price">{{ $product->price }}</span></td>
                        <td><span class="category__reduced_price">{{ $product->reduced_price }}</span></td>
                        <td><span class="category__amount">{{ $product->amount }}</span></td>
                        <td><span class="category__new">{{ $product->new === 1 ? __('Yes') : __('No') }}</span></td>
                        <td><span class="category__top">{{ $product->top === 1 ? __('Yes') : __('No') }}</span></td>

                        <td><form method="POST"

                            @if(isset($archive))
                                action="{{ route('admin.product_full_delete', $product) }}"
                            @else
                                action="{{ route('admin.products.destroy', $product) }}"
                            @endif>
                                @csrf
                                @method('DELETE')


                                @if (isset($archive))
                                    <a class="btn btn-secondary" href="{{ route('admin.product_show', $product) }}"><span>{{ __('Show') }}</span></a>

                                @else
                                    <a class="btn btn-secondary" href="{{ route('admin.products.show', $product) }}"><span>{{ __('Show') }}</span></a>
                                @endif

                                @if (isset($archive))
                                    <a class="btn btn-primary" href="{{ route('admin.product_restore', $product) }}"><span>{{ __('Restore') }}</span></a>
                                @else
                                    <a class="btn btn-warning" href="{{ route('admin.products.edit', $product) }}"><span>{{ __('Edit') }}</span></a>
                                @endif
                                <button class="btn btn-danger" type="submit"><span>{{ __('Delete') }}</span></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="no__products">
                        <td colspan="9" class="no__products_projects">{{ __('There are no products') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if (!isset($products) || !empty($products))
            <div class="pagination">{{ $products->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}</div>
        @endif

    </div>
</div>

@endsection



