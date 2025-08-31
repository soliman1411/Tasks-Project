<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersManegmentController extends Controller
{
    public function index()  {
    if (request()->has('search')) {
        $users  = User::where('name','like', '%'.request()->search.'%')
        ->whereDoesntHave('roles', function ($q) {
    $q->where('name', 'admin');
})->paginate(10);

    } else {
$users = User::whereDoesntHave('roles', function ($q) {
    $q->where('name', 'admin');
})->paginate(10);    }
    return view('users.index',compact('users'));
    }

    public function create()  {
        return view('users.create');
    }


    public  function store(Request $request)  {

        User::create([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>$request->password,


        ]);
            flash()->success('user created.');
        return redirect()->route('usersManegment.index');

    }

    public  function edit($id)  {
     $user = User::findOrFail($id);
        return view('users.edit',compact('user'));
    }

    public  function update(Request $request , $id)  {

        User::where('id',$id)->update([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),

        ]);

            flash()->success('user updated.');
            return redirect()->route('usersManegment.index');

    }

    public  function destroy($id)  {
        User::destroy($id);
            flash()->warning('user delete.');
        return redirect()->route('usersManegment.index');
    }

     public function trashed()
{
    $users = User::onlyTrashed()->get();
    return view('users.trashed', compact('users'));
}

     public function restore($id)
{
    $user = User::withTrashed()->findOrFail($id);
    $user->restore();
            flash()->info('user restored.');
    return redirect()->route('usersManegment.index');
}

     public function forceDelete($id)
{
    $User = User::withTrashed()->findOrFail($id);
    $User->forceDelete();
            flash()->warning('user forceDelete.');
    return redirect()->route('usersManegment.index');
}




}
