<!DOCTYPE html>
<html lang="{{ App::getLocale() }}"
      dir="{{ App::getLocale() == 'ar' ? 'rtl' : 'ltr' }}">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? __('messages.AdminPanel') }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Bootstrap Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* إعدادات أساسية */
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
            background-color: #f8fafc;
            display: flex;
            flex-direction: column;
        }

        /* تصميم النافبار - نفس تنسيق واجهات المصادقة */
        .navbar-auth {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-bottom: 1px solid rgba(255, 255, 255, 0.2);
            padding: 10px 0;
            height: 70px;
            flex-shrink: 0;
            position: relative;
            z-index: 1030;
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
            position: absolute;
            left: 50%;
            transform: translateX(-50%);
        }

        .navbar-brand-auth:hover {
            color: #f8f9fa !important;
            transform: translateX(-50%) scale(1.05);
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

        /* تحسين ظهور القائمة المنسدلة */
        .language-dropdown-auth {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        [dir="ltr"] .language-dropdown-auth {
            left: 15px;
        }

        [dir="rtl"] .language-dropdown-auth {
            right: 15px;
        }

        .language-dropdown-menu-auth {
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border-radius: 15px;
            overflow: hidden;
            margin-top: 10px !important;
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
            min-width: 180px;
            padding: 8px;
        }

        [dir="rtl"] .language-dropdown-menu-auth {
            left: auto !important;
            right: 0 !important;
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
            border-radius: 10px;
        }

        .language-item-auth:hover {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
        }

        .language-item-auth.active {
            background: linear-gradient(135deg, #0d6efd 0%, #0b5ed7 100%);
            color: white;
        }

        /* زر الاشعارات في النافبار */
        .notifications-wrapper {
            position: absolute;
            top: 50%;
            transform: translateY(-50%);
        }

        [dir="ltr"] .notifications-wrapper {
            right: 15px;
        }

        [dir="rtl"] .notifications-wrapper {
            left: 15px;
        }

        .notifications-btn {
            background: rgba(255, 255, 255, 0.2);
            border: 2px solid rgba(255, 255, 255, 0.3);
            color: white;
            width: 45px;
            height: 45px;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            transition: all 0.3s ease;
            position: relative;
            cursor: pointer;
        }

        .notifications-btn:hover {
            background: rgba(255, 255, 255, 0.3);
            border-color: rgba(255, 255, 255, 0.5);
            transform: scale(1.05);
        }

        .notifications-btn i {
            font-size: 1.3rem;
        }

        .notification-badge {
            position: absolute;
            top: -5px;
            right: -5px;
            background-color: #dc3545;
            color: white;
            border-radius: 50%;
            min-width: 20px;
            height: 20px;
            font-size: 0.7rem;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0 5px;
            border: 2px solid #fff;
            font-weight: bold;
        }

        [dir="rtl"] .notification-badge {
            right: auto;
            left: -5px;
        }

        /* تنسيق قائمة الاشعارات */
        .notifications-dropdown {
            max-height: 350px;
            overflow-y: auto;
            width: 320px;
            border: none;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
            border-radius: 15px;
            overflow: hidden;
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(10px);
            margin-top: 10px !important;
            padding: 0;
        }

        [dir="ltr"] .notifications-dropdown {
            left: auto !important;
            right: 0 !important;
        }

        [dir="rtl"] .notifications-dropdown {
            right: auto !important;
            left: 0 !important;
        }

        .notifications-dropdown .dropdown-header {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 12px 15px;
            font-weight: 600;
        }

        .notifications-dropdown .dropdown-item {
            padding: 12px 15px;
            border-bottom: 1px solid #f1f1f1;
            transition: all 0.2s ease;
            white-space: normal;
            word-wrap: break-word;
        }

        .notifications-dropdown .dropdown-item:hover {
            background-color: #f8f9fa;
        }

        [dir="ltr"] .notifications-dropdown .dropdown-item:hover {
            transform: translateX(5px);
        }

        [dir="rtl"] .notifications-dropdown .dropdown-item:hover {
            transform: translateX(-5px);
        }

        .notifications-dropdown .dropdown-divider {
            margin: 0;
        }

        .notifications-dropdown .text-center a {
            padding: 12px;
            display: block;
            text-decoration: none;
            transition: all 0.2s ease;
        }

        .notifications-dropdown .text-center a:hover {
            background-color: #f8f9fa;
        }

        /* تحسينات للسايدبار */
        .sidebar {
            min-height: calc(100vh - 70px);
            background: linear-gradient(180deg, #1e293b, #0f172a);
            box-shadow: 2px 0 10px rgba(0,0,0,0.1);
            overflow-y: auto;
            height: calc(100vh - 70px);
            position: sticky;
            top: 70px;
        }

        .sidebar h5 {
            color: #fff;
            font-size: 1.4rem;
            padding: 15px 10px;
            margin: 0;
            border-bottom: 1px solid rgba(255, 255, 255, 0.1);
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .sidebar .nav-link {
            color: #cbd5e1;
            padding: 12px 15px !important;
            border-radius: 8px;
            margin: 5px 10px;
            transition: all 0.3s ease;
            font-weight: 500;
            display: flex;
            align-items: center;
        }

        .sidebar .nav-link i {
            font-size: 1.2rem;
            width: 25px;
        }

        .sidebar .nav-link:hover {
            background-color: rgba(255, 255, 255, 0.15);
            color: #fff;
        }

        [dir="ltr"] .sidebar .nav-link:hover {
            transform: translateX(5px);
        }

        [dir="rtl"] .sidebar .nav-link:hover {
            transform: translateX(-5px);
        }

        .sidebar .nav-link.active {
            background: linear-gradient(90deg, #667eea, #764ba2);
            color: #fff;
            box-shadow: 0 4px 10px rgba(102, 126, 234, 0.3);
        }

        /* تنسيق زر تسجيل الخروج */
        .btn-logout-sidebar {
            background: rgba(239, 68, 68, 0.2);
            border: 1px solid rgba(239, 68, 68, 0.3);
            color: #fff;
            padding: 12px 15px;
            border-radius: 8px;
            margin: 10px;
            width: calc(100% - 20px);
            transition: all 0.3s ease;
            display: flex;
            align-items: center;
            gap: 10px;
            border: none;
            cursor: pointer;
            font-weight: 500;
        }

        .btn-logout-sidebar:hover {
            background: #ef4444;
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(239, 68, 68, 0.4);
        }

        /* تحسينات للمحتوى الرئيسي */
        .main-content {
            padding: 20px;
            height: calc(100vh - 70px);
            overflow-y: auto;
            background-color: #f8fafc;
        }

        /* تنسيق البطاقات */
        .content-card {
            background: #fff;
            border-radius: 15px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.05);
            border: none;
        }

        .content-card .card-body {
            padding: 20px;
        }

        /* تنسيقات RTL للعربية */
        [dir="rtl"] .ms-auto {
            margin-right: auto !important;
            margin-left: 0 !important;
        }

        [dir="rtl"] .me-2 {
            margin-left: 0.5rem !important;
            margin-right: 0 !important;
        }

        [dir="rtl"] .me-1 {
            margin-left: 0.25rem !important;
            margin-right: 0 !important;
        }

        /* تحسينات للأجهزة المحمولة */
        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                top: 70px;
                width: 260px;
                z-index: 1040;
                transition: all 0.3s ease;
            }

            [dir="ltr"] .sidebar {
                left: -100%;
                right: auto;
            }

            [dir="rtl"] .sidebar {
                right: -100%;
                left: auto;
            }

            [dir="ltr"] .sidebar.show {
                left: 0;
            }

            [dir="rtl"] .sidebar.show {
                right: 0;
            }

            .main-content {
                padding: 15px;
            }

            .notifications-dropdown {
                width: 280px;
            }

            .navbar-brand-auth {
                font-size: 1.4rem;
            }

            .notifications-wrapper {
                position: static;
                transform: none;
                margin-left: auto;
                margin-right: 10px;
            }

            [dir="rtl"] .notifications-wrapper {
                margin-right: auto;
                margin-left: 10px;
            }
        }
    </style>

    @if(App::getLocale() == 'ar')
        <link href="https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700&display=swap" rel="stylesheet">
        <style>
            body, .sidebar, .navbar-auth, .dropdown-menu {
                font-family: 'Tajawal', sans-serif;
            }
        </style>
    @endif
</head>
<body>
    <!-- النافبار - مع زر اللغة والاشعارات -->
    <nav class="navbar navbar-expand-lg navbar-auth">
        <div class="container-fluid px-4">
            <!-- زر اللغة على اليسار/اليمين حسب اللغة -->
            <div class="language-dropdown-auth">
                <div class="dropdown">
                    <button class="btn language-btn-auth dropdown-toggle"
                            type="button"
                            id="languageDropdown"
                            data-bs-toggle="dropdown"
                            aria-expanded="false">
                        <i class="fas fa-globe"></i>
                        <span>{{ App::getLocale() == 'ar' ? 'العربية' : 'English' }}</span>
                    </button>
                    <ul class="dropdown-menu language-dropdown-menu-auth" aria-labelledby="languageDropdown">
                        @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                            <li>
                                <a class="language-item-auth {{ App::getLocale() == $localeCode ? 'active' : '' }}"
                                   href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    @if($localeCode == 'ar')
                                        <i class="fas fa-flag"></i>
                                    @else
                                        <i class="fas fa-flag-usa"></i>
                                    @endif
                                    {{ $properties['native'] }}
                                    @if(App::getLocale() == $localeCode)
                                        <i class="fas fa-check ms-auto"></i>
                                    @endif
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>

            <!-- اسم التطبيق في المنتصف -->
            <a class="navbar-brand-auth" href="{{ LaravelLocalization::localizeURL(route('admin.dashboard')) }}">
                <i class="fas fa-tasks"></i>
                {{ __('messages.TaskApp') }}
            </a>

            <!-- زر الاشعارات على الجهة المقابلة للغة -->
            <div class="notifications-wrapper">
                <div class="dropdown">
                    <div class="notifications-btn" id="notificationsDropdown" data-bs-toggle="dropdown" aria-expanded="false">
                        <i class="bi bi-bell"></i>
                        @if(Auth::user()->unreadNotifications->count() > 0)
                            <span class="notification-badge">
                                {{Auth::user()->unreadNotifications->count() > 9 ? '9+' : Auth::user()->unreadNotifications->count()}}
                            </span>
                        @endif
                    </div>
                    <ul class="dropdown-menu notifications-dropdown" aria-labelledby="notificationsDropdown">
                        <li class="dropdown-header">
                            <i class="bi bi-bell-fill me-2"></i>
                            {{ __('messages.notifications') }}
                        </li>
                        <li><hr class="dropdown-divider"></li>

                        <!-- عناصر الإشعارات -->
                        @forelse (Auth::user()->unreadNotifications()->latest()->take(5)->get() as $notification)
                            <li>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <span class="me-2">🔔</span>
                                    <span>{{ Str::limit($notification->data['message'] ?? '', 35, '...') }}</span>
                                </a>
                            </li>
                        @empty
                            <li>
                                <span class="dropdown-item text-muted text-center py-3">
                                    {{ __('messages.noNotifications') }}
                                </span>
                            </li>
                        @endforelse

                        <li><hr class="dropdown-divider"></li>
                        <li class="text-center">
                            <a class="dropdown-item text-primary fw-bold py-2" href="{{route('admin.notifications')}}">
                                <i class="bi bi-eye me-1"></i>
                                {{ __('messages.Show All Notifications') }}
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </nav>

    <div class="container-fluid">
        <div class="row">
            <!-- Sidebar -->
            <aside class="col-md-3 col-lg-2 sidebar p-0" id="sidebar">
                <h5 class="fw-bold">
                    <i class="fas fa-cog"></i>
                    {{ __('messages.AdminPanel') }}
                </h5>

                <ul class="nav flex-column gap-1 mt-2">
                    <li class="nav-item">
                        <a class="nav-link px-3 py-2 rounded {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}"
                           href="{{ LaravelLocalization::localizeURL(route('admin.dashboard')) }}">
                            <i class="bi bi-speedometer2 me-2"></i>
                            {{ __('messages.Dashboard') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 py-2 rounded {{ request()->routeIs('admin.showAllTasks') ? 'active' : '' }}"
                           href="{{ LaravelLocalization::localizeURL(route('admin.showAllTasks')) }}">
                            <i class="bi bi-list-task me-2"></i>
                            {{ __('messages.AllTasks') }}
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link px-3 py-2 rounded {{ request()->routeIs('admin.users.index') ? 'active' : '' }}"
                           href="{{ LaravelLocalization::localizeURL(route('admin.users.index')) }}">
                            <i class="bi bi-people me-2"></i>
                            {{ __('messages.AllUsers') }}
                        </a>
                    </li>
                </ul>

                <!-- زر تسجيل الخروج -->
                <div class="mt-4">
                    <form action="{{ route('logout') }}" method="POST">
                        @csrf
                        <button type="submit" class="btn-logout-sidebar">
                            <i class="fas fa-sign-out-alt me-2"></i>
                            {{ __('messages.logout') }}
                        </button>
                    </form>
                </div>
            </aside>

            <!-- Main Content -->
            <main class="col-md-9 col-lg-10 main-content">
                <!-- عنوان الصفحة -->
                <div class="d-flex justify-content-between align-items-center mb-4">

                    <!-- أيقونة القائمة للموبايل -->
                    <button class="btn btn-primary d-md-none" onclick="toggleSidebar()">
                        <i class="fas fa-bars"></i>
                    </button>
                </div>

                <!-- البطاقات والمحتوى -->
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        // وظيفة تبديل السايدبار في الأجهزة المحمولة
        function toggleSidebar() {
            const sidebar = document.getElementById('sidebar');
            sidebar.classList.toggle('show');
        }

        // إغلاق السايدبار عند النقر خارجها في الأجهزة المحمولة
        document.addEventListener('click', function(event) {
            const sidebar = document.getElementById('sidebar');
            const toggleButton = document.querySelector('.d-md-none');

            if (window.innerWidth <= 768) {
                if (sidebar && !sidebar.contains(event.target) && !toggleButton?.contains(event.target)) {
                    sidebar.classList.remove('show');
                }
            }
        });

        // إضافة علامة ✓ للغة الحالية
        document.querySelectorAll('.language-item-auth.active').forEach(item => {
            if (!item.querySelector('.fa-check')) {
                const checkIcon = document.createElement('i');
                checkIcon.className = 'fas fa-check ms-auto';
                item.appendChild(checkIcon);
            }
        });

        // تفعيل التولتيب
        var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
        tooltipTriggerList.map(function (tooltipTriggerEl) {
            return new bootstrap.Tooltip(tooltipTriggerEl);
        });

        // تصحيح موضع القوائم المنسدلة
        document.getElementById('languageDropdown')?.addEventListener('shown.bs.dropdown', function () {
            const dropdownMenu = this.nextElementSibling;
            const isRTL = document.documentElement.dir === 'rtl';

            if (dropdownMenu) {
                if (isRTL) {
                    dropdownMenu.style.left = 'auto';
                    dropdownMenu.style.right = '0';
                } else {
                    dropdownMenu.style.left = '0';
                    dropdownMenu.style.right = 'auto';
                }
            }
        });

        // تصحيح موضع قائمة الاشعارات
        document.getElementById('notificationsDropdown')?.addEventListener('shown.bs.dropdown', function () {
            const dropdownMenu = this.nextElementSibling;
            const isRTL = document.documentElement.dir === 'rtl';

            if (dropdownMenu) {
                if (isRTL) {
                    dropdownMenu.style.left = 'auto';
                    dropdownMenu.style.right = '0';
                } else {
                    dropdownMenu.style.left = 'auto';
                    dropdownMenu.style.right = '0';
                }
            }
        });

        // منع إغلاق القائمة عند النقر داخلها
        document.querySelectorAll('.dropdown-menu').forEach(menu => {
            menu.addEventListener('click', function(e) {
                e.stopPropagation();
            });
        });
    </script>

    @stack('scripts')
</body>
</html>
