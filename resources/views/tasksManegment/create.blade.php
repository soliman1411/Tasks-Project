@extends('layouts.admin')

@section('content')
<div class="container">
    <h2 class="mb-4">{{ __('messages.CreateNewTask') }}</h2>
    <form action="{{ route('tasksManegment.store') }}" method="POST">
        @csrf
        <div class="mb-3">

            <label class="form-label">Task Title</label>
            <input type="text" name="title" class="form-control" value="{{ old('title') }}">
            @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">

            <label class="form-label">Task Description</label>
            <textarea name="description" class="form-control" rows="4" ></textarea>
             @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

         <div class="mb-3">

            <label class="form-label">Task Status</label>
            <select name="is_done" class="form-select">
                <option value="incomplete"> InComplete</option>
                <option value="complete">Complete</option>
            </select>
            @error('is_done')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

         <div class="mb-3">
        <label for="user_id">User Name</label>
        <select name="user_id" class="form-control" >
            <option value="">Select User</option>
            @foreach($users as $user)
                <option value="{{ $user->id }}">{{ $user->name }}</option>
            @endforeach
        </select>

        </div>


        <button type="submit" class="btn btn-success">{{ __('messages.save') }}</button>
    </form>
</div>
@endsection
