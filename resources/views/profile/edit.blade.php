@extends('layouts.app') {{-- أو admin -- حسب نوع المستخدم --}}

@section('content')
<div class="container-fluid px-4 py-4">

    {{-- Header بسيط --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0" style="color: #ffc107;">
            <i class="fas fa-user-circle me-2"></i>
            {{ __('messages.profile') ?? 'الملف الشخصي' }}
        </h2>
        <span class="badge bg-warning text-dark px-3 py-2">
            <i class="fas fa-user me-1"></i>
            {{ auth()->user()->role == 'admin' ? 'أدمن' : 'مستخدم عادي' }}
        </span>
    </div>

    {{-- رسائل النجاح --}}
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <i class="fas fa-check-circle me-2"></i>
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- Profile Form --}}
    <div class="row">
        <div class="col-md-8 col-lg-6 mx-auto">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">

                    {{-- صورة الملف الشخصي --}}
                    <div class="text-center mb-4">
                        <div class="position-relative d-inline-block">
                            @if(auth()->user()->profile_photo)
                                <img src="{{ asset('storage/' . auth()->user()->profile_photo) }}"
                                     alt="Profile Photo"
                                     class="rounded-circle img-thumbnail"
                                     style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #ffc107;">
                            @else
                                <div class="rounded-circle bg-warning bg-opacity-25 d-flex align-items-center justify-content-center mx-auto"
                                     style="width: 120px; height: 120px; border: 3px solid #ffc107;">
                                    <i class="fas fa-user fa-3x" style="color: #ffc107;"></i>
                                </div>
                            @endif
                            <label for="profile_photo_input" class="position-absolute bottom-0 end-0 mb-0 me-0"
                                   style="cursor: pointer; background: #ffc107; width: 35px; height: 35px; border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                                <i class="fas fa-camera text-white"></i>
                            </label>
                        </div>
                    </div>

                    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        {{-- حقل رفع الصورة المخفي --}}
                        <input type="file" id="profile_photo_input" name="profile_photo" accept="image/*" class="d-none" onchange="previewImage(this)">

                        {{-- User Name --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium">
                                <i class="fas fa-user text-warning me-1"></i>
                                {{ __('messages.userName') ?? 'الاسم' }} <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', auth()->user()->name) }}"
                                   placeholder="أدخل الاسم الكامل"
                                   required>
                            @error('name')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- User Email --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium">
                                <i class="fas fa-envelope text-warning me-1"></i>
                                {{ __('messages.email') ?? 'البريد الإلكتروني' }} <span class="text-danger">*</span>
                            </label>
                            <input type="email"
                                   name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', auth()->user()->email) }}"
                                   placeholder="example@email.com"
                                   required>
                            @error('email')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Phone Number --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium">
                                <i class="fas fa-phone text-warning me-1"></i>
                                {{ __('messages.phone') ?? 'رقم الهاتف' }}
                            </label>
                            <input type="tel"
                                   name="phone"
                                   class="form-control @error('phone') is-invalid @enderror"
                                   value="{{ old('phone', auth()->user()->phone ?? '') }}"
                                   placeholder="05xxxxxxxx"
                                   dir="ltr">
                            @error('phone')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Birth Date --}}
                        <div class="mb-4">
                            <label class="form-label fw-medium">
                                <i class="fas fa-calendar-alt text-warning me-1"></i>
                                {{ __('messages.birth_date') ?? 'تاريخ الميلاد' }}
                            </label>
                            <input type="date"
                                   name="birth_date"
                                   class="form-control @error('birth_date') is-invalid @enderror"
                                   value="{{ old('birth_date', auth()->user()->birth_date ?? '') }}">
                            @error('birth_date')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Divider for Password Section --}}
                        <hr class="my-4" style="border-top: 2px dashed #ffc107;">

                        <h5 class="mb-3" style="color: #ffc107;">
                            <i class="fas fa-lock me-2"></i>
                            {{ __('messages.change_password') ?? 'تغيير كلمة المرور' }}
                        </h5>

                        {{-- Current Password --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium">
                                <i class="fas fa-key text-warning me-1"></i>
                                {{ __('messages.current_password') ?? 'كلمة المرور الحالية' }}
                            </label>
                            <input type="password"
                                   name="current_password"
                                   class="form-control @error('current_password') is-invalid @enderror"
                                   placeholder="أدخل كلمة المرور الحالية">
                            @error('current_password')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                            <small class="text-muted">
                                <i class="fas fa-info-circle me-1"></i>
                                اترك هذا الحقل فارغاً إذا لم ترد تغيير كلمة المرور
                            </small>
                        </div>

                        {{-- New Password --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium">
                                <i class="fas fa-lock text-warning me-1"></i>
                                {{ __('messages.new_password') ?? 'كلمة المرور الجديدة' }}
                            </label>
                            <input type="password"
                                   name="new_password"
                                   class="form-control @error('new_password') is-invalid @enderror"
                                   placeholder="أدخل كلمة المرور الجديدة">
                            @error('new_password')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Confirm New Password --}}
                        <div class="mb-4">
                            <label class="form-label fw-medium">
                                <i class="fas fa-check-circle text-warning me-1"></i>
                                {{ __('messages.confirm_password') ?? 'تأكيد كلمة المرور الجديدة' }}
                            </label>
                            <input type="password"
                                   name="new_password_confirmation"
                                   class="form-control"
                                   placeholder="أعد إدخال كلمة المرور الجديدة">
                        </div>

                        {{-- Form Actions --}}
                        <div class="d-flex gap-2 justify-content-end mt-4">
                            <a href="{{ url()->previous() }}" class="btn btn-light px-4">
                                <i class="fas fa-times me-1"></i>
                                {{ __('messages.cancel') ?? 'إلغاء' }}
                            </a>
                            <button type="submit" class="btn btn-warning px-4">
                                <i class="fas fa-save me-1"></i>
                                {{ __('messages.update') ?? 'تحديث البيانات' }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>

            {{-- معلومات إضافية --}}
            <div class="card border-0 shadow-sm rounded-3 mt-3">
                <div class="card-body p-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="fas fa-clock text-warning me-1"></i>
                            <small class="text-muted">
                                {{ __('messages.member_since') ?? 'عضو منذ' }}: {{ auth()->user()->created_at->format('Y/m/d') }}
                            </small>
                        </div>
                        
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@push('scripts')
<script>
// معاينة الصورة قبل الرفع
function previewImage(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = function(e) {
            // تحديث الصورة المعروضة
            const profileImg = document.querySelector('img.rounded-circle');
            const defaultIcon = document.querySelector('.rounded-circle.bg-warning');

            if (profileImg) {
                profileImg.src = e.target.result;
            } else if (defaultIcon) {
                // إذا كانت أيقونة افتراضية، استبدلها بالصورة
                defaultIcon.outerHTML = `<img src="${e.target.result}"
                                           alt="Profile Photo"
                                           class="rounded-circle img-thumbnail"
                                           style="width: 120px; height: 120px; object-fit: cover; border: 3px solid #ffc107;">`;
            }
        }
        reader.readAsDataURL(input.files[0]);
    }
}

// رسالة تأكيد قبل المغادرة إذا تم تغيير أي حقل
let formChanged = false;
document.querySelectorAll('input').forEach(input => {
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
</script>
@endpush

@push('styles')
<style>
    .form-control:focus {
        border-color: #ffc107;
        box-shadow: 0 0 0 0.2rem rgba(255, 193, 7, 0.25);
    }

    .btn-warning {
        background-color: #ffc107;
        border-color: #ffc107;
        color: #000;
    }

    .btn-warning:hover {
        background-color: #ffb300;
        border-color: #ffb300;
        color: #000;
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(255, 193, 7, 0.3);
    }

    .btn-light:hover {
        transform: translateY(-1px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }

    .card {
        transition: all 0.3s ease;
    }

    .card:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1) !important;
    }

    .badge.bg-warning {
        font-size: 0.9rem;
    }
</style>
@endpush
@endsection
