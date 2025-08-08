<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;

class AdminController extends Controller
{
    function index() {

        $usersCount = User::count();
        $tasksCount = Task::count();
        $completedTasks = Task::where('is_done','complete')->count();
        return view('admin.dashboard',compact('usersCount' , 'tasksCount' ,'completedTasks'));
    }



}


