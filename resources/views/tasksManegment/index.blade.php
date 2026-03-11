@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">

    {{-- Header with Actions --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold mb-0">{{ __('messages.AllTasks') }}</h4>
        <div class="d-flex gap-2">
            {{-- Trash Button --}}
            <a href="{{ route('admin.tasks.trashed') }}" class="btn btn-outline-danger d-flex align-items-center gap-2" style="height: 45px;">
                <i class="fas fa-trash-restore"></i>
                {{ __('messages.recycleBin') }}
            </a>

            {{-- Create Task Button --}}
            <a href="{{ route('admin.tasks.create') }}" class="btn btn-success d-flex align-items-center gap-2" style="height: 45px;">
                <i class="fas fa-plus-circle"></i>
                {{ __('messages.CreateNewTask') }}
            </a>
        </div>
    </div>

    {{-- Search Form --}}
    <div class="card border-0 shadow-sm rounded-3 mb-4">
        <div class="card-body p-3">
            <form action="{{ route('admin.tasks.index') }}" method="get" class="row g-2">
                <div class="col-md-9">
                    <div class="input-group">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-primary"></i>
                        </span>
                        <input type="text"
                               name="search"
                               id="search"
                               value="{{ request()->search }}"
                               class="form-control border-start-0"
                               placeholder="{{ __('messages.searchTasksWithTitle') }}"
                               style="height: 45px;">
                    </div>
                </div>
                <div class="col-md-3">
                    <button type="submit" class="btn btn-primary w-100" style="height: 45px;">
                        <i class="fas fa-search me-2"></i>{{ __('messages.search') }}
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
                {{ __('messages.AllTasks') }}
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
                            <th class="px-3 py-3">{{ __('messages.userName') }}</th>
                            <th class="px-3 py-3">{{ __('messages.is_Done') }}</th>
                            <th class="px-3 py-3">{{ __('messages.actions') }}</th>
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
                                <td class="px-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-info bg-opacity-10 rounded-circle p-1 me-2">
                                            <i class="fas fa-user text-info"></i>
                                        </div>
                                        <div>
                                            <span class="fw-semibold">{{ $task->user->name  ?? 'User deleted'}}</span>
                                        </div>
                                    </div>
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
                                <td class="px-3">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.tasks.edit', $task->id) }}"
                                           class="btn btn-sm btn-primary rounded-pill px-3 hover-lift"
                                           data-bs-toggle="tooltip"
                                           title="{{ __('messages.edit') }}">
                                            <i class="fas fa-edit me-1"></i>
                                            {{ __('messages.edit') }}
                                        </a>

                                        <form action="{{ route('admin.tasks.destroy', $task->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('{{ __('messages.confirmDelete') }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-danger rounded-pill px-3 hover-lift"
                                                    data-bs-toggle="tooltip"
                                                    title="{{ __('messages.delete') }}">
                                                <i class="fas fa-trash-alt me-1"></i>
                                                {{ __('messages.delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5">
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
    <div class="mt-4">
        {{ $tasks->withQueryString()->links() }}
    </div>
</div>
@endsection
