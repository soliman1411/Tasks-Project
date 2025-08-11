<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    function index() {

        $usersCount = User::count();
        $tasksCount = Task::count();
        $completedTasks = Task::where('is_done','complete')->count();
        $inCompletedTasks = Task::where('is_done','incomplete')->count();
        return view('admin.dashboard',
        compact('usersCount' , 'tasksCount'
        ,'completedTasks','inCompletedTasks'));
    }

    function showTasks(Request $request) {

      if ($request->search) {
        $tasks = Task::where('title','like','%'.$request->search.'%')
        ->where('user_id', Auth::id())
        ->paginate(10);

        } else {

            $tasks = Task::where('user_id', Auth::id())->paginate(10);
        }

        return view('users.showTasks',compact('tasks'));
    }


}


