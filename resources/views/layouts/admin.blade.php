<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>{{ $title ?? 'Admin Panel' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <style>
        body {
            min-height: 100vh;
        }

        .sidebar {
            height: 100vh;
            position: fixed;
        }

        main {
            margin-left: 220px;
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        <nav class="col-md-2 d-none d-md-block bg-dark text-white sidebar p-3">
            <h4>Admin</h4>
            <ul class="nav flex-column mt-4">
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('usersManegment.index') }}">Users Manegment</a></li>
                <li class="nav-item"><a class="nav-link text-white" href="{{ route('tasksManegment.index') }}">Tasks Manegment</a></li>
                <li class="nav-item">
                    <form action="{{ route('logout') }}" method="POST">
                    @csrf
                        <button type="submit" class="nav-link btn btn-link text-white text-start">Logout</button>
                    </form>
                </li>
            </ul>
        </nav>

        <!-- Main Content -->
        <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4 py-4">
            @yield('content')
        {!! Flasher::render() !!}

    </div>

        </main>
    </div>
</div>
</body>
</html>
