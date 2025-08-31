<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TasksManegmentController extends Controller
{
   /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        if ($request->search) {
        $tasks = Task::with('user')->where('title','like','%'.$request->search.'%')->paginate(10);
        } else {

            $tasks = Task::with('user')->paginate(10);
        }

        return view('tasksManegment.index',compact('tasks'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $users = User::whereDoesntHave('roles', function ($q) {
    $q->where('name', 'admin');
})->get();
        return view('tasksManegment.create',compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'description' => 'required',
        'user_id' => 'required',
    ]);

  Task::create([
    'title' => $request->title,
    'description' => $request->description,
    'is_done' => $request->is_done,
    'user_id' => $request->user_id,
]);
    flash()->success('Task created.');
    return redirect()->route('tasksManegment.index');
}


        public function edit($id)
        {
              $users = User::whereDoesntHave('roles', function ($q) {
    $q->where('name', 'admin');
})->get();
            $task = Task::findOrFail($id);
            return view('tasksManegment.edit', compact('task','users'));
        }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $request->validate([
        'title'=>'required',
        'description'=>'required',
        ]);

        $task = Task::findOrFail($id);

        $task->update([
            'title'=>$request->title,
            'description'=>$request->description,
            'is_done'=>$request->is_done,
            'user_id' => $request->user_id,
        ]);
            flash()->success('Task updated.');

        return redirect()->route('tasksManegment.index');

    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
{
    $task = Task::destroy($id);

    flash()->warning('Task Deleted.');

    return redirect()->route('tasksManegment.index');
}
     public function trashed()
{
    $tasks = Task::onlyTrashed()->get();
    return view('tasksManegment.trashed', compact('tasks'));
}

     public function restore($id)
{
    $task = Task::withTrashed()->findOrFail($id);
    $task->restore();
    flash()->info('Task restored.');

    return redirect()->route('tasksManegment.index');
}

     public function forceDelete($id)
{
    $task = Task::withTrashed()->findOrFail($id);
    $task->forceDelete();
    flash()->warning('Task forceDeleted.');

    return redirect()->route('tasksManegment.index');
}

}
