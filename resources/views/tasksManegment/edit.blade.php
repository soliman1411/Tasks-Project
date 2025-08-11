@extends('layouts.admin')

@section('content')
<div class="container">

    <h2 class="mb-4"> Updating Task</h2>
    <form action="{{ route('tasksManegment.update', $task->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label class="form-label">Task Title </label>
            <input type="text" name="title" class="form-control" value="{{ $task->title }}" >

        @error('title')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Task Description </label>

            <textarea name="description" class="form-control" rows="4" >{{ $task->description }}</textarea>
            @error('description')
                <div class="alert alert-danger">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label class="form-label">Task Status</label>
            <select name="is_done" class="form-select">
                <option value="incomplete" @selected(old('is_done') == "incomplete")>InComplete</option>
                <option value="complete" @selected(old('is_done') == "complete")>Complete</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Update</button>
    </form>
</div>
@endsection
