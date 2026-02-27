@extends('layouts.admin')


@section('content')
<div class="container-fluid px-4 py-4">

    {{-- Header with Recycle Bin --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1" style="color: #0d6efd;">
                <i class="fas fa-users me-2"></i>
                {{ __('messages.AllUsers') }}
            </h2>
            <p class="text-muted mb-0 small">
                <i class="fas fa-info-circle me-1 text-primary"></i>
                {{ __('messages.totalUsers') }}: {{ $users->total() ?? 0 }}
            </p>
        </div>
        <a href="{{ route('admin.users.trashed') }}" class="btn btn-outline-danger">
            <i class="fas fa-trash-restore me-1"></i>
            {{ __('messages.recycleBin') }}
        </a>
    </div>

    {{-- Search and Create Section --}}
    <div class="row g-3 mb-4">
        <div class="col-md-8">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-3">
                    <form action="{{ route('admin.users.index') }}" method="get" class="row g-2">
                        @csrf
                        <div class="col-9">
                            <div class="input-group">
                                <span class="input-group-text bg-white border-end-0">
                                    <i class="fas fa-search text-primary"></i>
                                </span>
                                <input type="text"
                                       name="search"
                                       id="search"
                                       value="{{ request()->search }}"
                                       class="form-control border-start-0"
                                       placeholder="🔍 {{ __('messages.searchUsersWithName') }}"
                                       style="height: 45px;">
                            </div>
                        </div>
                        <div class="col-3">
                            <button type="submit" class="btn btn-primary w-100" style="height: 45px;">
                                <i class="fas fa-search me-2"></i>{{ __('messages.search') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <a href="{{ route('admin.users.create') }}" class="btn btn-success w-100 d-flex align-items-center justify-content-center gap-2" style="height: 45px;">
                <i class="fas fa-user-plus"></i>
                {{ __('messages.CreateNewUser') }}
            </a>
        </div>
    </div>

    {{-- Users Table --}}
    <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
        <div class="card-header bg-white py-3">
            <h5 class="mb-0">
                <i class="fas fa-list-check me-2 text-primary"></i>
                {{ __('messages.AllUsers') }}
            </h5>
        </div>
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="bg-primary text-white">
                        <tr>
                            <th class="px-3 py-3 text-center">{{ __('messages.id') }}</th>
                            <th class="px-3 py-3">{{ __('messages.name') }}</th>
                            <th class="px-3 py-3">{{ __('messages.email') }}</th>
                            <th class="px-3 py-3 text-center">{{ __('messages.tasks') }}</th>
                            <th class="px-3 py-3 text-center">{{ __('messages.actions') }}</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($users as $user)
                            <tr class="border-bottom">
                                <td class="px-3 text-center">
                                    <span class="badge bg-light text-dark rounded-pill px-3 py-2">
                                        #{{ $user->id }}
                                    </span>
                                </td>
                                <td class="px-3">
                                    <div class="d-flex align-items-center">
                                        <div class="bg-info bg-opacity-10 rounded-circle p-2 me-2">
                                            <i class="fas fa-user text-info"></i>
                                        </div>
                                        <span class="fw-semibold">{{ $user->name }}</span>
                                    </div>
                                </td>
                                <td class="px-3">
                                    <div class="d-flex align-items-center">
                                        <i class="fas fa-envelope text-secondary me-2 opacity-50"></i>
                                        <span>{{ $user->email }}</span>
                                    </div>
                                </td>
                                <td class="px-3 text-center">
                                    <a href="{{ route('admin.showTasks', $user->id) }}"
                                       class="btn btn-sm btn-outline-primary rounded-pill px-3 hover-lift"
                                       data-bs-toggle="tooltip"
                                       title="{{ __('messages.ShowTasks') }}">
                                        <i class="fas fa-tasks me-1"></i>
                                        {{ __('messages.ShowTasks') }}
                                    </a>
                                </td>
                                <td class="px-3">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('admin.users.edit', $user->id) }}"
                                           class="btn btn-sm btn-primary rounded-pill px-3 hover-lift"
                                           data-bs-toggle="tooltip"
                                           title="{{ __('messages.edit') }}">
                                            <i class="fas fa-edit me-1"></i>
                                            {{ __('messages.edit') }}
                                        </a>

                                        <form action="{{ route('admin.users.destroy', $user->id) }}"
                                              method="POST"
                                              class="d-inline"
                                              onsubmit="return confirm('{{ __('messages.confirmDelete') }}')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit"
                                                    class="btn btn-sm btn-danger rounded-pill px-3 hover-lift"
                                                    data-bs-toggle="tooltip"
                                                    title="{{ __('messages.delete') }}">
                                                <i class="fas fa-trash-alt me-1"></i>
                                                {{ __('messages.delete') }}
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="text-center py-5">
                                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">{{ __('messages.NoUsersFound') }}</h5>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    

            {{ $users->withQueryString()->links() }}

</div>

<style>
    .table > :not(caption) > * > * {
        padding: 1rem 0.75rem;
    }

    .form-control, .input-group-text {
        border: 1px solid #dee2e6;
    }

    .form-control:focus {
        border-color: #86b7fe;
        box-shadow: 0 0 0 0.2rem rgba(13, 110, 253, 0.1);
    }

    .card {
        transition: all 0.3s ease;
    }

    .badge {
        font-weight: 500;
    }

    .btn {
        transition: all 0.3s ease;
    }

    .btn-outline-primary:hover {
        background-color: #0d6efd;
        color: white;
    }

    .hover-lift:hover {
        transform: translateY(-2px);
        box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
    }

    /* RTL Support */
    [dir="rtl"] .me-1, [dir="rtl"] .me-2 {
        margin-left: 0.25rem !important;
        margin-right: 0 !important;
    }

    [dir="rtl"] .ms-auto {
        margin-right: auto !important;
        margin-left: 0 !important;
    }

    @media (max-width: 768px) {
        .col-md-8, .col-md-4, .col-9, .col-3 {
            width: 100%;
        }

        .btn {
            width: 100%;
        }

        .d-flex.justify-content-center.gap-2 {
            flex-direction: column;
            gap: 0.5rem !important;
        }

        .btn-sm {
            width: 100%;
        }

        .d-flex.justify-content-between.align-items-center {
            flex-direction: column;
            gap: 1rem;
        }
    }
</style>
@endsection
