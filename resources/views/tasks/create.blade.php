@extends('layouts.app')

@section('content')
<div class="container py-4">
   
    {{-- Create Task Form --}}
    <div class="row">
        <div class="col-md-8 col-lg-6 mx-auto">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <form action="{{ route('tasks.store') }}" method="POST">
                        @csrf

                        {{-- Task Title --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium">
                                {{ __('messages.taskTitle') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title') }}">
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
                                      rows="4">{{ old('description') }}</textarea>
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
                                <option value="incomplete" {{ old('is_done') == 'incomplete' ? 'selected' : '' }}>
                                    {{ __('messages.inComplete') }}
                                </option>
                                <option value="complete" {{ old('is_done') == 'complete' ? 'selected' : '' }}>
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
                            <button type="submit" class="btn btn-success px-4">
                                <i class="fas fa-save me-1"></i>
                                {{ __('messages.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </div>
</div>

<style>
    /* الحفاظ على بنية الصفحة الأساسية */
    .container {
        max-width: 1140px;
    }

    /* تحسينات بسيطة للنموذج */
    .form-control, .form-select {
        border: 1px solid #dee2e6;
        border-radius: 6px;
        padding: 0.5rem 0.75rem;
        font-size: 0.95rem;
        transition: all 0.2s ease;
    }

    .form-control:focus, .form-select:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
        outline: none;
    }

    .form-label {
        font-size: 0.95rem;
        color: #495057;
        margin-bottom: 0.35rem;
        font-weight: 500;
    }

    /* تحسين رسائل الخطأ - مع الحفاظ على شكل alert */
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

    .btn-success {
        background-color: #198754;
        border-color: #198754;
    }

    .btn-success:hover {
        background-color: #157347;
        border-color: #146c43;
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
    }
</style>
@endsection
