{{-- resources/views/profile/edit.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container-fluid px-4 py-4" style="max-height: 100vh; overflow-y: auto;">



    {{-- نموذج تعديل الملف الشخصي --}}
    <div class="row">
        <div class="col-lg-8 mx-auto">
            <div class="card border-0 shadow-lg rounded-4">
                <div class="card-body p-4 p-lg-5">

                    {{-- النموذج --}}
                    <form id="profileForm" action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- الاسم --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium">
                                <i class="fas fa-user text-warning me-1"></i>
                                 {{ __('messages.fullName') }} <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="name"
                                   class="form-control form-control-lg rounded-pill @error('name') is-invalid @enderror"
                                   value="{{ old('name', auth()->user()->name) }}"
                                   >
                            @error('name')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- البريد الإلكتروني --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium">
                                <i class="fas fa-envelope text-warning me-1"></i>
                                  {{ __('messages.email') }} <span class="text-danger">*</span>
                            </label>
                            <input type="email"
                                   name="email"
                                   class="form-control form-control-lg rounded-pill @error('email') is-invalid @enderror"
                                   value="{{ old('email', auth()->user()->email) }}"

                                   dir="ltr">
                            @error('email')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- صف الهاتف وتاريخ الميلاد --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-medium">
                                    <i class="fas fa-phone text-warning me-1"></i>
                                      {{ __('messages.phone') }}
                                </label>
                                <input type="tel"
                                       name="phone"
                                       class="form-control form-control-lg rounded-pill @error('phone') is-invalid @enderror"
                                       value="{{ old('phone', auth()->user()->phone ?? '') }}"

                                       dir="ltr">
                                @error('phone')
                                    <div class="text-danger small mt-1">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-medium">
                                    <i class="fas fa-calendar-alt text-warning me-1"></i>
                                     {{ __('messages.birthdate') }}
                                </label>
                                <input type="date"
                                       name="birth_date"
                                       class="form-control form-control-lg rounded-pill @error('birth_date') is-invalid @enderror"
                                       value="{{ old('birth_date', auth()->user()->birth_date ?? '') }}">
                                @error('birth_date')
                                    <div class="text-danger small mt-1">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>
                        </div>

                        {{-- خط فاصل --}}
                        <hr class="my-4" style="border-top: 2px dashed #ffc107; opacity: 0.5;">

                        {{-- قسم تغيير كلمة المرور --}}
                        <h5 class="mb-3" style="color: #ffc107;">
                            <i class="fas fa-lock me-2"></i>
                                  {{ __('messages.change password') }}
                        </h5>


                        {{-- كلمة المرور الحالية --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium">
                                <i class="fas fa-key text-warning me-1"></i>
                                {{ __('messages.password') }}
                            </label>
                            <input type="password"
                                   name="current_password"
                                   class="form-control form-control-lg rounded-pill @error('current_password') is-invalid @enderror"
                                    >
                            @error('current_password')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- كلمة المرور الجديدة وتأكيدها --}}
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-medium">
                                    <i class="fas fa-lock text-warning me-1"></i>
                                  {{ __('messages.new password') }}
                                </label>
                                <input type="password"
                                       name="new_password"
                                       class="form-control form-control-lg rounded-pill @error('new_password') is-invalid @enderror"
                                       >
                                @error('new_password')
                                    <div class="text-danger small mt-1">
                                        <i class="fas fa-exclamation-circle me-1"></i>
                                        {{ $message }}
                                    </div>
                                @enderror
                            </div>

                            <div class="col-md-6 mb-3">
                                <label class="form-label fw-medium">
                                    <i class="fas fa-check-circle text-warning me-1"></i>
                                       {{ __('messages.passwordConfirmation') }}
                                </label>
                                <input type="password"
                                       name="new_password_confirmation"
                                       class="form-control form-control-lg rounded-pill"
                                       >
                            </div>
                        </div>

                        {{-- أزرار الإجراءات --}}
                        <div class="d-flex gap-2 justify-content-end mt-4 pt-3 border-top">
                            <a href="{{ route(auth()->user()->role == 'admin' ? 'admin.dashboard' : 'tasks.index') }}"
                               class="btn btn-outline-secondary rounded-pill px-4 py-2">
                                <i class="fas fa-times me-1"></i>
                                {{ __('messages.cancel') }}
                            </a>
                            <button type="submit" class="btn btn-warning rounded-pill px-5 py-2">
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

@push('scripts')
<script>
// تحذير عند مغادرة الصفحة مع وجود تغييرات
let formChanged = false;
document.querySelectorAll('#profileForm input').forEach(input => {
    input.addEventListener('change', function() {
        formChanged = true;
    });
});

window.addEventListener('beforeunload', function(e) {
    if (formChanged) {
        e.preventDefault();
        e.returnValue = '';
    }
});

// تحسين ظهور السكرول
document.addEventListener('DOMContentLoaded', function() {
    document.body.style.overflow = 'auto';
    document.documentElement.style.overflow = 'auto';

    const container = document.querySelector('.container-fluid');
    if (container.scrollHeight > window.innerHeight) {
        container.style.overflowY = 'auto';
    }
});
</script>
@endpush

@push('styles')
<style>
    /* تحسين ظهور السكرول */
    .container-fluid {
        overflow-y: auto !important;
        scrollbar-width: thin;
        scrollbar-color: #ffc107 #f1f1f1;
    }

    .container-fluid::-webkit-scrollbar {
        width: 8px;
    }

    .container-fluid::-webkit-scrollbar-track {
        background: #f1f1f1;
        border-radius: 10px;
    }

    .container-fluid::-webkit-scrollbar-thumb {
        background: #ffc107;
        border-radius: 10px;
    }

    .container-fluid::-webkit-scrollbar-thumb:hover {
        background: #ffb300;
    }

    /* تحسينات النموذج */
    .form-control-lg {
        font-size: 1rem;
        padding: 0.75rem 1.25rem;
    }

    .form-control:focus {
        border-color: #ffc107;
        box-shadow: 0 0 0 0.25rem rgba(255, 193, 7, 0.25);
    }

    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #000;
        font-weight: 500;
    }

    .btn-warning:hover {
        background-color: #ffb300;
        border-color: #ffb300;
        color: #000;
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3);
    }

    .btn-outline-secondary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        transform: translateY(-2px);
    }


</style>
@endpush
@endsection
