@extends('layouts.app')

@section('content')
<div class="container mt-4">

    <h3 class="mb-4 text-primary">
        <i class="bi bi-bell"></i>{{ __('messages.notifications') }}
    </h3>

    <div class="card shadow-sm border-0 rounded-3">
        <div class="card-body p-0">
            <ul class="list-group list-group-flush">

                @forelse (Auth::user()->notifications as $notification)
                 <!-- إشعار غير مقروء -->
                <li class="list-group-item d-flex justify-content-between align-items-start bg-light">
                    <div class="ms-2 me-auto">
                        <div class="fw-bold"></div>
                        {{ $notification->data['message'] }}
                    </div>
                    <span class="badge bg-danger rounded-pill">{{$notification->created_at->diffForHumans() }}</span>
                </li>
                @empty
                <span>{{ __('messages.noNotifications') }}</span>
                @endforelse

            </ul>
        </div>
    </div>

</div>
@endsection
