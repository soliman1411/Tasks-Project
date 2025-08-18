@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-danger">Deleted Tasks</h2>
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>ID</th>
                <th>Title</th>
                <th>Deleted At</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{ $task->deleted_at->diffForHumans() }}</td>
                    <td>
                        {{-- استرجاع --}}
                        <form action="{{ route('tasks.restore', $task->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure restore?')"style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success btn-sm"
                             >Restore</button>
                        </form>


                    </td>
                </tr>
            @empty
                <tr><td colspan="4">No Deleted Tasks Found.</td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
