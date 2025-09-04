@extends('layouts.admin')

@section('content')
<div class="container">

    <h2 class="mb-4"> Updating User</h2>
    <form action="{{ route('usersManegment.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">User Name </label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" >

        @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">User Email </label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" >

        @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">User Password </label>
            <input type="password" name="password" class="form-control" value="{{ $user->password }}" >

        @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">+ {{ __('messages.update') }}</button>
    </form>
</div>
@endsection
