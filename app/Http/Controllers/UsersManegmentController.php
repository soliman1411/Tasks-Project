<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;

class UsersManegmentController extends Controller
{
    public function index()
    {
        if (request()->has('search')) {
            $users = User::where(function($query) {
                $query->where('name', 'like', '%'.request()->search.'%')
                      ->orWhere('email', 'like', '%'.request()->search.'%')
                      ->orWhere('phone', 'like', '%'.request()->search.'%');
            })
            ->whereDoesntHave('roles', function ($q) {
                $q->where('name', 'admin');
            })->paginate(10);
        } else {
            $users = User::whereDoesntHave('roles', function ($q) {
                $q->where('name', 'admin');
            })->paginate(10);
        }
        return view('users.index', compact('users'));
    }

    public function create()
    {
        return view('users.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'phone' => ['nullable', 'string', 'max:20', 'unique:users'],
            'birthdate' => ['nullable', 'date', 'before:today'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ]);

        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'birthdate' => $request->birthdate,
            'password' => Hash::make($request->password),
        ]);

        flash()->success('User created successfully.');
        return redirect()->route('admin.users.index');
    }

    public function edit($id)
    {
        $user = User::findOrFail($id);
        return view('users.edit', compact('user'));
    }

    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);
        
        $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users,email,' . $id],
            'phone' => ['nullable', 'string', 'max:20', 'unique:users,phone,' . $id],
            'birthdate' => ['nullable', 'date', 'before:today'],
            'password' => ['nullable', 'confirmed', Rules\Password::defaults()],
        ]);

        $updateData = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'birthdate' => $request->birthdate,
        ];

        if ($request->filled('password')) {
            $updateData['password'] = Hash::make($request->password);
        }

        User::where('id', $id)->update($updateData);

        flash()->success('User updated successfully.');
        return redirect()->route('admin.users.index');
    }

    public function destroy($id)
    {
        User::destroy($id);
        flash()->warning('User moved to trash.');
        return redirect()->route('admin.users.index');
    }

    public function trashed()
    {
        $users = User::onlyTrashed()
            ->whereDoesntHave('roles', function ($q) {
                $q->where('name', 'admin');
            })
            ->paginate(10);
        return view('users.trashed', compact('users'));
    }

    public function restore($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->restore();
        flash()->info('User restored successfully.');
        return redirect()->route('admin.users.index');
    }

    public function forceDelete($id)
    {
        $user = User::withTrashed()->findOrFail($id);
        $user->forceDelete();
        flash()->warning('User permanently deleted.');
        return redirect()->route('admin.users.index');
    }
}