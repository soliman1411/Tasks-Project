@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-danger">Deleted Users</h2>
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>email</th>
                <th>password</th>
                <th>Deleted At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->password }}</td>
                    <td>{{ $user->deleted_at->diffForHumans() }}</td>
                    <td>
                        {{-- استرجاع --}}
                        <form action="{{ route('usersManegment.restore', $user->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure restore?')"style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success btn-sm"
                             >Restore</button>
                        </form>
             <form action="{{ route('usersManegment.forceDelete', $user->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure forceDelete?')"style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-success btn-sm"
                             >forceDelete</button>
                        </form>

                    </td>
                </tr>
            @empty
                <tr><td colspan="6">No Deleted Users Found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
