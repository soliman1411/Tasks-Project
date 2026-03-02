@extends('layouts.admin')

@section('page-title', __('messages.CreateNewUser'))

@section('content')
<div class="container-fluid px-4 py-4">

    {{-- Header بسيط --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0" style="color: #28a745;">
            <i class="fas fa-user-plus me-2"></i>
            {{ __('messages.CreateNewUser') }}
        </h2>
       
    </div>

    {{-- Create User Form --}}
    <div class="row">
        <div class="col-md-8 col-lg-6 mx-auto">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <form action="{{ route('admin.users.store') }}" method="POST">
                        @csrf

                        {{-- User Name --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium">
                                {{ __('messages.userName') }} <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="name"
                                   class="form-control @error('name') is-invalid @enderror"
                                   value="{{ old('name') }}"
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
                                   value="{{ old('email') }}"
                                   >
                            @error('email')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- User Password --}}
                        <div class="mb-4">
                            <label class="form-label fw-medium">
                                {{ __('messages.password') }} <span class="text-danger">*</span>
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
                            <button type="submit" class="btn btn-success px-4">
                                <i class="fas fa-save me-1"></i>
                                {{ __('messages.save') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
