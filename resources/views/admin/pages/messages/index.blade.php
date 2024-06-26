@extends('admin.layout.app')

@section('title', __('Messages'))

@section('content')

<div class="container">
    <div class="admin__messages__section d-flex flex-column align-items-center justify-content-start">

        <h2>{{  __('Messages') }}</h2>

        <a class="btn btn-success message__create" href="{{ route('admin.messages.create') }}">{{ __('Create') }}</a>

        <table class="table table-striped table__messages">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">{{ __('Subject') }}</th>
                    <th scope="col">{{ __('Type') }}</th>
                    <th scope="col">{{ __('Created') }}</th>
                    <th scope="col">{{ __('Action') }}</th>
                </tr>
            </thead>
            <tbody class="table-group-divider">
                @forelse ($messages as $message)
                    <tr>
                        <td scope="row">{{ ++$i }}</td>
                        <td><a href="{{ route('admin.messages.show', $message) }}"><span class="message__subject">{{ $message->langField('subject') }}</span></a></td>
                        <td><span class="message__type">{{ __($message->type) }}</span></td>
                        <td><span class="message__date">{{ $message->updated_at }}</span></td>
                        <td><form method="POST" action="{{ route('admin.messages.destroy', $message) }}">
                                @csrf
                                @method('DELETE')
                                <a class="btn btn-primary" href="{{ route('admin.mail_message', $message) }}"><span>{{ __('Send') }}</span></a>
                                <a class="btn btn-secondary" href="{{ route('admin.messages.show', $message) }}"><span>{{ __('Show') }}</span></a>
                                <a class="btn btn-warning" href="{{ route('admin.messages.edit', $message) }}"><span>{{ __('Update') }}</span></a>
                                <button class="btn btn-danger" type="submit"><span>{{ __('Delete') }}</span></button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr class="no__messages">
                        <td colspan="5" class="no__messages_projects">{{ __('There are no messages') }}</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        @isset($messages) <div class="pagination">{{ $messages->onEachSide(1)->links() }}</div> @endisset


    </div>
</div>

@endsection
