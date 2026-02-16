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

    <style>
        /* إعدادات أساسية للشاشة الكاملة */
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            height: 100%;
            width: 100%;
            overflow: hidden;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }

        body {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            display: flex;
            flex-direction: column;
        }

        /* تصميم النافبار */
        .navbar-auth {
            background: rgba(255, 255, 255, 0.1);
            backdrop-filter: blur(10px);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding: 15px 0;
            height: 70px;
            flex-shrink: 0;
        }

        .navbar-brand-auth {
            color: white !important;
            font-size: 1.8rem;
            font-weight: 700;
            display: flex;
            align-items: center;
            gap: 12px;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .navbar-brand-auth:hover {
            color: #f8f9fa !important;
            transform: scale(1.05);
        }

        /* زر التنقل في النافبار */
        .nav-btn-auth {
            background: rgba(255, 255, 255, 0.2);
            color: white;
            border: 2px solid rgba(255, 255, 255, 0.3);
            padding: 10px 30px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1.1rem;
            text-decoration: none;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s ease;
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .nav-btn-auth:hover {
            background: rgba(255, 255, 255, 0.3);
            color: white;
        }

        /* زر اللغة */
        .language-btn-auth {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            padding: 8px 20px;
            border-radius: 50px;
            font-weight: 600;
            font-size: 1rem;
            display: flex;
            align-items: center;
            gap: 8px;
            transition: all 0.3s ease;
        }

        .language-btn-auth:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
        }

        .language-dropdown-menu-auth {
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border-radius: 15px;
            overflow: hidden;
            margin-top: 10px !important;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            min-width: 150px;
        }

        .language-item-auth {
            padding: 10px 15px;
            font-weight: 500;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            text-decoration: none;
            color: #333;
        }

        .language-item-auth:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .language-item-auth.active {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
            color: white;
        }

        /* الحاوية الرئيسية */
        .auth-container {
            flex: 1;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 20px;
            overflow: hidden;
        }

        /* البطاقة الرئيسية */
        .auth-card-main {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            border-radius: 25px;
            box-shadow: 0 25px 50px rgba(0, 0, 0, 0.2);
            width: 100%;
            max-width: 500px;
            max-height: 90vh;
            display: flex;
            flex-direction: column;
            overflow: hidden;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .auth-header-main {
            padding: 30px;
            text-align: center;
            flex-shrink: 0;
        }

        .auth-title-main {
            font-size: 2.2rem;
            font-weight: 700;
            margin-bottom: 10px;
        }

        .auth-subtitle-main {
            font-size: 1.1rem;
            opacity: 0.8;
        }

        .auth-body-main {
            padding: 35px;
            flex: 1;
            overflow-y: auto;
            scrollbar-width: thin;
            scrollbar-color: #0d6efd #f1f1f1;
        }

        /* إخفاء scrollbar */
        .auth-body-main::-webkit-scrollbar {
            width: 6px;
        }

        .auth-body-main::-webkit-scrollbar-track {
            background: #f1f1f1;
            border-radius: 10px;
        }

        .auth-body-main::-webkit-scrollbar-thumb {
            background: #0d6efd;
            border-radius: 10px;
        }

        /* تصميم حقول الإدخال */
        .form-group-auth {
            margin-bottom: 20px;
        }

        .form-label-auth {
            font-weight: 600;
            color: #333;
            margin-bottom: 8px;
            display: flex;
            align-items: center;
            gap: 8px;
            font-size: 1rem;
        }

        .form-label-auth i {
            color: #0d6efd;
        }

        .form-control-auth {
            padding: 14px 16px;
            border: 2px solid #e0e0e0;
            border-radius: 12px;
            font-size: 1rem;
            transition: all 0.3s ease;
            background: #f8f9fa;
            width: 100%;
        }

        .form-control-auth:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
            background: white;
            outline: none;
        }

        .form-control-auth.is-invalid {
            border-color: #dc3545;
        }

        /* رسائل الخطأ */
        .error-message-auth {
            color: #dc3545;
            font-size: 0.9rem;
            margin-top: 5px;
            padding-right: 5px;
            display: flex;
            align-items: center;
            gap: 5px;
        }

        /* زر الإرسال */
        .submit-btn-auth {
            color: white;
            border: none;
            padding: 16px;
            border-radius: 12px;
            font-size: 1.1rem;
            font-weight: 600;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 10px;
            transition: all 0.3s ease;
            cursor: pointer;
            margin-top: 10px;
        }

        .submit-btn-auth:hover {
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
        }

        /* قسم الروابط */
        .auth-links {
            text-align: center;
            margin-top: 25px;
            padding-top: 20px;
            border-top: 1px solid #eee;
        }

        .auth-links a {
            color: #0d6efd;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
        }

        .auth-links a:hover {
            color: #0a58ca;
            text-decoration: underline;
        }

        /* تنبيهات */
        .alert-auth {
            border-radius: 12px;
            border: none;
            padding: 15px;
            margin-bottom: 20px;
            display: flex;
            align-items: center;
            gap: 12px;
            animation: slideIn 0.5s ease;
        }

        @keyframes slideIn {
            from {
                opacity: 0;
                transform: translateY(-10px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        /* تحسينات للشيك بوكس */
        .form-check-auth {
            display: flex;
            align-items: center;
            margin-top: 10px;
        }

        .form-check-input-auth {
            width: 18px;
            height: 18px;
            margin-left: 8px;
        }

        .form-check-label-auth {
            color: #555;
        }

        /* ألوان مخصصة */
        .bg-primary-gradient {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
            color: white;
        }

        .bg-success-gradient {
            background: linear-gradient(135deg, #20c997 0%, #198754 100%);
            color: white;
        }

        /* تحسينات للعرض */
        @media (max-height: 700px) {
            .auth-card-main {
                max-height: 85vh;
            }

            .auth-header-main {
                padding: 20px;
            }

            .auth-body-main {
                padding: 25px;
            }
        }

        @media (max-width: 768px) {
            .auth-card-main {
                border-radius: 20px;
                max-width: 95%;
            }

            .auth-header-main {
                padding: 25px 20px;
            }

            .auth-title-main {
                font-size: 1.8rem;
            }

            .auth-body-main {
                padding: 25px 20px;
            }

            .nav-btn-auth {
                padding: 8px 20px;
                font-size: 0.9rem;
                left: 60%;
            }

            .language-btn-auth {
                padding: 6px 15px;
                font-size: 0.9rem;
            }

            .navbar-brand-auth {
                font-size: 1.5rem;
            }
        }

        @media (max-width: 576px) {
            .nav-btn-auth {
                display: none;
            }
        }
    </style>
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