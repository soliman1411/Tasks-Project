@extends('layouts.admin')

@section('content')
<div class="container mt-5">
    <h2 class="mb-4 text-primary">{{ __('messages.AllTasks') }} {{ $user->name }}</h2>

    {{-- البحث وزر إنشاء مهمة جديدة --}}
   <form action="{{ route('admin.showTasks', $user->id) }}" method="get">

     <div class="row mb-4">
        <div class="col-md-8 d-flex">
            <input type="text" name="search" id="search" value="{{ request()->search }}"
                   class="form-control form-control-lg me-2" placeholder="🔍 {{ __('messages.searchTasksWithTitle') }}">
            <button type="submit" class="btn btn-primary btn-lg">{{ __('messages.search') }}</button>
        </div>
   </form>


    {{-- جدول المهام --}}
    <div class="table-responsive">
        <table class="table table-bordered table-hover align-middle text-center">
            <thead class="table-dark">
                <tr>
                    <th>{{ __('messages.id') }}</th>
                    <th>{{ __('messages.taskTitle') }}</th>
                    <th>{{ __('messages.taskDescription') }}</th>
                    <th>{{ __('messages.is_Done') }}</th>
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

                    </tr>
                @empty
                    <tr>
                        <td colspan="4">.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{ $tasks->withQueryString()->links() }}
@endsection
