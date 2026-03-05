@extends('layouts.app')

@section('title', 'تعديل الملف الشخصي')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <!-- بطاقة تعديل الملف الشخصي -->
            <div class="card shadow-lg border-0 rounded-4 mb-4" style="background: white; direction: rtl;">
                <div class="card-header bg-primary text-white rounded-4 px-4 py-3" style="background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);">
                    <h4 class="mb-0">
                        <i class="fas fa-user-edit ms-2"></i>
                        تعديل الملف الشخصي
                    </h4>
                </div>
                
                <div class="card-body p-4">
                    <!-- رسائل Flasher -->
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle ms-2"></i>
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if($errors->any())
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle ms-2"></i>
                            <strong>خطأ!</strong>
                            <ul class="mb-0 mt-2">
                                @foreach($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <!-- معلومات المستخدم -->
                    <div class="text-center mb-4">
                        <div class="avatar-circle mx-auto mb-3" style="width: 100px; height: 100px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border-radius: 50%; display: flex; align-items: center; justify-content: center;">
                            <i class="fas fa-user fa-3x text-white"></i>
                        </div>
                        <h5>{{ Auth::user()->name }}</h5>
                        <p class="text-muted">{{ Auth::user()->email }}</p>
                        @if(Auth::user()->email_verified_at)
                            <span class="badge bg-success">
                                <i class="fas fa-check-circle"></i> البريد الإلكتروني موثق
                            </span>
                        @else
                            <span class="badge bg-warning text-dark">
                                <i class="fas fa-exclamation-circle"></i> البريد الإلكتروني غير موثق
                            </span>
                        @endif
                    </div>

                    <hr class="my-4">

                    <!-- نموذج تعديل المعلومات الأساسية -->
                    <form action="{{ route('profile.update') }}" method="POST" class="mb-5">
                        @csrf
                        @method('PUT')
                        
                        <h5 class="text-primary mb-3">
                            <i class="fas fa-id-card ms-2"></i>
                            معلوماتك/البيانات
                        </h5>
                        
                        <!-- حقل الاسم -->
                        <div class="mb-3">
                            <label for="name" class="form-label">
                                <i class="fas fa-user text-primary ms-1"></i>
                                الاسم الكامل
                            </label>
                            <input type="text" 
                                   class="form-control @error('name') is-invalid @enderror" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name', Auth::user()->name) }}"
                                   placeholder="أدخل اسمك الكامل"
                                   style="border: 2px solid #e9ecef; border-radius: 10px; padding: 10px 15px;">
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- حقل البريد الإلكتروني -->
                        <div class="mb-3">
                            <label for="email" class="form-label">
                                <i class="fas fa-envelope text-primary ms-1"></i>
                                البريد الإلكتروني
                            </label>
                            <input type="email" 
                                   class="form-control @error('email') is-invalid @enderror" 
                                   id="email" 
                                   name="email" 
                                   value="{{ old('email', Auth::user()->email) }}"
                                   placeholder="أدخل بريدك الإلكتروني"
                                   style="border: 2px solid #e9ecef; border-radius: 10px; padding: 10px 15px;">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- زر الحفظ -->
                        <button type="submit" name="update_type" value="profile" class="btn btn-primary px-4" style="border-radius: 10px; padding: 10px 25px; background: linear-gradient(135deg, #667eea 0%, #764ba2 100%); border: none;">
                            <i class="fas fa-save ms-2"></i>
                            messages.save_changes
                        </button>
                    </form>
                    
                    <hr class="my-4">
                    
                    <!-- نموذج تغيير كلمة المرور -->
                    <form action="{{ route('profile.update') }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <h5 class="text-primary mb-3">
                            <i class="fas fa-shield-alt ms-2"></i>
                            messages.security_settings
                        </h5>
                        
                        <p class="text-muted small mb-3">
                            <i class="fas fa-info-circle"></i>
                            messages.manage_your_password
                        </p>
                        
                        <!-- كلمة المرور الحالية -->
                        <div class="mb-3">
                            <label for="current_password" class="form-label">
                                <i class="fas fa-key text-primary ms-1"></i>
                                messages.current_password
                            </label>
                            <input type="password" 
                                   class="form-control @error('current_password') is-invalid @enderror" 
                                   id="current_password" 
                                   name="current_password"
                                   placeholder="......"
                                   style="border: 2px solid #e9ecef; border-radius: 10px; padding: 10px 15px;">
                            @error('current_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- كلمة المرور الجديدة -->
                        <div class="mb-3">
                            <label for="new_password" class="form-label">
                                <i class="fas fa-lock text-primary ms-1"></i>
                                messages.new_password
                            </label>
                            <input type="password" 
                                   class="form-control @error('new_password') is-invalid @enderror" 
                                   id="new_password" 
                                   name="new_password"
                                   placeholder="......"
                                   style="border: 2px solid #e9ecef; border-radius: 10px; padding: 10px 15px;">
                            @error('new_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        
                        <!-- تأكيد كلمة المرور -->
                        <div class="mb-3">
                            <label for="new_password_confirmation" class="form-label">
                                <i class="fas fa-check-circle text-primary ms-1"></i>
                                messages.confirm_password
                            </label>
                            <input type="password" 
                                   class="form-control" 
                                   id="new_password_confirmation" 
                                   name="new_password_confirmation"
                                   placeholder="......"
                                   style="border: 2px solid #e9ecef; border-radius: 10px; padding: 10px 15px;">
                        </div>
                        
                        <!-- متطلبات كلمة المرور -->
                        <div class="bg-light p-3 rounded-3 mb-3" style="background: #f8f9fa; border-radius: 15px;">
                            <h6 class="mb-3">
                                <i class="fas fa-list-check ms-2"></i>
                                messages.password_requirements
                            </h6>
                            <ul class="list-unstyled mb-0">
                                <li class="mb-2">
                                    <i class="fas fa-circle text-primary ms-2" style="font-size: 8px;"></i>
                                    messages.min_8_characters
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-circle text-primary ms-2" style="font-size: 8px;"></i>
                                    messages.at_least_one_uppercase
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-circle text-primary ms-2" style="font-size: 8px;"></i>
                                    حرف صغير واحد على الأقل
                                </li>
                                <li class="mb-2">
                                    <i class="fas fa-circle text-primary ms-2" style="font-size: 8px;"></i>
                                    رقم واحد على الأقل
                                </li>
                            </ul>
                        </div>
                        
                        <!-- زر تحديث كلمة المرور -->
                        <button type="submit" name="update_type" value="password" class="btn btn-warning px-4" style="border-radius: 10px; padding: 10px 25px; background: linear-gradient(135deg, #f093fb 0%, #f5576c 100%); border: none; color: white;">
                            <i class="fas fa-sync-alt ms-2"></i>
                            تحديث كلمة المرور
                        </button>
                    </form>
                </div>
            </div>
            
            <!-- معلومات إضافية -->
            <div class="card shadow border-0 rounded-4" style="background: white;">
                <div class="card-body p-4">
                    <h6 class="text-primary mb-3">
                        <i class="fas fa-info-circle ms-2"></i>
                        معلومات الحساب
                    </h6>
                    <div class="row">
                        <div class="col-md-6">
                            <small class="text-muted d-block">عضو منذ</small>
                            <strong>{{ Auth::user()->created_at->format('Y/m/d') }}</strong>
                        </div>
                        <div class="col-md-6">
                            <small class="text-muted d-block">آخر تحديث</small>
                            <strong>{{ Auth::user()->updated_at->format('Y/m/d') }}</strong>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
body {
    background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
    min-height: 100vh;
}

.card {
    transition: all 0.3s ease;
    border: none !important;
}

.card:hover {
    transform: translateY(-5px);
    box-shadow: 0 15px 40px rgba(0,0,0,0.15) !important;
}

.form-control:focus {
    border-color: #667eea !important;
    box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.1) !important;
    outline: none;
}

.btn {
    transition: all 0.3s ease;
}

.btn:hover {
    transform: translateY(-2px);
    box-shadow: 0 5px 15px rgba(0,0,0,0.2);
}

/* RTL Specific */
[dir="rtl"] .ms-2 {
    margin-left: 0;
    margin-right: 0.5rem;
}

[dir="rtl"] .ms-1 {
    margin-left: 0;
    margin-right: 0.25rem;
}

/* Responsive */
@media (max-width: 768px) {
    .container {
        padding: 10px;
    }
    
    .card-body {
        padding: 20px !important;
    }
    
    .btn {
        width: 100%;
    }
}
</style>
@endsection