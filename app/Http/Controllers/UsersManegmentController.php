<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UsersManegmentController extends Controller
{
    public function index()  {
    if (request()->has('search')) {
        $users  = User::where('name','like', '%'.request()->search.'%')->paginate(10);
    } else {
        $users = User::paginate(10);
    }
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

        return redirect()->route('usersManegment.index')->with('success','user created');

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


            return redirect()->route('usersManegment.index')->with('success','user updated');

    }

    public  function destroy($id)  {
        User::destroy($id);
        return redirect()->route('usersManegment.index')->with('success','user deleted');
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

    return redirect()->route('usersManegment.index')->with('success', 'User restored.');
}

     public function forceDelete($id)
{
    $User = User::withTrashed()->findOrFail($id);
    $User->forceDelete();

    return redirect()->route('usersManegment.index')->with('success', 'User force deleted.');
}




}
