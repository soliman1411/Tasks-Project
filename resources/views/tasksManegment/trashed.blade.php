@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-danger"><th>{{ __('messages.deleteTask') }}</th></h2>
    <table class="table table-bordered text-center">
        <thead>
            <tr>
                <th>{{ __('messages.id') }}</th>
                <th>{{ __('messages.taskTitle') }}</th>
                <th>{{ __('messages.userName') }}</th>
                <th>{{ __('messages.deleted_at') }}</th>
                <th>{{ __('messages.actions') }}</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($tasks as $task)
                <tr>
                    <td>{{ $task->id }}</td>
                    <td>{{ $task->title }}</td>
                    <td>{{$task->user->name}}</td>
                    <td>{{ $task->deleted_at->diffForHumans() }}</td>
                    <td>
                        {{-- استرجاع --}}
                        <form action="{{ route('tasksManegment.restore', $task->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure restore?')"style="display:inline;">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn btn-success btn-sm"
                             >{{ __('messages.restore') }}</button>
                        </form>
                        @role('admin')
                        <form action="{{ route('tasksManegment.forceDelete', $task->id) }}" method="POST"
                            onsubmit="return confirm('Are you sure forceDelete?')"style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-success btn-sm"
                             >{{ __('messages.forceDelete') }}</button>
                        </form>
                        @endrole

                    </td>
                </tr>
            @empty
                <tr><td colspan="5"></td></tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection
