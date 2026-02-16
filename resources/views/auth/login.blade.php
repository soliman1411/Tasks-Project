@extends('layouts.app')

@section('title', '🔐 ' . __('messages.login') . ' - TaskApp')
@section('content')
<div class="auth-card-main">
    <div class="auth-header-main bg-success-gradient">
        <h1 class="auth-title-main">
            <i class="fas fa-sign-in-alt"></i>
            {{ __('messages.login') }}

        </h1>
        <p class="auth-subtitle-main"> {{ __('messages.Welcome back! Please log in to your account.') }}</p>
    </div>

    <div class="auth-body-main">
        @if(session('error'))
            <div class="alert alert-danger alert-auth">
                <i class="fas fa-exclamation-circle"></i>
                <div>
                    <strong>خطأ!</strong><br>
                    {{ session('error') }}
                </div>
            </div>
        @endif



        <form action="{{ route('login') }}" method="POST" id="loginForm">
            @csrf

            <div class="form-group-auth">
                <label for="email" class="form-label-auth">
            {{ __('messages.email')}}
                    <i class="fas fa-envelope"></i>
                </label>
                <input type="email" name="email" id="email"
                       class="form-control-auth @error('email') is-invalid @enderror"
                       value="{{ old('email') }}"
                       autocomplete="email"
                       autofocus>
                @error('email')
                    <div class="error-message-auth">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-group-auth">
                <label for="password" class="form-label-auth">
            {{ __('messages.password')}}
                    <i class="fas fa-lock"></i>
                </label>
                <input type="password" name="password" id="password"
                       class="form-control-auth @error('password') is-invalid @enderror"
                       autocomplete="current-password">
                @error('password')
                    <div class="error-message-auth">
                        <i class="fas fa-exclamation-circle"></i> {{ $message }}
                    </div>
                @enderror
            </div>

            <div class="form-check-auth">
                <input type="checkbox" class="form-check-input-auth" id="remember" name="remember">
                <label class="form-check-label-auth" for="remember">
            {{ __('messages.RememberMy')}}
                </label>
            </div>

            <button type="submit" class="submit-btn-auth bg-success-gradient">
                <i class="fas fa-sign-in-alt"></i>{{ __('messages.login') }}
            </button>

            <div class="auth-links">
                <p>
            {{ __('messages.Dont have an account?')}}
                    <a href="{{ route('register.form') }}">
            {{ __('messages.register')}}
                    </a>
                </p>
            </div>
        </form>
    </div>
</div>

<script>
    // تحسين تجربة المستخدم
    document.getElementById('loginForm')?.addEventListener('submit', function() {
        const btn = this.querySelector('.submit-btn-auth');
        btn.innerHTML = '<i class="fas fa-spinner fa-spin">{{ __('messages.login')}}</i>...';
        btn.disabled = true;
    });
</script>
@endsection
