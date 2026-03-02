@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">

    {{-- Header with Actions --}}
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
        <div class="d-flex gap-2">
            {{-- Trash Button --}}
            <a href="{{ route('admin.users.trashed') }}" class="btn btn-outline-danger d-flex align-items-center gap-2" style="height: 45px;">
                <i class="fas fa-trash-restore"></i>
                {{ __('messages.recycleBin') }}
            </a>

            {{-- Create User Button --}}
            <a href="{{ route('admin.users.create') }}" class="btn btn-success d-flex align-items-center gap-2" style="height: 45px;">
                <i class="fas fa-user-plus"></i>
                {{ __('messages.CreateNewUser') }}
            </a>
        </div>
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
        {{-- <div class="col-md-4">
            <a href="{{ route('admin.users.create') }}" class="btn btn-success w-100 d-flex align-items-center justify-content-center gap-2" style="height: 45px;">
                <i class="fas fa-user-plus"></i>
                {{ __('messages.CreateNewUser') }}
            </a>
        </div> --}}
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

    {{-- Pagination --}}
    <div class="mt-4">
        {{ $users->withQueryString()->links() }}
    </div>
</div>
@endsection
