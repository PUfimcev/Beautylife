@extends('admin.layout.app')

@section('title', __('Consumers'))

@section('content')

<div class="container">
    <div class="admin__consumers__section d-flex flex-column align-items-center justify-content-start">

        <h2>{{  __('Consumers') }}</h2>

        @if (isset($archive))
        <a class="btn btn-warning consumer__create mt-3" href="{{ route('admin.consumers.index') }}">{{ __('Active') }}</a>
        @else
            <a class="btn btn-success consumer__create" href="{{ route('admin.consumers.create') }}">{{ __('Create') }}</a>

            <a class="btn btn-warning consumer__create mt-3" href="{{ route('admin.consumer_archive') }}">{{ __('Archive') }}</a>
        @endif

        <table class="table table-striped table__consumers">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Code') }}</th>
                    <th scope="col">{{ __('Name') }}</th>
                    <th scope="col">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @forelse ($consumers as $consumer)
                    <tr>
                        <td scope="row">{{ ++$i }}</td>
                        <td><span class="category__code">{{ $consumer->code }}</span></td>

                        <td><span class="category__name">{{ $consumer->langField('name') }}</span></td>

                        <td><form method="POST"

                            @if(isset($archive))
                                action="{{ route('admin.consumer_full_delete', $consumer) }}"
                            @else
                                action="{{ route('admin.consumers.destroy', $consumer) }}"
                            @endif>
                                @csrf
                                @method('DELETE')


                                @if (isset($archive))
                                    <a class="btn btn-secondary" href="{{ route('admin.consumer_show', $consumer) }}"><span>{{ __('Show') }}</span></a>

                                @else
                                    <a class="btn btn-secondary" href="{{ route('admin.consumers.show', $consumer) }}"><span>{{ __('Show') }}</span></a>
                                @endif

                                @if (isset($archive))
                                    <a class="btn btn-primary" href="{{ route('admin.consumer_restore', $consumer) }}"><span>{{ __('Restore') }}</span></a>
                                @else
                                    <a class="btn btn-warning" href="{{ route('admin.consumers.edit', $consumer) }}"><span>{{ __('Edit') }}</span></a>
                                @endif
                                <button class="btn btn-danger" type="submit"><span>{{ __('Delete') }}</span></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="no__consumers">
                        <td colspan="8" class="no__consumers_projects">{{ __('There are no subcategories') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        @if (!isset($consumers) || !empty($consumers))
            <div class="pagination">{{ $consumers->onEachSide(1)->links('vendor.pagination.bootstrap-5') }}</div>
        @endif

    </div>
</div>

@endsection



