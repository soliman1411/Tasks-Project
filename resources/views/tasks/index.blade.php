@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4">
    {{-- Header with total tasks centered --}}
    <div class="d-flex flex-wrap justify-content-between align-items-center mb-4">
        <div class="flex-grow-1 text-center">
            <div class="d-inline-flex align-items-center gap-2">
                <span class="badge bg-light text-dark px-4 py-3 rounded-pill shadow-sm" style="font-size: 1.1rem;">
                    <i class="fas fa-clipboard-list me-2 text-primary"></i>
                    <span class="fw-semibold">{{ __('messages.totalTasks') }}:</span>
                    <span class="fw-bold text-primary ms-1" style="font-size: 1.2rem;">{{ $tasks->total() ?? count($tasks) }}</span>
                </span>
            </div>
        </div>

        {{-- Profile Button --}}
        <a href="{{ route('profile.show') }}" class="btn btn-outline-primary rounded-pill px-4 py-2 shadow-sm hover-lift">
            <i class="fas fa-user-circle me-2"></i>
            {{ __('messages.Profile') }}
        </a>
    </div>

    {{-- Search and Create Section - مصغر --}}
    <div class="row g-3 mb-5 align-items-end">
        <div class="col-lg-7">
            <form action="{{ route('tasks.index') }}" method="get" class="d-flex gap-2">
                @csrf
                <div class="flex-grow-1">
                    <div class="input-group shadow-sm">
                        <span class="input-group-text bg-white border-end-0">
                            <i class="fas fa-search text-primary"></i>
                        </span>
                        <input type="text"
                               name="search"
                               id="search"
                               value="{{ request()->search }}"
                               class="form-control border-start-0 ps-0"
                               style="height: 45px;"
                               placeholder="{{ __('messages.searchTasksWithTitle') }}">
                    </div>
                </div>
                <div class="d-flex align-items-end">
                    <button type="submit" class="btn btn-primary px-4 shadow-sm hover-lift" style="height: 45px;">
                        <i class="fas fa-search me-2"></i>
                        {{ __('messages.search') }}
                    </button>
                </div>
            </form>
        </div>

        <div class="col-lg-5 text-lg-end">
            <a href="{{ route('tasks.create') }}" class="btn btn-success px-5 shadow-sm hover-lift" style="height: 45px; line-height: 31px;">
                <i class="fas fa-plus-circle me-2"></i>
                {{ __('messages.CreateNewTask') }}
            </a>
        </div>
    </div>

    {{-- Tasks Table --}}
    <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-gradient bg-primary text-white">
                        <tr>
                            <th class="px-4 py-3 fw-semibold text-center" style="width: 80px;">{{ __('messages.id') }}</th>
                            <th class="px-4 py-3 fw-semibold">{{ __('messages.taskTitle') }}</th>
                            <th class="px-4 py-3 fw-semibold">{{ __('messages.taskDescription') }}</th>
                            <th class="px-4 py-3 fw-semibold text-center" style="width: 150px;">{{ __('messages.is_Done') }}</th>
                            <th class="px-4 py-3 fw-semibold text-center" style="width: 200px;">{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($tasks as $task)
                            <tr class="hover-lift border-bottom">
                                <td class="px-4 text-center fw-bold">
                                    <span class="badge bg-light text-dark rounded-pill px-3 py-2">
                                        #{{ $task->id }}
                                    </span>
                                </td>
                                <td class="px-4">
                                    <div class="d-flex align-items-center">
                                        <div class="me-3">
                                            <i class="fas fa-tasks text-primary opacity-50"></i>
                                        </div>
                                        <div>
                                            <h6 class="mb-0 fw-semibold">{{ $task->title }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="px-4">
                                    <span class="text-muted">{{ Str::limit($task->description, 50) }}</span>
                                </td>
                                <td class="px-4 text-center">
                                    @if($task->is_done == "complete")
                                        <span class="badge bg-success bg-gradient px-4 py-2 rounded-pill">
                                            <i class="fas fa-check-circle me-1"></i>
                                            {{ __('messages.complete') }}
                                        </span>
                                    @else
                                        <span class="badge bg-warning bg-gradient text-dark px-4 py-2 rounded-pill">
                                            <i class="fas fa-clock me-1"></i>
                                            {{ __('messages.inComplete') }}
                                        </span>
                                    @endif
                                </td>
                                <td class="px-4">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('tasks.edit', $task->id) }}"
                                           class="btn btn-sm btn-primary rounded-pill px-3 hover-lift"
                                           data-bs-toggle="tooltip"
                                           title="{{ __('messages.edit') }}">
                                            <i class="fas fa-edit me-1"></i>
                                            {{ __('messages.edit') }}
                                        </a>

                                        <form action="{{ route('tasks.destroy', $task->id) }}"
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
                                <td colspan="5" class="text-center py-5">
                                    <div class="py-4">
                                        <i class="fas fa-clipboard-list fa-4x text-muted mb-3"></i>
                                        <h5 class="text-muted">{{ __('messages.NoTasksFound') }}</h5>
                                        <p class="text-muted mb-4">{{ __('messages.startCreatingTasks') }}</p>
                                        <a href="{{ route('tasks.create') }}" class="btn btn-primary px-5 rounded-pill">
                                            <i class="fas fa-plus-circle me-2"></i>
                                            {{ __('messages.CreateNewTask') }}
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    {{-- Pagination بسيط ومنسق وجميل --}}
    @if(method_exists($tasks, 'links'))
        <div class="d-flex flex-column flex-md-row justify-content-between align-items-center mt-5 pt-4">
            <div class="text-muted small mb-3 mb-md-0">
                <i class="fas fa-tasks me-1 text-primary"></i>
                <span class="fw-semibold text-dark">{{ $tasks->firstItem() ?? 0 }}</span>
                <span class="mx-1">-</span>
                <span class="fw-semibold text-dark">{{ $tasks->lastItem() ?? 0 }}</span>                <span class="fw-semibold text-primary">{{ $tasks->total() }}</span>
                <span class="ms-1">{{ __('messages.tasks') }}</span>
            </div>

            <div class="pagination-custom">
                @if ($tasks->hasPages())
                    <ul class="pagination mb-0">
                        {{-- Previous Page Link --}}
                        @if ($tasks->onFirstPage())
                            <li class="page-item disabled">
                                <span class="page-link">
                                    <i class="fas fa-chevron-right"></i>
                                </span>
                            </li>
                        @else
                            <li class="page-item">
                                <a class="page-link" href="{{ $tasks->previousPageUrl() }}" rel="prev">
                                    <i class="fas fa-chevron-right"></i>
                                </a>
                            </li>
                        @endif

                        {{-- Pagination Elements --}}
                        @foreach ($tasks->getUrlRange(1, $tasks->lastPage()) as $page => $url)
                            @if ($page >= $tasks->currentPage() - 2 && $page <= $tasks->currentPage() + 2)
                                @if ($page == $tasks->currentPage())
                                    <li class="page-item active">
                                        <span class="page-link">{{ $page }}</span>
                                    </li>
                                @else
                                    <li class="page-item">
                                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                                    </li>
                                @endif
                            @endif
                        @endforeach

                        {{-- Next Page Link --}}
                        @if ($tasks->hasMorePages())
                            <li class="page-item">
                                <a class="page-link" href="{{ $tasks->nextPageUrl() }}" rel="next">
                                    <i class="fas fa-chevron-left"></i>
                                </a>
                            </li>
                        @else
                            <li class="page-item disabled">
                                <span class="page-link">
                                    <i class="fas fa-chevron-left"></i>
                                </span>
                            </li>
                        @endif
                    </ul>
                @endif
            </div>
        </div>
    @endif
