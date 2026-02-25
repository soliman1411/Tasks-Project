@extends('layouts.admin')


@section('content')
<div class="container-fluid px-4 py-4">

    {{-- Header with user info --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-3">
            <div class="bg-info bg-opacity-10 p-3 rounded-circle">
                <i class="fas fa-user text-info fa-2x"></i>
            </div>
            <div>
                <h2 class="fw-bold mb-1" style="color: #0dcaf0;">
                    {{ __('messages.userName') }}: {{ $user->name }}
                </h2>
                <p class="text-muted mb-0">
                    <i class="fas fa-envelope me-1"></i> {{ $user->email }}
                </p>
            </div>
        </div>
        <div>
            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-secondary me-2">
                <i class="fas fa-arrow-left me-1"></i>{{ __('messages.cancel') }}
            </a>
            <a href="{{ route('admin.dashboard') }}" class="btn btn-outline-primary">
                <i class="fas fa-tachometer-alt me-1"></i>{{ __('messages.Dashboard') }}
            </a>
        </div>
    </div>



    {{-- Search and Filter --}}
    <div class="card border-0 shadow-sm rounded-3 mb-4">
        <div class="card-body p-3">
            <form action="{{ route('admin.showTasks', $user) }}" method="get" class="row g-2">
                <div class="col-md-5">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-primary"></i>
                        </span>
                        <input type="text"
                               name="search"
                               value="{{ request('search') }}"
                               class="form-control border-start-0"
                               placeholder="{{ __('messages.searchTasksWithTitle') }}"
                               style="height: 45px;">
                    </div>
                </div>

                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100" style="height: 45px;">
                        <i class="fas fa-filter me-2"></i>{{ __('messages.search') }}
                    </button>
                </div>
            </form>
        </div>
    </div>

    {{-- Tasks Table --}}
    <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-list-check me-2 text-primary"></i>
                {{ __('messages.tasks') }}
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="px-3 py-3 text-center">{{ __('messages.id') }}</th>
                            <th class="px-3 py-3">{{ __('messages.taskTitle') }}</th>
                            <th class="px-3 py-3">{{ __('messages.taskDescription') }}</th>
                            <th class="px-3 py-3 text-center">{{ __('messages.is_Done') }}</th>
                            <th class="px-3 py-3 text-center">{{ __('messages.createdAt') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tasks as $task)
                            <tr class="border-bottom">
                                <td class="px-3 text-center">
                                    <span class="badge bg-light text-dark rounded-pill px-3 py-2">
                                        #{{ $task->id }}
                                    </span>
                                </td>
                                <td class="px-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-tasks text-primary me-2 opacity-50"></i>
                                        <span class="fw-semibold">{{ $task->title }}</span>
                                    </div>
                                </td>
                                <td class="px-3">
                                    <span class="text-muted">{{ Str::limit($task->description, 50) }}</span>
                                </td>
                                <td class="px-3 text-center">
                                    @if($task->is_done == "complete")
                                        <span class="badge bg-success px-3 py-2 rounded-pill">
                                            <i class="fas fa-check-circle me-1"></i>
                                            {{ __('messages.complete') }}
                                        </span>
                                    @else
                                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ __('messages.inComplete') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-3 text-center">
                                    {{ $task->created_at->format('Y-m-d') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="fas fa-tasks fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">{{ __('messages.NoTasksFound') }}</h5>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Pagination --}}
    <div class="d-flex justify-content-between align-items-center mt-4">
        <div class="text-muted small">
            <i class="fas fa-tasks me-1 text-primary"></i>
            {{ __('messages.showing') }} {{ $tasks->firstItem() ?? 0 }} - {{ $tasks->lastItem() ?? 0 }}
            {{ __('messages.of') }} {{ $tasks->total() }} {{ __('messages.tasks') }}
        </div>
        <div>
            {{ $tasks->withQueryString()->links() }}
        </div>
    </div>
</div>
@endsection
