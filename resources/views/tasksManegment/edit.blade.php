@extends('layouts.admin')


@section('content')
<div class="container-fluid px-4 py-4">

    {{-- Header --}}
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2 class="fw-bold mb-0" style="color: #1707ff;">
            <i class="fas fa-edit me-2"></i>
            {{ __('messages.taskUpdating') }}
        </h2>

    </div>

    {{-- Update Task Form --}}
    <div class="row">
        <div class="col-md-8 col-lg-6 mx-auto">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <form action="{{ route('admin.tasks.update', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Hidden User ID --}}
                        <input type="hidden" name="user_id" value="{{ $task->user_id }}">

                        {{-- Task Title --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium">
                                {{ __('messages.taskTitle') }} <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title', $task->title) }}"
                                   placeholder="{{ __('messages.enterTaskTitle') }}">
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
                                      placeholder="{{ __('messages.enterTaskDescription') }}">{{ old('description', $task->description) }}</textarea>
                            @error('description')
                                <div class="text-danger small mt-1">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- User Info (Read Only) --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium">
                                {{ __('messages.userName') }}
                            </label>
                            <div class="form-control bg-light">
                                <i class="fas fa-user me-2 text-secondary"></i>
                                {{ $task->user->name }}
                            </div>
                        </div>

                        {{-- Task Status --}}
                        <div class="mb-4">
                            <label class="form-label fw-medium">
                                {{ __('messages.taskStatus') }} <span class="text-danger">*</span>
                            </label>
                            <select name="is_done" class="form-select @error('is_done') is-invalid @enderror">
                                <option value="incomplete" {{ old('is_done', $task->is_done) == 'incomplete' ? 'selected' : '' }}>
                                    {{ __('messages.inComplete') }}
                                </option>
                                <option value="complete" {{ old('is_done', $task->is_done) == 'complete' ? 'selected' : '' }}>
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
