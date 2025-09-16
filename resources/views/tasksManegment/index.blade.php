@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-primary"></h2>

     <a href="{{ route('tasksManegment.trashed') }}" class="btn btn-success btn-lg">
                        {{ __('messages.recycleBin') }}
    </a>

    {{-- البحث وزر إنشاء مهمة جديدة --}}
   <form action="{{ route('tasksManegment.index') }}" method="get">
    @csrf
     <div class="row mb-4">
        <div class="col-md-8 d-flex">
            <input type="text" name="search" id="search" value="{{ request()->search }}"
                   class="form-control form-control-lg me-2" placeholder="🔍 Search tasks with title">
            <button type="submit" class="btn btn-primary btn-lg">{{ __('messages.search') }}</button>
        </div>
   </form>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <a href="{{ route('tasksManegment.create') }}" class="btn btn-success btn-lg">
                + {{ __('messages.CreateNewTask') }}
            </a>
        </div>
    </div>

    {{-- جدول المهام --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>{{ __('messages.id') }}</th>
                    <th>{{ __('messages.taskTitle') }}</th>
                    <th>{{ __('messages.taskDescription') }}</th>
                    <th>{{ __('messages.is_Done') }}</th>
                    <th>{{ __('messages.user') }}{{ __('messages.name') }}</th>
                    <th>{{ __('messages.actions') }}</th>
                </tr>
            </thead>
            <tbody>
                @forelse($tasks as $task)
                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>{{ $task->title }}</td>
                        <td>{{ $task->description }}</td>
                        <td>
                            @if($task->is_done =="complete")
                                <span class="badge bg-success">{{ __('messages.complete') }}</span>
                            @else
                                <span class="badge bg-warning text-dark">{{ __('messages.inComplete') }}</span>
                            @endif
                        </td>
                        <td>{{$task->user->name}}</td>

                        <td class="d-flex justify-content-center gap-2">
                            <a href="{{ route('tasksManegment.edit', $task->id) }}" class="btn btn-sm btn-primary">
                                {{ __('messages.edit') }}
                            </a>
                            <form action="{{ route('tasksManegment.destroy', $task->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    {{ __('messages.delete') }}
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6">{{ __('messages.NoTasksFound') }}.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $tasks->withQueryString()->links() }}
@endsection
