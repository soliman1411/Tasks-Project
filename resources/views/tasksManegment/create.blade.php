@extends('layouts.admin')


@section('content')
<div class="container-fluid px-4 py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0" style="color: #28a745;">
            <i class="fas fa-plus-circle me-2"></i>
            {{ __('messages.CreateNewTask') }}
        </h2>

    </div>

    {{-- Create Task Form --}}
    <div class="row">
        <div class="col-md-8 col-lg-6 mx-auto">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <form action="{{ route('admin.tasks.store') }}" method="POST">
                        @csrf

                        {{-- Task Title --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium">
                                {{ __('messages.taskTitle') }} <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title') }}"
                                  >
                            @error('title')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Task Description --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium">
                                {{ __('messages.taskDescription') }} <span class="text-danger">*</span>
                            </label>
                            <textarea name="description"
                                      class="form-control @error('description') is-invalid @enderror"
                                      rows="4"
                                     >{{ old('description') }}</textarea>
                            @error('description')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- User Selection --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium">
                                {{ __('messages.userName') }} <span class="text-danger">*</span>
                            </label>
                            <select name="user_id" class="form-select @error('user_id') is-invalid @enderror">
                                <option value="">{{ __('messages.userName') }}</option>
                                @foreach($users as $user)
                                    <option value="{{ $user->id }}" {{ old('user_id') == $user->id ? 'selected' : '' }}>
                                        {{ $user->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('user_id')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Task Status --}}
                        <div class="mb-4">
                            <label class="form-label fw-medium">
                                {{ __('messages.is_Done') }} <span class="text-danger">*</span>
                            </label>
                            <select name="is_done" class="form-select @error('is_done') is-invalid @enderror">
                                <option value="incomplete" {{ old('is_done') == 'incomplete' ? 'selected' : '' }}>
                                    {{ __('messages.inComplete') }}
                                </option>
                                <option value="complete" {{ old('is_done') == 'complete' ? 'selected' : '' }}>
                                    {{ __('messages.complete') }}
                                </option>
                            </select>
                            @error('is_done')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Form Actions --}}
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('admin.tasks.index') }}" class="btn btn-light px-4">
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
