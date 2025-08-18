<?php

namespace App\Http\Controllers;

use App\Models\Task;
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
        return view('tasksManegment.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    $request->validate([
        'title' => 'required',
        'description' => 'required',
    ]);

  Auth::user()->tasks()->create([
    'title' => $request->title,
    'description' => $request->description,
    'is_done' => $request->is_done,
]);

    return redirect()->route('tasksManegment.index')->with('success', 'Task created.');
}


        public function edit($id)
        {
            $task = Task::findOrFail($id);
            return view('tasksManegment.edit', compact('task'));
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
        ]);

        return redirect()->route('tasksManegment.index')->with('success','Task updated.');

    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
{
    $task = Task::destroy($id);

    return redirect()->route('tasksManegment.index')->with('success', 'Task deleted.');
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

    return redirect()->route('tasks.index')->with('success', 'tasks restored.');
}

     public function forceDelete($id)
{
    $task = Task::withTrashed()->findOrFail($id);
    $task->forceDelete();

    return redirect()->route('tasks.index')->with('success', 'tasks force deleted.');
}

}
