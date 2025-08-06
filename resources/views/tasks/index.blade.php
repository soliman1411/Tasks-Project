@extends('layouts.app')

@section('content')
<div class="container">
     @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                @endif
    <h2 class="mb-4"> All Tasks</h2>

        <form action="{{route('tasks.index')}}" method="get" class="form-control">
    <input type="text" name="search" id="search" value="{{request()->search}}">
    <button type="submit" class="btn btn-primary">Search</button>
</form>


    <a href="{{ route('tasks.create') }}" class="btn btn-primary mb-3">+  Create New Task</a>

     <table class="table">
        <thead>
          <tr>
            <th scope="col">ID</th>
            <th scope="col">Title</th>
            <th scope="col">Description</th>
            <th scope="col">Is_Done</th>


          </tr>
        </thead>

        <tbody>
          @foreach ($tasks as $task)
             <tr>
                <th scope="row">{{$task->id}}</th>
                <td>{{$task->title}}</td>
                <td>{{$task->description}}</td>
                <td>{{$task->is_done}}</td>

                <td>
                <a class="btn btn-primary" href="{{route('tasks.edit',$task->id)}}" role="button" style="display: inline;">Edit</a>
                <form action="{{ route('tasks.destroy',$task->id)}}" method="post"
                    onsubmit="return confirm('Are You Delete Of Task')" >
                    @csrf
                    @method('DELETE')
                    <button class="btn btn-danger" type="submit" style="display: inline;">Delete</button>
                </form>
                </td>

              </tr>
          @endforeach
        </tbody>
      </table>
{{$tasks->appends($_GET)->links()}}
@endsection


