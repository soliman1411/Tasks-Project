@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-danger">{{ __('messages.deleteUser') }}</h2>
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>{{ __('messages.id') }}</th>
                <th>{{ __('messages.name') }}</th>
                <th>{{ __('messages.email') }}</th>
                <th>{{ __('messages.deleted_at') }} {{ __('messages.') }}</th>
                <th>{{ __('messages.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->deleted_at->diffForHumans() }}</td>
                    <td>
                        {{-- استرجاع --}}
                        <form action="{{ route('usersManegment.restore', $user->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure restore?')"style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success btn-sm"
                             >{{ __('messages.restore') }}</button>
                        </form>
             <form action="{{ route('usersManegment.forceDelete', $user->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure forceDelete?')"style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-success btn-sm"
                             >{{ __('messages.forceDelete') }}</button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr><td colspan="5">{{ __('messages.NoDeletedUsersFound') }}.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
