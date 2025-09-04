@extends('layouts.app')

@section('content')
<div class="container">

    <h2 class="mb-4">{{ __('messages.update') }} {{ __('messages.Profile') }}</h2>
    <form action="{{ route('profile.update', $user->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">{{ __('messages.name') }}</label>
            <input type="text" name="name" class="form-control" value="{{ $user->name }}" >

        @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">{{ __('messages.email') }}</label>
            <input type="email" name="email" class="form-control" value="{{ $user->email }}" >

        @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label class="form-label">{{ __('messages.password') }} </label>
            <input type="password" name="password" class="form-control" >

        @error('password')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-success">{{ __('messages.update') }} {{ __('messages.Profile') }}</button>
    </form>
</div>
@endsection
