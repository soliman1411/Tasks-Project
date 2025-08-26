<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show() {
        $user = Auth::user();
        return view('profile.profile',compact('user'));
    }


     public function update_profile(Request $request , $id)  {

        User::where('id',$id)->update([
        'name'=>$request->name,
        'email'=>$request->email,
        'password'=>Hash::make($request->password),

        ]);

            flash()->success('profile updated.');
            return redirect()->route('tasks.index');
}
}