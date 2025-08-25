<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Notifications\UserCreatedTask;
use App\Notifications\UserDeletedTask;
use App\Notifications\UserUpdatedTask;

class TasksController extends Controller
{
     /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->search) {
        $tasks = Task::where('title','like','%'.$request->search.'%')
        ->where('user_id', Auth::id())
        ->paginate(10);

        } else {

            $tasks = Task::where('user_id', Auth::id())->paginate(10);
        }


        return view('tasks.index',compact('tasks'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('tasks.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'description' => 'required',
    ], [
        'title.required' => 'title is required',
        'description.required' => 'description is required',
    ]);

  $task = Auth::user()->tasks()->create([
    'title' => $request->title,
    'description' => $request->description,
    'is_done' => $request->is_done,
]);
    $admin = User::where('is_admin',true)->first();
    $admin->notify(new UserCreatedTask(Auth::user(),$task));
            flash()->success('Task created.');
    return redirect()->route('tasks.index');
}

    /**
     * Display the specified resource.
     */


    /**
     * Show the form for editing the specified resource.
     */
        public function edit($id)
        {
            $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
            return view('tasks.edit', compact('task'));
        }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
        'title'=>'required',
        'description'=>'required',
        ],[
        'title.required'=>'title is required',
        'description.required'=>'description is required',

        ]);

        $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();

        $task->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'is_done'=>$request->is_done,
        ]);
        $admin = User::where('is_admin',true)->first();
    $admin->notify(new UserUpdatedTask(Auth::user(),$task));
            flash()->success('Task updated.');
        return redirect()->route('tasks.index');

    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
{
    $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
    $task->delete();

    $admin = User::where('is_admin',true)->first();
    $admin->notify(new UserDeletedTask(Auth::user(),$task));
            flash()->warning('Task deleted.');
    return redirect()->route('tasks.index');
}
   public function trashed()
{
    $tasks = Task::onlyTrashed()->get();
    return view('tasks.trashed', compact('tasks'));
}

       public function restore($id)
{
    $task = Task::withTrashed()->findOrFail($id);
    $task->restore();
            flash()->info('Task restored.');
    return redirect()->route('tasks.index');
}
}
