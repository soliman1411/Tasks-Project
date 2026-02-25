@extends('layouts.app')

@section('content')
<div class="container py-5">
    {{-- Header with animation --}}
    <div class="d-flex justify-content-between align-items-center mb-5">
        <div class="d-flex align-items-center gap-3">
            <div class="icon-wrapper bg-warning">
                <i class="fas fa-edit text-warning fa-lg"></i>
            </div>
            <div>
                <h2 class="fw-bold mb-0 page-title" style="color: #ffc107;">
                    {{ __('messages.taskUpdating') }}
                </h2>
                <p class="text-muted mt-1 mb-0">قم بتعديل بيانات المهمة</p>
            </div>
        </div>

        {{-- Back Button --}}
        <a href="{{ route('tasks.index') }}" class="btn-back">
            <i class="fas fa-arrow-left me-2"></i>
            رجوع
        </a>
    </div>

    {{-- Update Task Form --}}
    <div class="row">
        <div class="col-md-8 col-lg-6 mx-auto">
            <div class="card border-0 shadow-lg rounded-4 form-card">
                <div class="card-body p-5">
                    <form action="{{ route('tasks.update', $task->id) }}" method="POST" class="update-form">
                        @csrf
                        @method('PUT')

                        {{-- Task Title --}}
                        <div class="form-group mb-4">
                            <label class="form-label">
                                <i class="fas fa-heading me-2 text-warning"></i>
                                {{ __('messages.taskTitle') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-wrapper">
                                <input type="text"
                                       name="title"
                                       class="form-control modern-input @error('title') is-invalid @enderror"
                                       value="{{ old('title', $task->title) }}"
                                       placeholder="أدخل عنوان المهمة"
                                       autofocus>
                                <div class="input-highlight"></div>
                            </div>
                            @error('title')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Task Description --}}
                        <div class="form-group mb-4">
                            <label class="form-label">
                                <i class="fas fa-align-left me-2 text-warning"></i>
                                {{ __('messages.taskDescription') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="input-wrapper">
                                <textarea name="description"
                                          class="form-control modern-input @error('description') is-invalid @enderror"
                                          rows="5"
                                          placeholder="أدخل وصف المهمة">{{ old('description', $task->description) }}</textarea>
                                <div class="input-highlight"></div>
                            </div>
                            @error('description')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Task Status --}}
                        <div class="form-group mb-5">
                            <label class="form-label">
                                <i class="fas fa-check-circle me-2 text-warning"></i>
                                {{ __('messages.taskStatus') }}
                                <span class="text-danger">*</span>
                            </label>
                            <div class="status-selector">
                                <select name="is_done" class="modern-select @error('is_done') is-invalid @enderror">
                                    <option value="incomplete" {{ old('is_done', $task->is_done) == 'incomplete' ? 'selected' : '' }} data-icon="clock">
                                        <i class="fas fa-clock"></i>
                                        {{ __('messages.inComplete') }}
                                    </option>
                                    <option value="complete" {{ old('is_done', $task->is_done) == 'complete' ? 'selected' : '' }} data-icon="check-circle">
                                        <i class="fas fa-check-circle"></i>
                                        {{ __('messages.complete') }}
                                    </option>
                                </select>
                                <div class="select-decoration"></div>
                            </div>
                            @error('is_done')
                                <div class="error-message">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Form Actions --}}
                        <div class="d-flex gap-3 justify-content-end">
                            <a href="{{ route('tasks.index') }}" class="btn-cancel">
                                <i class="fas fa-times me-2"></i>
                                {{ __('messages.cancel') ?? 'إلغاء' }}
                            </a>
                            <button type="submit" class="btn-submit">
                                <i class="fas fa-save me-2"></i>
                                {{ __('messages.update') }}
                                <div class="btn-glow"></div>
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* ===== أنيميشنات ===== */
    @keyframes slideIn {
        from {
            opacity: 0;
            transform: translateY(30px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    @keyframes gradientShift {
        0% { background-position: 0% 50%; }
        50% { background-position: 100% 50%; }
        100% { background-position: 0% 50%; }
    }

    @keyframes glowPulse {
        0% { box-shadow: 0 0 5px rgba(255, 193, 7, 0.3); }
        50% { box-shadow: 0 0 25px rgba(255, 193, 7, 0.7); }
        100% { box-shadow: 0 0 5px rgba(255, 193, 7, 0.3); }
    }

    .container {
        animation: slideIn 0.6s ease-out;
        max-width: 1140px;
    }

    /* ===== تحسينات العنوان ===== */
    .icon-wrapper {
        width: 60px;
        height: 60px;
        background: rgba(255, 193, 7, 0.1);
        border-radius: 18px;
        display: flex;
        align-items: center;
        justify-content: center;
        position: relative;
        overflow: hidden;
        transition: all 0.3s ease;
    }
    .icon-wrapper::before {
        content: '';
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: linear-gradient(45deg, transparent, rgba(255, 193, 7, 0.2), transparent);
        transform: rotate(45deg);
        animation: shimmer 3s infinite;
    }
    @keyframes shimmer {
        0% { transform: translateX(-100%) rotate(45deg); }
        100% { transform: translateX(100%) rotate(45deg); }
    }
    .icon-wrapper:hover {
        transform: rotate(10deg) scale(1.1);
    }
    .icon-wrapper i {
        font-size: 1.8rem;
        position: relative;
        z-index: 1;
    }

    .page-title {
        font-size: 2.2rem;
        background: linear-gradient(45deg, #ffc107, #fd7e14);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-size: 200% 200%;
        animation: gradientShift 5s ease infinite;
    }

    .btn-back {
        padding: 12px 25px;
        background: white;
        border: 2px solid #ffc107;
        border-radius: 15px;
        color: #ffc107;
        text-decoration: none;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        display: inline-flex;
        align-items: center;
    }
    .btn-back:hover {
        background: #ffc107;
        color: white;
        transform: translateX(-5px);
        box-shadow: 0 10px 25px rgba(255, 193, 7, 0.4);
    }

    /* ===== بطاقة النموذج ===== */
    .form-card {
        background: linear-gradient(145deg, #ffffff, #f8f9fa);
        border: 1px solid rgba(255, 193, 7, 0.2);
        box-shadow: 0 25px 45px -15px rgba(0,0,0,0.2);
        transition: all 0.3s ease;
        animation: slideIn 0.8s ease-out;
    }
    .form-card:hover {
        box-shadow: 0 30px 55px -15px rgba(255, 193, 7, 0.3);
        transform: translateY(-5px);
    }

    /* ===== تنسيقات النموذج ===== */
    .form-label {
        font-size: 1rem;
        font-weight: 600;
        color: #2c3e50;
        margin-bottom: 10px;
        display: flex;
        align-items: center;
    }

    .input-wrapper {
        position: relative;
    }

    .modern-input {
        border: 2px solid #e9ecef;
        border-radius: 16px;
        padding: 14px 18px;
        font-size: 1rem;
        transition: all 0.3s ease;
        background: white;
        width: 100%;
    }
    .modern-input:focus {
        border-color: #ffc107;
        box-shadow: none;
        outline: none;
        transform: translateY(-2px);
    }

    .input-highlight {
        position: absolute;
        bottom: 0;
        left: 50%;
        width: 0;
        height: 3px;
        background: linear-gradient(90deg, #ffc107, #fd7e14);
        transition: all 0.3s ease;
        transform: translateX(-50%);
        border-radius: 3px;
    }
    .modern-input:focus ~ .input-highlight {
        width: 100%;
    }

    /* ===== محدد الحالة ===== */
    .status-selector {
        position: relative;
    }

    .modern-select {
        width: 100%;
        padding: 14px 18px;
        border: 2px solid #e9ecef;
        border-radius: 16px;
        font-size: 1rem;
        background: white;
        cursor: pointer;
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='24' height='24' viewBox='0 0 24 24' fill='none' stroke='%23ffc107' stroke-width='2' stroke-linecap='round' stroke-linejoin='round'%3E%3Cpolyline points='6 9 12 15 18 9'%3E%3C/polyline%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position: left 18px center;
        background-size: 20px;
        transition: all 0.3s ease;
    }
    .modern-select:focus {
        border-color: #ffc107;
        box-shadow: 0 0 0 4px rgba(255, 193, 7, 0.1);
        outline: none;
        transform: translateY(-2px);
    }
    .modern-select option {
        padding: 12px;
    }
    .modern-select option[value="complete"] {
        background: #d4edda;
        color: #155724;
    }
    .modern-select option[value="incomplete"] {
        background: #fff3cd;
        color: #856404;
    }

    /* ===== أزرار الإجراءات ===== */
    .btn-cancel {
        padding: 14px 30px;
        background: #f8f9fa;
        border: 2px solid #dee2e6;
        border-radius: 16px;
        color: #6c757d;
        font-weight: 600;
        text-decoration: none;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        display: inline-flex;
        align-items: center;
    }
    .btn-cancel:hover {
        background: #e9ecef;
        border-color: #adb5bd;
        color: #495057;
        transform: translateY(-3px);
        box-shadow: 0 10px 25px rgba(0,0,0,0.1);
    }

    .btn-submit {
        position: relative;
        padding: 14px 35px;
        background: linear-gradient(45deg, #ffc107, #fd7e14);
        border: none;
        border-radius: 16px;
        color: white;
        font-weight: 600;
        transition: all 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
        display: inline-flex;
        align-items: center;
        cursor: pointer;
        overflow: hidden;
    }
    .btn-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 15px 35px rgba(255, 193, 7, 0.4);
    }
    .btn-glow {
        position: absolute;
        top: -50%;
        left: -50%;
        width: 200%;
        height: 200%;
        background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
        opacity
