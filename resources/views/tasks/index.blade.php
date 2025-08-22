@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-primary">All Tasks</h2>

    {{-- البحث وزر إنشاء مهمة جديدة --}}
   <form action="{{ route('tasks.index') }}" method="get">
    @csrf
     <div class="row mb-4">
        <div class="col-md-8 d-flex">
            <input type="text" name="search" id="search" value="{{ request()->search }}"
                   class="form-control form-control-lg me-2" placeholder="🔍 Search tasks with title">
            <button type="submit" class="btn btn-primary btn-lg">Search</button>
        </div>
   </form>
        <div class="col-md-4 text-md-end mt-3 mt-md-0">
            <a href="{{ route('tasks.create') }}" class="btn btn-success btn-lg">
                + Create New Task
            </a>
        </div>
    </div>
<a href="{{ route('tasks.trashed') }}" class="btn btn-success btn-lg">
                                سلة المحذوفات
                            </a>
    {{-- جدول المهام --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Is_Done</th>
                    <th>Actions</th>
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
                                <span class="badge bg-success">complete</span>
                            @else
                                <span class="badge bg-warning text-dark">incomplete</span>
                            @endif
                        </td>
                        <td class="d-flex justify-content-center gap-2">
                            <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-sm btn-primary">
                                Edit
                            </a>
                            <form action="{{ route('tasks.destroy', $task->id) }}" method="POST"
                                  onsubmit="return confirm('Are you sure?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
                                    Delete
                                </button>
                            </form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5">No tasks found.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>


@endsection