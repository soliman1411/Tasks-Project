@extends('layouts.app')
        <link rel="stylesheet" href="{{ asset('css/component/tasks/edit.css') }}">

@section('content')
<div class="container py-4">

    {{-- Update Task Form --}}
    <div class="row">
        <div class="col-md-8 col-lg-6 mx-auto">
            <div class="card border-0 shadow-sm rounded-3">
                <div class="card-body p-4">
                    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        {{-- Task Title --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium">
                                {{ __('messages.taskTitle') }}
                                <span class="text-danger">*</span>
                            </label>
                            <input type="text"
                                   name="title"
                                   class="form-control @error('title') is-invalid @enderror"
                                   value="{{ old('title', $task->title) }}">
                            @error('title')
                                <div class="alert alert-danger py-2 mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Task Description --}}
                        <div class="mb-3">
                            <label class="form-label fw-medium">
                                {{ __('messages.taskDescription') }}
                                <span class="text-danger">*</span>
                            </label>
                            <textarea name="description"
                                      class="form-control @error('description') is-invalid @enderror"
                                      rows="4">{{ old('description', $task->description) }}</textarea>
                            @error('description')
                                <div class="alert alert-danger py-2 mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Task Status --}}
                        <div class="mb-4">
                            <label class="form-label fw-medium">
                                {{ __('messages.taskStatus') }}
                                <span class="text-danger">*</span>
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
                                <div class="alert alert-danger py-2 mt-2">
                                    <i class="fas fa-exclamation-circle me-1"></i>
                                    {{ $message }}
                                </div>
                            @enderror
                        </div>

                        {{-- Form Actions --}}
                        <div class="d-flex gap-2 justify-content-end">
                            <a href="{{ route('tasks.index') }}" class="btn btn-light px-4">
                                {{ __('messages.cancel') ?? 'إلغاء' }}
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