</div>

@push('styles')
<style>
    .hover-lift {
        transition: all 0.3s ease;
    }
    .hover-lift:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }
    .table > :not(caption) > * > * {
        padding: 1rem 0.75rem;
    }
    .bg-gradient {
        background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
    }
    .input-group-text {
        border-radius: 8px 0 0 8px;
        height: 45px;
    }
    .form-control {
        border-radius: 0 8px 8px 0;
        height: 45px;
        font-size: 0.95rem;
    }
    .btn {
        border-radius: 8px;
        font-weight: 500;
        display: inline-flex;
        align-items: center;
        justify-content: center;
    }
    .btn-lg {
        height: 45px;
        padding: 0 1.5rem;
        font-size: 0.95rem;
    }
    .card {
        transition: all 0.3s ease;
        border-radius: 16px !important;
    }
    .card:hover {
        box-shadow: 0 1rem 3rem rgba(0, 0, 0, 0.175) !important;
    }
    .badge {
        font-weight: 500;
        letter-spacing: 0.3px;
        font-size: 0.85rem;
    }
    .bg-primary.bg-gradient {
        background: linear-gradient(145deg, #0d6efd, #0b5ed7);
    }

    /* Pagination Custom Styles */
    .pagination-custom .pagination {
        display: flex;
        gap: 6px;
        margin: 0;
        padding: 0;
    }

    .pagination-custom .page-item {
        list-style: none;
    }

    .pagination-custom .page-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 38px;
        height: 38px;
        border-radius: 12px !important;
        border: 1px solid #e9ecef;
        background-color: white;
        color: #495057;
        font-weight: 600;
        font-size: 0.95rem;
        transition: all 0.2s ease;
        text-decoration: none;
        box-shadow: 0 2px 5px rgba(0,0,0,0.02);
    }

    .pagination-custom .page-link:hover {
        background-color: #f1f5f9;
        border-color: #cbd5e1;
        color: #0d6efd;
        transform: translateY(-2px);
        box-shadow: 0 6px 12px rgba(13, 110, 253, 0.12);
    }

    .pagination-custom .page-item.active .page-link {
        background: linear-gradient(145deg, #0d6efd, #0b5ed7);
        border-color: #0d6efd;
        color: white;
        box-shadow: 0 6px 14px rgba(13, 110, 253, 0.25);
        font-weight: 600;
    }

    .pagination-custom .page-item.disabled .page-link {
        background-color: #f8f9fa;
        border-color: #e9ecef;
        color: #adb5bd;
        pointer-events: none;
        opacity: 0.7;
        transform: none;
        box-shadow: none;
    }

    .pagination-custom .page-link i {
        font-size: 0.8rem;
        color: currentColor;
    }

    .pagination-custom .page-item:first-child .page-link i,
    .pagination-custom .page-item:last-child .page-link i {
        font-size: 0.9rem;
    }

    @media (max-width: 768px) {
        .col-lg-7, .col-lg-5 {
            width: 100%;
        }
        .text-lg-end {
            text-align: left !important;
            margin-top: 0.5rem;
        }
        .badge.px-4.py-3 {
            font-size: 1rem;
            padding: 0.75rem 1rem !important;
        }

        .pagination-custom .page-link {
            width: 36px;
            height: 36px;
            font-size: 0.9rem;
            border-radius: 10px !important;
        }
    }

    @media (max-width: 576px) {
        .pagination-custom .page-item:not(.active):not(:first-child):not(:last-child) {
            display: none;
        }

        .pagination-custom .page-link {
            width: 42px;
            height: 42px;
        }

        .pagination-custom .page-item:first-child .page-link,
        .pagination-custom .page-item:last-child .page-link {
            width: auto;
            padding: 0 16px;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // تفعيل tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'))
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl)
    });

    // تحسين تجربة البحث
    document.getElementById('search')?.addEventListener('keyup', function(e) {
        if (e.key === 'Enter') {
            e.preventDefault();
            this.closest('form').submit();
        }
    });
</script>
@endpush

<style>
/* تحسينات إضافية للغة العربية */
[dir="rtl"] .input-group-text {
    border-radius: 0 8px 8px 0;
}
[dir="rtl"] .form-control {
    border-radius: 8px 0 0 8px;
}
[dir="rtl"] .me-2, [dir="rtl"] .me-3 {
    margin-left: 0.5rem !important;
    margin-right: 0 !important;
}
[dir="rtl"] .ms-auto {
    margin-right: auto !important;
    margin-left: 0 !important;
}
[dir="rtl"] .text-lg-end {
    text-align: left !important;
}

/* تحسينات RTL للـ Pagination */
[dir="rtl"] .pagination-custom .page-link i.fa-chevron-right {
    transform: rotate(180deg);
}
[dir="rtl"] .pagination-custom .page-link i.fa-chevron-left {
    transform: rotate(180deg);
}
[dir="rtl"] .ms-1 {
    margin-right: 0.25rem !important;
    margin-left: 0 !important;
}
[dir="rtl"] .me-1 {
    margin-left: 0.25rem !important;
    margin-right: 0 !important;
}
</style>
@endsection
