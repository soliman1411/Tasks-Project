<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'My App' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap 5 CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        /* لون خلفية أفتح للنافبار */
        .navbar-custom {
            background-color: #f8f9fa; /* لون رمادي فاتح جدا */
        }

        .avatar-circle {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: #6c757d;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1rem;
        }

        /* تحسين شكل زر تسجيل الخروج */
        .logout-btn {
            color: #dc3545; /* نفس لون bootstrap danger */
            border: 1px solid #dc3545;
            padding: 0.375rem 0.75rem;
            border-radius: 0.25rem;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
            font-weight: 500;
        }
        .logout-btn:hover {
            background-color: #dc3545;
            color: white;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light navbar-custom">
    <div class="container">
        <a class="navbar-brand fw-bold text-dark" href="{{ route('tasks.index') }}">TaskApp</a>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="mainNavbar">
            <ul class="navbar-nav align-items-center">
                @auth
                    {{-- Avatar + اسم المستخدم --}}
                    <li class="nav-item me-2 d-flex align-items-center">
                        @php
                            $name = auth()->user()->name;
                            $initial = strtoupper(substr($name, 0, 1));
                        @endphp
                        <div class="avatar-circle me-2">{{ $initial }}</div>
                        <span class="text-dark">{{ $name }}</span>
                    </li>

                    {{-- زر تسجيل الخروج --}}
                    <li class="nav-item ms-3">
                        <a class="logout-btn nav-link" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                            @csrf
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link text-dark" href="{{ route('login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link text-dark" href="{{ route('register') }}">Register</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

<div class="container py-4">
    @yield('content')
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
