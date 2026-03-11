@extends('layouts.admin')

@section('content')
<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow border-0">
                <div class="card-header bg-white py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <i class="bi bi-bell-fill text-primary me-2"></i>
                            <span class="fw-bold">{{ __('messages.notification') }}</span>
                        </div>
                        <a href="{{ route('admin.notifications') }}" class="btn btn-sm btn-outline-secondary">
                            <i class="bi bi-x-lg"></i>
                        </a>
                    </div>
                </div>

                <div class="card-body p-4">
                    {{-- badge الحالة --}}
                    <div class="mb-4">
                        @if($notification->read_at)
                            <span class="badge bg-light text-success border py-2 px-3">
                                <i class="bi bi-check-circle me-1"></i> {{ __('messages.read') }}
                            </span>
                        @else
                            <span class="badge bg-light text-danger border py-2 px-3">
                                <i class="bi bi-exclamation-circle me-1"></i> {{ __('messages.unread') }}
                            </span>
                        @endif
                    </div>

                    {{-- محتوى الإشعار --}}
                    <div class="mb-4">
                        <div class="text-muted small mb-2">{{ __('messages.message') }}</div>
                        <div class="p-3 bg-light rounded">
                            {{ $notification->data['message'] ?? 'لا يوجد محتوى' }}
                        </div>
                    </div>

                    {{-- تفاصيل الوقت --}}
                    <div class="border-top pt-3">
                        <div class="row text-muted small">
                            <div class="col-6">
                                <i class="bi bi-send me-1"></i>
                                {{ $notification->created_at->format('Y-m-d') }}
                            </div>
                            <div class="col-6 text-end">
                                <i class="bi bi-clock me-1"></i>
                                {{ $notification->created_at->format('h:i A') }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
