@extends('layouts.admin')


@section('content')
<div class="container-fluid px-4 py-4">

    {{-- Header بسيط --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0" style="color: #ffc107;">
            <i class="fas fa-user-edit me-2"></i>
            {{ __('messages.updateUser') }}
        </h2>

    </div>

    {{-- Update User Form --}}
    <div class="row">
        <div class="col-md-8 col-lg-6 mx-auto">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <form action="{{ route('admin.users.update', $user->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- User Name --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium">
                                {{ __('messages.userName') }} <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name', $user->name) }}"
                                   >
                            @error('name')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- User Email --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium">
                                {{ __('messages.email') }} <span class="text-danger">*</span>
                            </label>
                            <input type="email"
                                   name="email"
                                   class="form-control @error('email') is-invalid @enderror"
                                   value="{{ old('email', $user->email) }}"
                                   >
                            @error('email')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- User Password (Optional) --}}
                        <div class="mb-4">
                            <label class="form-label fw-medium">
                                {{ __('messages.password') ?? 'كلمة مرور جديدة' }}
                            </label>
                            <input type="password"
                                   name="password"
                                   class="form-control @error('password') is-invalid @enderror"
                                   >
                            @error('password')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror

                        </div>

                        {{-- Form Actions --}}
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-light px-4">
                                {{ __('messages.cancel') }}
                            </a>
                            <button type="submit" class="btn btn-warning px-4">
                                <i class="fas fa-save me-1"></i>
                                {{ __('messages.update') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
