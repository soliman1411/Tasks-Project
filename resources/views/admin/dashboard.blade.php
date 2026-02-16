@extends('layouts.admin')

@section('title', __('messages.Dashboard'))

@section('content')
    <div class="row">
        <!-- Users Count -->
        <div class="col-md-4">
            <div class="card text-white bg-primary mb-3 shadow">
                <div class="card-header"> {{ __('messages.totalUsers') }}</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $usersCount ?? 0}}</h5>
                </div>
            </div>
        </div>

        <!--  Tasks Count-->
        <div class="col-md-4">
            <div class="card text-white bg-success mb-3 shadow">
                <div class="card-header"> {{ __('messages.totalTasks') }}</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $tasksCount ?? 0}}</h5>
                </div>
            </div>
        </div>

        <!-- complete Tasks -->
        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3 shadow">
                <div class="card-header"> {{ __('messages.completedTasks') }}</div>
                <div class="card-body">
                    <h5 class="card-title">{{ $completedTasks ?? 0}}</h5>
                </div>
            </div>
        </div>
        <!-- incomplete Tasks -->
        <div class="col-md-4">
            <div class="card text-white bg-danger mb-3 shadow">
                <div class="card-header">{{ __('messages.inCompletedTasks') }} </div>
                <div class="card-body">
                    <h5 class="card-title">{{ $inCompletedTasks ?? 0}}</h5>
                </div>
            </div>
        </div>
    </div>
@endsection
