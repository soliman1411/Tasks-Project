<!DOCTYPE html>
<html lang="{{ App::getLocale() }}" dir="{{ App::getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <title>@yield('title', 'TaskApp')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
        <link rel="stylesheet" href="{{ asset('css/layouts/app.css') }}">

   
</head>
<body>

<!-- النافبار -->
<nav class="navbar navbar-expand-lg navbar-auth">
    <div class="container position-relative">
        <!-- زر اللغة - يتم ضبط موقعه ديناميكياً -->
        <div class="language-dropdown-auth" id="languageDropdownContainer">
            <div class="dropdown">
                <button class="btn language-btn-auth dropdown-toggle"
                        type="button"
                        id="languageDropdown"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                    <i class="fas fa-globe"></i>
                    {{ strtoupper(app()->getLocale()) }}
                </button>
                <ul class="dropdown-menu language-dropdown-menu-auth" aria-labelledby="languageDropdown">
                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                        <li>
                            <a class="language-item-auth {{ app()->getLocale() == $localeCode ? 'active' : '' }}"
                               href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                @if($localeCode == 'ar')
                                    <i class="fas fa-flag"></i>
                                @elseif($localeCode == 'en')
                                    <i class="fas fa-flag-usa"></i>
                                @else
                                    <i class="fas fa-globe"></i>
                                @endif
                                {{ $properties['native'] }}
                            </a>
                        </li>
                    @endforeach
                </ul>
            </div>
        </div>

        <!-- اسم التطبيق - يتم ضبط موقعه ديناميكياً -->
        <a class="navbar-brand-auth" href="{{ route('tasks.index') }}" id="navbarBrand">
            <i class="fas fa-tasks"></i>
            {{ __('messages.TaskApp')}}
        </a>
    </div>
</nav>

<!-- المحتوى الرئيسي -->
<main class="auth-container">
    @yield('content')
</main>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // منع التمرير في الصفحة
    document.body.style.overflow = 'hidden';

    // ضبط مواقع العناصر
    function adjustNavbarPositions() {
        const isRTL = document.documentElement.dir === 'rtl';
        const languageContainer = document.getElementById('languageDropdownContainer');
        const navbarBrand = document.getElementById('navbarBrand');

        // تطبيق أنماط CSS مباشرة
        if (isRTL) {
            // في اللغة العربية: الشعار يمين، الزر يسار
            languageContainer.style.cssText = 'position: absolute; left: 15px; top: 50%; transform: translateY(-50%);';
            navbarBrand.style.cssText = 'position: absolute; right: 15px; top: 50%; transform: translateY(-50%);';
        } else {
            // في اللغة الإنجليزية: الشعار يسار، الزر يمين
            languageContainer.style.cssText = 'position: absolute; right: 15px; top: 50%; transform: translateY(-50%);';
            navbarBrand.style.cssText = 'position: absolute; left: 15px; top: 50%; transform: translateY(-50%);';
        }
    }

    // تشغيل الدالة عند تحميل الصفحة
    document.addEventListener('DOMContentLoaded', adjustNavbarPositions);

    // تشغيل الدالة عند تغيير حجم النافذة
    window.addEventListener('resize', adjustNavbarPositions);

    // تحسين تجربة الإدخال
    document.querySelectorAll('.form-control-auth').forEach(input => {
        input.addEventListener('focus', function() {
            this.style.borderColor = '#0d6efd';
            this.style.boxShadow = '0 0 0 3px rgba(13, 110, 253, 0.2)';
        });

        input.addEventListener('blur', function() {
            this.style.borderColor = '#e0e0e0';
            this.style.boxShadow = 'none';
        });
    });

    // إزالة تأثيرات الحركة من الأزرار
    document.querySelectorAll('.submit-btn-auth, .nav-btn-auth, .language-btn-auth').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.02)';
        });

        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // تأثير للغة المختارة
    document.querySelectorAll('.language-item-auth').forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(5px)';
        });

        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });

    // إضافة علامة ✓ للغة الحالية
    document.querySelectorAll('.language-item-auth.active').forEach(item => {
        const checkIcon = document.createElement('i');
        checkIcon.className = 'fas fa-check ms-auto';
        item.appendChild(checkIcon);
    });

    // التأكد من أن الصفحة متجاوبة
    window.addEventListener('orientationchange', adjustNavbarPositions);
</script>
</body>
</html>
