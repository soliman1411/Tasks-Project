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
{{ $tasks->links() }}

</div>



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
