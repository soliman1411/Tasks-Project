@extends('layouts.app')

@section('content')
<div class="container py-4">
    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center gap-2">
            <div class="bg-warning bg-opacity-10 p-2 rounded-circle">
                <i class="fas fa-edit text-warning fa-lg"></i>
            </div>
            <h2 class="fw-bold mb-0" style="color: #ffc107; font-size: 1.9rem;">
                {{ __('messages.taskUpdating') }}
            </h2>
        </div>

    </div>

    {{-- Update Task Form --}}
    <div class="row">
        <div class="col-md-8 col-lg-6 mx-auto">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Task Title --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium">
                                {{ __('messages.taskTitle') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title', $task->title) }}"
                                   placeholder="{{ __('messages.taskTitle') ?? 'أدخل عنوان المهمة' }}">
                            @error('title')
                                <div class="alert alert-danger py-2 mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Task Description --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium">
                                {{ __('messages.taskDescription') }}
                                <span class="text-danger">*</span>
                            </label>
                            <textarea name="description"
                                      class="form-control @error('description') is-invalid @enderror"
                                      rows="4"
                                      placeholder="{{ __('messages.taskDescription') ?? 'أدخل وصف المهمة' }}">{{ old('description', $task->description) }}</textarea>
                            @error('description')
                                <div class="alert alert-danger py-2 mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- Task Status --}}
                        <div class="mb-4">
                            <label class="form-label fw-medium">
                                {{ __('messages.taskStatus') }}
                                <span class="text-danger">*</span>
                            </label>
                            <select name="is_done" class="form-select @error('is_done') is-invalid @enderror">
                                <option value="incomplete" {{ old('is_done', $task->is_done) == 'incomplete' ? 'selected' : '' }}>
                                    {{ __('messages.inComplete') }}
                                </option>
                                <option value="complete" {{ old('is_done', $task->is_done) == 'complete' ? 'selected' : '' }}>
                                    {{ __('messages.complete') }}
                                </option>
                            </select>
                            @error('is_done')
                                <div class="alert alert-danger py-2 mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Form Actions --}}
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('tasks.index') }}" class="btn btn-light px-4">
                                {{ __('messages.cancel') ?? 'إلغاء' }}
                            </a>
                            <button type="submit" class="btn btn-warning px-4">
                                <i class="fas fa-save me-1"></i>
                                {{ __('messages.update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>

<style>
    /* نفس تنسيقات صفحة الإنشاء */
    .container {
        max-width: 1140px;
    }

    /* تحسين العنوان */
    .bg-warning.bg-opacity-10 {
        background-color: rgba(255, 193, 7, 0.1) !important;
        width: 45px;
        height: 45px;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .fa-edit {
        font-size: 1.5rem;
    }

    h2.fw-bold {
        position: relative;
        display: inline-block;
    }

    h2.fw-bold::after {
        content: '';
        position: absolute;
        bottom: -5px;
        left: 0;
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #ffc107, #fd7e14);
        border-radius: 10px;
    }

    /* تحسينات النموذج */
    .form-control, .form-select {
        border: 1px solid #dee2e6;
        border-radius: 6px;
        padding: 0.5rem 0.75rem;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #ffc107;
        box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.15);
        outline: none;
    }

    .form-label {
        font-size: 0.95rem;
        color: #495057;
        margin-bottom: 0.35rem;
        font-weight: 500;
    }

    /* تحسين رسائل الخطأ */
    .alert {
        border-radius: 6px;
        border: none;
        font-size: 0.9rem;
        margin-bottom: 0;
    }

    .alert-danger {
        background-color: #f8d7da;
        color: #842029;
    }

    /* تحسين الأزرار */
    .btn {
        border-radius: 6px;
        padding: 0.5rem 1.5rem;
        font-size: 0.95rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #000;
    }

    .btn-warning:hover {
        background-color: #fd7e14;
        border-color: #fd7e14;
        color: white;
        transform: translateY(-1px);
    }

    .btn-light {
        background-color: #f8f9fa;
        border-color: #f8f9fa;
    }

    .btn-light:hover {
        background-color: #e2e6ea;
        border-color: #dae0e5;
    }

    .btn-outline-secondary {
        border-color: #dee2e6;
        color: #6c757d;
    }

    .btn-outline-secondary:hover {
        background-color: #6c757d;
        border-color: #6c757d;
        color: white;
    }

    /* تحسين البطاقة */
    .card {
        border-radius: 10px;
    }

    /* دعم RTL للغة العربية */
    [dir="rtl"] .me-1 {
        margin-left: 0.25rem !important;
        margin-right: 0 !important;
    }

    [dir="rtl"] .fa-arrow-left {
        transform: rotate(180deg);
    }

    [dir="rtl"] .justify-content-end {
        justify-content: flex-start !important;
    }

    [dir="rtl"] h2.fw-bold::after {
        left: auto;
        right: 0;
    }

    /* تحسينات للشاشات الصغيرة */
    @media (max-width: 768px) {
        .d-flex.justify-content-between {
            flex-direction: column;
            align-items: flex-start !important;
            gap: 1rem;
        }

        .btn {
            width: 100%;
        }

        .d-flex.gap-2.justify-content-end {
            flex-direction: column;
        }

        h2.fw-bold {
            font-size: 1.6rem !important;
        }
    }
</style>
@endsection
