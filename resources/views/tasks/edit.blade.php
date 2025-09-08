@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-4">{{ __('messages.taskUpdating') }}</h2>
    <form action="{{ route('tasks.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">{{ __('messages.taskTitle') }}</label>
            <input type="text" name="title" class="form-control" value="{{ $task->title }}" >

        @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('messages.taskDescription') }} </label>

            <textarea name="description" class="form-control" rows="4" >{{ $task->description }}</textarea>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('messages.taskStatus') }}</label>
            <select name="is_done" class="form-select">
                <option value="incomplete" @selected(old('is_done') == "incomplete")>{{ __('messages.inComplete') }}</option>
                <option value="complete" @selected(old('is_done') == "complete")>{{ __('messages.complete') }}</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">{{ __('messages.update') }}</button>
    </form>
</div>
@endsection
