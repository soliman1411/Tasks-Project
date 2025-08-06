<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ToDoController extends Controller
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

  Auth::user()->tasks()->create([
    'title' => $request->title,
    'description' => $request->description,
    'is_done' => $request->is_done,
]);

    return redirect()->route('tasks.index')->with('success', 'Task created.');
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

        return redirect()->route('tasks.index')->with('success','Task updated.');

    }

    /**
     * Remove the specified resource from storage.
     */
   public function destroy($id)
{
    $task = Task::where('id', $id)->where('user_id', Auth::id())->firstOrFail();
    $task->delete();

    return redirect()->route('tasks.index')->with('success', 'Task deleted.');
}
}
