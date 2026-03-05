<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Flasher\Laravel\Facade\Flasher;

class ProfileController extends Controller
{
    /**
     * Show the profile edit form.
     */
    public function edit()
    {
        $user = Auth::user();
        return view('profile.edit', compact('user'));
    }

    /**
     * Update the user's profile information and password.
     */
    public function update(Request $request)
    {
        $user = Auth::user();

        // Validate based on what's being updated
        if ($request->has('name') || $request->has('email')) {
            $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'email' => ['required', 'string', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            ]);

            $user->name = $request->name;
            $user->email = $request->email;

            // If email changed, require verification again
            if ($user->isDirty('email')) {
                $user->email_verified_at = null;
                // You can send verification email here if needed
            }

            $user->save();

            Flasher::addSuccess(__('messages.profile_updated'));
            return back();
        }

        // If password fields are present
        if ($request->has('current_password') || $request->has('new_password') || $request->has('new_password_confirmation')) {
            $request->validate([
                'current_password' => ['required', 'current_password'],
                'new_password' => ['required', 'confirmed', Password::defaults()],
            ]);

            $user->password = Hash::make($request->new_password);
            $user->save();

            Flasher::addSuccess(__('messages.password_updated'));
            return back();
        }

        Flasher::addError('No data to update');
        return back();
    }
}
