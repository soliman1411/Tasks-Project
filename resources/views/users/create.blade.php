@extends('layouts.admin')
@section('content')
<div class="container">
    <h2 class="mb-4">  Create New User</h2>
    <form action="{{ route('usersManegment.store') }}" method="POST">
        @csrf
       <div class="mb-3">
    <label class="form-label">User Name</label>
    <input type="text" name="name" class="form-control" value="{{ old('name')}}">
    @error('name')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">User Email</label>
    <input type="email" name="email" class="form-control" value="{{old('email')}}">
    @error('email')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>

<div class="mb-3">
    <label class="form-label">User Password</label>
    <input type="password" name="password" class="form-control">
    @error('password')
        <div class="alert alert-danger">{{ $message }}</div>
    @enderror
</div>
        <button type="submit" class="btn btn-success">Save</button>
    </form>
</div>
@endsection
