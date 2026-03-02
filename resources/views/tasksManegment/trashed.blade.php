@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <a href="{{ route('admin.tasks.index') }}" class="btn btn-outline-secondary">
                <i class="fas fa-arrow-left me-1"></i>
                {{ __('messages.cancel') }}
            </a>
        </div>
    </div>

    {{-- Deleted Tasks Table --}}
    <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-trash-alt me-2 text-danger"></i>
                {{ __('messages.deleteTask') }}
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-danger text-white">
                        <tr>
                            <th class="px-3 py-3 text-center">{{ __('messages.id') }}</th>
                            <th class="px-3 py-3">{{ __('messages.taskTitle') }}</th>
                            <th class="px-3 py-3">{{ __('messages.userName') }}</th>
                            <th class="px-3 py-3">{{ __('messages.deleted_at') }}</th>
                            <th class="px-3 py-3 text-center">{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($tasks as $task)
                            <tr class="border-bottom">
                                <td class="px-3 text-center">
                                    <span class="badge bg-light text-dark rounded-pill px-3 py-2">
                                        #{{ $task->id }}
                                    </span>
                                </td>
                                <td class="px-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-secondary bg-opacity-10 rounded-circle p-2 me-2">
                                            <i class="fas fa-tasks text-secondary"></i>
                                        </div>
                                        <span class="fw-semibold">{{ $task->title }}</span>
                                    </div>
                                </td>
                                <td class="px-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-info bg-opacity-10 rounded-circle p-2 me-2">
                                            <i class="fas fa-user text-info"></i>
                                        </div>
                                        <span>{{ $task->user->name ?? __('messages.unknown') }}</span>
                                    </div>
                                </td>
                                <td class="px-3">
                                    <span class="badge bg-warning bg-opacity-25 text-dark px-3 py-2 rounded-pill">
                                        <i class="fas fa-clock me-1"></i>
                                        {{ $task->deleted_at->diffForHumans() }}
                                    </span>
                                </td>
                                <td class="px-3">
                                    <div class="d-flex justify-content-center gap-2">
                                        {{-- Restore Button --}}
                                        <form action="{{ route('admin.tasks.restore', $task->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('{{ __('messages.confirmRestore') }}')">
                                            @csrf
                                            @method('PUT')
                                            <button type="submit"
                                                    class="btn btn-sm btn-success rounded-pill px-3 hover-lift"
                                                    data-bs-toggle="tooltip"
                                                    title="{{ __('messages.restore') }}">
                                                <i class="fas fa-trash-restore me-1"></i>
                                                {{ __('messages.restore') }}
                                            </button>
                                        </form>

                                        {{-- Force Delete Button --}}
                                        <form action="{{ route('admin.tasks.forceDelete', $task->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('{{ __('messages.confirmDelete') }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-danger rounded-pill px-3 hover-lift"
                                                    data-bs-toggle="tooltip"
                                                    title="{{ __('messages.forceDelete') }}">
                                                <i class="fas fa-times-circle me-1"></i>
                                                {{ __('messages.forceDelete') }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="fas fa-trash-alt fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">{{ __('messages.NoDeletedTasksFound') ?? 'لا توجد مهام محذوفة' }}</h5>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

            {{ $tasks->withQueryString()->links() }}

</div>


@endsection
