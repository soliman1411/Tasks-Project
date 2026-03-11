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

    public function showUserTasks(Request $request, User $user)
{
    $tasks = $user->tasks()
        ->when($request->search, function($query, $search) {
            $query->where('title', 'like', '%' . $search . '%');
        })
        ->latest()
        ->paginate(10);

    return view('admin.user-tasks', compact('user', 'tasks'));
}


    public function showNotification($id)
    {
        $notification = Auth::user()->notifications()->findOrFail($id);

        if (is_null($notification->read_at)) {
            $notification->markAsRead();
        }

        return view('admin.oneNotification', compact('notification'));
    }






    function AllNotifications() {

        $notifications = Auth::user()->notifications()->latest()->get();
        return view('admin.notification',compact('notifications'));
    }

}


