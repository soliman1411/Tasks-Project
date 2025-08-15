@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-primary">All Tasks of {{ $user->name }}</h2>

    {{-- البحث وزر إنشاء مهمة جديدة --}}
   <form action="{{ route('admin.showTasks', $user->id) }}" method="get">

     <div class="row mb-4">
        <div class="col-md-8 d-flex">
            <input type="text" name="search" id="search" value="{{ request()->search }}"
                   class="form-control form-control-lg me-2" placeholder="🔍 Search tasks with title">
            <button type="submit" class="btn btn-primary btn-lg">Search</button>
        </div>
   </form>
     

    {{-- جدول المهام --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>ID</th>
                    <th>Title</th>
                    <th>Description</th>
                    <th>Is_Done</th>
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
                       
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No tasks Of User.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $tasks->withQueryString()->links() }}
@endsection
