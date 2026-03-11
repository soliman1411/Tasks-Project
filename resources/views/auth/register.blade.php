@extends('layouts.app')

@section('title', '📝 ' . __('messages.register') . ' - TaskApp')

@section('content')
<div class="auth-card-main">
    <div class="auth-header-main bg-primary-gradient">
        <h1 class="auth-title-main">
            <i class="fas fa-user-plus"></i>
            {{ __('messages.register') }}
        </h1>
        <p class="auth-subtitle-main">{{ __('messages.Join us and start organizing your tasks with ease') }}</p>
    </div>

    <div class="auth-body-main">
        <form action="{{ route('register') }}" method="POST" id="registerForm">
            @csrf

            <div class="form-group-auth">
                <label for="name" class="form-label-auth">
                    <i class="fas fa-user"></i>{{ __('messages.fullName') }}
                </label>
                <input type="text" name="name" id="name"
                       class="form-control-auth @error('name') is-invalid @enderror"
                       value="{{ old('name') }}"
                       autocomplete="name"
                       autofocus>
                @error('name')
                    <div class="error-message-auth">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group-auth">
                <label for="email" class="form-label-auth">
                    <i class="fas fa-envelope"></i>{{ __('messages.email') }}
                </label>
                <input type="email" name="email" id="email"
                       class="form-control-auth @error('email') is-invalid @enderror"
                       value="{{ old('email') }}"
                       autocomplete="email">
                @error('email')
                    <div class="error-message-auth">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group-auth">
                <label for="phone" class="form-label-auth">
                    <i class="fas fa-phone"></i>{{ __('messages.phone') }}
                </label>
                <input type="tel" name="phone" id="phone"
                       class="form-control-auth @error('phone') is-invalid @enderror"
                       value="{{ old('phone') }}"
                       autocomplete="tel"
                       >
                @error('phone')
                    <div class="error-message-auth">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group-auth">
                <label for="birthdate" class="form-label-auth">
                    <i class="fas fa-calendar-alt"></i>{{ __('messages.birthdate') }}
                </label>
                <input type="date" name="birthdate" id="birthdate"
                       class="form-control-auth @error('birthdate') is-invalid @enderror"
                       value="{{ old('birthdate') }}"
                       max="{{ date('Y-m-d') }}">
                @error('birthdate')
                    <div class="error-message-auth">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group-auth">
                <label for="password" class="form-label-auth">
                    <i class="fas fa-lock"></i> {{ __('messages.password') }}
                </label>
                <input type="password" name="password" id="password"
                       class="form-control-auth @error('password') is-invalid @enderror"
                       autocomplete="new-password">
                @error('password')
                    <div class="error-message-auth">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group-auth">
                <label for="password_confirmation" class="form-label-auth">
                    <i class="fas fa-lock"></i>{{ __('messages.passwordConfirmation') }}
                </label>
                <input type="password" name="password_confirmation" id="password_confirmation"
                       class="form-control-auth"
                       autocomplete="new-password">
            </div>

            <div class="form-check-auth">
                <input type="checkbox" class="form-check-input-auth" id="terms" name="terms" required>
                <label class="form-check-label-auth" for="terms">
                    {{ __('messages.I agree to the terms and conditions') }}
                </label>
            </div>

            <button type="submit" class="submit-btn-auth bg-primary-gradient">
                <i class="fas fa-user-plus"></i> {{ __('messages.register') }}
            </button>

            <div class="auth-links">
                <p>
                    {{ __('messages.Do you already have an account?') }}
                    <a href="{{ route('login.form') }}">{{ __('messages.login') }}</a>
                </p>
            </div>
        </form>
    </div>
</div>

<script>
    // التحقق من صحة النموذج
    document.getElementById('registerForm')?.addEventListener('submit', function(e) {
        const terms = document.getElementById('terms');
        if (!terms.checked) {
            e.preventDefault();
            alert('يرجى الموافقة على الشروط والأحكام');
            return false;
        }

        // التحقق من صحة رقم الهاتف (اختياري)
        const phone = document.getElementById('phone');
        if (phone.value && !/^05\d{8}$/.test(phone.value.replace(/\s+/g, ''))) {
            e.preventDefault();
            alert('يرجى إدخال رقم هاتف سعودي صحيح (05xxxxxxxx)');
            return false;
        }
    });
</script>
@endsection
