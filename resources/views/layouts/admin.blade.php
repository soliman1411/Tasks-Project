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

        <link rel="stylesheet" href="{{ asset('css/layouts/admin.css') }}">


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
                        <a class="nav-link px-3 py-2 rounded {{ request()->routeIs('admin.tasks.index') ? 'active' : '' }}"
                           href="{{ LaravelLocalization::localizeURL(route('admin.tasks.index')) }}">
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
