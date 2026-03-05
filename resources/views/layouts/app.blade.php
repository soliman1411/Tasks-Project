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

        <!-- حاوية القوائم المنسدلة -->
        <div class="dropdowns-container" id="dropdownsContainer">
            @auth
                 <!-- القائمة المنسدلة للمستخدم (الملف الشخصي + تسجيل الخروج) -->
            <div class="dropdown d-inline-block ms-2">
                <button class="btn user-menu-btn-auth dropdown-toggle"
                        type="button"
                        id="userMenuDropdown"
                        data-bs-toggle="dropdown"
                        aria-expanded="false">
                    <i class="fas fa-user-circle"></i>
                    <span class="d-none d-md-inline-block ms-1">{{ Auth::user()->name ?? 'User' }}</span>
                </button>
                <ul class="dropdown-menu user-dropdown-menu-auth" aria-labelledby="userMenuDropdown">
                    <li>
                        <a class="dropdown-item user-menu-item-auth" href="{{ route('profile.edit') }}">
                            <i class="fas fa-user me-2"></i>
                            {{ __('messages.Profile') }}
                        </a>
                    </li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}" id="logout-form">
                            @csrf
                            <button type="submit" class="dropdown-item user-menu-item-auth text-danger">
                                <i class="fas fa-sign-out-alt me-2"></i>
                                {{ __('messages.logout') }}
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
            @endauth
            <!-- زر اللغة -->
            <div class="dropdown d-inline-block">
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

        <!-- اسم التطبيق -->
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
        const dropdownsContainer = document.getElementById('dropdownsContainer');
        const navbarBrand = document.getElementById('navbarBrand');

        if (isRTL) {
            // في اللغة العربية:
            // - الشعار في اليمين
            // - مجموعة القوائم (اللغة + المستخدم) في اليسار
            dropdownsContainer.style.cssText = 'position: absolute; left: 15px; top: 50%; transform: translateY(-50%); display: flex; align-items: center; flex-direction: row;';
            navbarBrand.style.cssText = 'position: absolute; right: 15px; top: 50%; transform: translateY(-50%);';

            // ترتيب القوائم في العربية: المستخدم ثم اللغة (من اليمين لليسار)
            dropdownsContainer.style.flexDirection = 'row-reverse';

            // تعديل المسافات بين القوائم في العربية
            document.querySelectorAll('.dropdowns-container .dropdown').forEach((dropdown, index) => {
                if (index === 0) {
                    dropdown.style.marginLeft = '0';
                    dropdown.style.marginRight = '5px';
                } else {
                    dropdown.style.marginRight = '0';
                    dropdown.style.marginLeft = '0';
                }
            });

            // تعديل اتجاه القوائم المنسدلة في RTL
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.style.cssText = 'text-align: right;';
            });

            // تعديل أيقونات القوائم في RTL
            document.querySelectorAll('.user-menu-item-auth i, .language-item-auth i').forEach(icon => {
                if (icon.classList.contains('me-2')) {
                    icon.classList.remove('me-2');
                    icon.classList.add('ms-2');
                }
            });
        } else {
            // في اللغة الإنجليزية:
            // - الشعار في اليسار
            // - مجموعة القوائم (اللغة + المستخدم) في اليمين
            dropdownsContainer.style.cssText = 'position: absolute; right: 15px; top: 50%; transform: translateY(-50%); display: flex; align-items: center; flex-direction: row;';
            navbarBrand.style.cssText = 'position: absolute; left: 15px; top: 50%; transform: translateY(-50%);';

            // ترتيب القوائم في الإنجليزية: اللغة ثم المستخدم (من اليسار لليمين)
            dropdownsContainer.style.flexDirection = 'row';

            // تعديل المسافات بين القوائم في الإنجليزية
            document.querySelectorAll('.dropdowns-container .dropdown').forEach((dropdown, index) => {
                if (index === 0) {
                    dropdown.style.marginRight = '5px';
                    dropdown.style.marginLeft = '0';
                } else {
                    dropdown.style.marginLeft = '0';
                    dropdown.style.marginRight = '0';
                }
            });

            // تعديل اتجاه القوائم المنسدلة في LTR
            document.querySelectorAll('.dropdown-menu').forEach(menu => {
                menu.style.cssText = 'text-align: left;';
            });

            // تعديل أيقونات القوائم في LTR
            document.querySelectorAll('.user-menu-item-auth i, .language-item-auth i').forEach(icon => {
                if (icon.classList.contains('ms-2')) {
                    icon.classList.remove('ms-2');
                    icon.classList.add('me-2');
                }
            });
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

    // تأثيرات الحركة للأزرار
    document.querySelectorAll('.submit-btn-auth, .nav-btn-auth, .language-btn-auth, .user-menu-btn-auth').forEach(btn => {
        btn.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.02)';
        });

        btn.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
        });
    });

    // تأثير للعناصر المنسدلة
    document.querySelectorAll('.language-item-auth, .user-menu-item-auth').forEach(item => {
        item.addEventListener('mouseenter', function() {
            this.style.transform = 'translateX(3px)';
        });

        item.addEventListener('mouseleave', function() {
            this.style.transform = 'translateX(0)';
        });
    });

    // إضافة علامة ✓ للغة الحالية
    document.querySelectorAll('.language-item-auth.active').forEach(item => {
        const checkIcon = document.createElement('i');
        checkIcon.className = 'fas fa-check ms-auto';
        checkIcon.style.fontSize = '12px';
        item.appendChild(checkIcon);
    });

    // التأكد من أن الصفحة متجاوبة
    window.addEventListener('orientationchange', adjustNavbarPositions);
</script>


</body>
</html>
