@extends('layouts.admin')

@section('content')
<div class="container">

    <h2 class="mb-4">{{ __('messages.taskUpdating') }}</h2>
    <form action="{{ route('tasksManegment.update', $task->id) }}" method="POST">
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
            <label class="form-label">  {{ __('messages.taskDescription') }}</label>

            <textarea name="description" class="form-control" rows="4" >{{ $task->description }}</textarea>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

    {{-- الحالة --}}
    <div class="mb-3">
        <label class="form-label">{{ __('messages.taskStatus') }}</label>
        <select name="is_done" class="form-select">
            <option value="incomplete"
                @selected(old('is_done', $task->is_done ?? '') == "incomplete")>
                {{ __('messages.InComplete') }}
            </option>
            <option value="complete"
                @selected(old('is_done', $task->is_done ?? '') == "complete")>
                {{ __('messages.Complete') }}
            </option>
        </select>
    </div>

    {{-- المستخدم --}}
    <div class="mb-3">
        <label for="user_id">  {{ __('messages.name') }}</label>
        <select name="user_id" class="form-control">
            @foreach($users as $user)
                <option value="{{ $user->id }}"
                    @selected(old('user_id', $task->user_id ?? '') == $user->id)>
                    {{ $user->name }}
                </option>
            @endforeach
        </select>
    </div>
        <button type="submit" class="btn btn-success">{{ __('messages.update') }}</button>
    </form>
</div>
@endsection
