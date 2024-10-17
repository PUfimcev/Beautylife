@extends('admin.layout.app')

@section('title', __('Callbacks'))

@section('content')

<div class="container">
<div class="admin__callbacks__section d-flex flex-column align-items-center justify-content-start">

    <h2>{{ __('Callbacks') }}</h2>

    <table class="table table-striped table__callbacks">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">{{ __('Name') }}</th>
                <th scope="col">{{ __('Phone number') }}</th>
                <th scope="col">{{ __('Request date') }}</th>
                <th scope="col">{{ __('Action') }}</th>
            </tr>
        </thead>
        <tbody class="table-group-divider">
            @forelse ($callbacks as $callback)
                <tr>
                    <td scope="row">{{ ++$i }}</td>
                    <td><span class="callbacks__names">{{ $callback->name }}</span></td>
                    <td><span class="callbacks__phone">{{ $callback->phone_number }}</span></td>
                    <td><span class="callbacks__date">{{ $callback->created_at->setTimezone($local_timezone)->format('H:i / d.m.Y') }}</span></td>
                    <td><form method="POST" action="{{ route('callbacks.destroy', $callback) }}">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-danger" type="submit"><span>{{ __('Delete') }}</span></button>
                        </form>
                    </td>
                </tr>
            @empty
                <tr class="no__callbacks">
                    <td colspan="5" class="no__callbacks_text">{{ __('There are no requests of callbacks') }}</td>
                </tr>
            @endforelse
        </tbody>
    </table>

    @if (!isset($callbacks) || !empty($callbacks))
    <div class="pagination">{{ $callbacks->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}</div>
    @endif

</div>
</div>

@endsection
