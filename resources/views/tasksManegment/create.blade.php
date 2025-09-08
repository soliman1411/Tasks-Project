@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">{{ __('messages.CreateNewTask') }}</h2>
    <form action="{{ route('tasksManegment.store') }}" method="POST">
        @csrf
        <div class="mb-3">

            <label class="form-label">{{ __('messages.taskTitle') }}</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">

            <label class="form-label">{{ __('messages.taskDescription') }}</label>
            <textarea name="description" class="form-control" rows="4" ></textarea>
             @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

         <div class="mb-3">

            <label class="form-label">{{ __('messages.is_Done') }}</label>
            <select name="is_done" class="form-select">
                <option value="incomplete"> {{ __('messages.inComplete') }}</option>
                <option value="complete">{{ __('messages.complete') }}</option>
            </select>
            @error('is_done')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

         <div class="mb-3">
        <label for="user_id">{{ __('messages.userName') }}</label>
        <select name="user_id" class="form-control" >
            <option value="">{{ __('messages.userName') }}</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>

        </div>


        <button type="submit" class="btn btn-success">{{ __('messages.save') }}</button>
    </form>
</div>
@endsection
