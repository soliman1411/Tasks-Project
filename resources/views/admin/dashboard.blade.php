@extends('layouts.admin')

@section('content')
<!-- شريط علوي بسيط -->
<nav class="navbar navbar-light bg-white shadow-sm mb-4">
    <div class="container-fluid d-flex justify-content-end">
        <!-- أيقونة الإشعارات -->
        <div class="dropdown">
            <a class="nav-link position-relative" href="#" id="notificationsDropdown" role="button"
               data-bs-toggle="dropdown" aria-expanded="false">
                <i class="bi bi-bell fs-4 text-dark"></i>

                <!-- البادج الأحمر فوق الجرس -->
                <span class="position-absolute top-0 start-100 translate-middle badge rounded-circle bg-danger"
                      style="font-size: 0.7rem; min-width: 20px; height: 20px; line-height: 14px;">
                    {{Auth::user()->unreadNotifications->count()}}
                </span>
            </a>
            <ul class="dropdown-menu dropdown-menu-end shadow-lg border-0 rounded-3"
                aria-labelledby="notificationsDropdown" style="width: 320px; max-height: 350px; overflow-y: auto;">
                <li class="dropdown-header fw-bold text-primary">🔔 {{ __('messages.notifications') }}</li>
                <li><hr class="dropdown-divider"></li>

                <!-- عناصر الإشعارات -->


                @forelse (Auth::user()->unreadNotifications()->latest()->take(5)->get() as $notification)
              <li>
                    <a class="dropdown-item d-flex align-items-center" href="#">
                        <span class="me-2"></span>
                        <span>{{ Str::limit($notification->data['message'], 35, '...') }}</span>
                    </a>
                </li>
                @empty
                <span>{{ __('messages.noNotifications') }}</span>
                @endforelse

                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-center text-primary fw-bold" href="{{route('admin.AllNotifications')}}">Show All Notifications</a></li>
            </ul>
        </div>
    </div>
    <h2 class="mb-4">{{ __('messages.adminDashboard') }}</h2>
</nav>
    <div class="row">
        <!-- Users Count -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3 shadow">
                <div class="card-header"> {{ __('messages.totalUsers') }}</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $usersCount ?? 0}}</h5>
                </div>
            </div>
        </div>

        <!--  Tasks Count-->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3 shadow">
                <div class="card-header"> {{ __('messages.totalTasks') }}</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $tasksCount ?? 0}}</h5>
                </div>
            </div>
        </div>

        <!-- complete Tasks -->
        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3 shadow">
                <div class="card-header"> {{ __('messages.completedTasks') }}</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $completedTasks ?? 0}}</h5>
                </div>
            </div>
        </div>
        <!-- incomplete Tasks -->
        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3 shadow">
                <div class="card-header">{{ __('messages.inCompletedTasks') }} </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $inCompletedTasks ?? 0}}</h5>
                </div>
            </div>
        </div>
    </div>
@endsection
