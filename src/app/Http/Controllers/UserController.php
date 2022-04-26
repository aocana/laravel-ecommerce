<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\User\UserUpdateRequest;
use App\Http\Requests\User\PasswordUpdateRequest;

class UserController extends Controller
{
    public function index()
    {
        return view('profile.index', [
            'user' => auth()->user(),
        ]);
    }

    public function edit(User $user)
    {
        if (!Gate::allows('is-user', $user)) {
            abort(404);
        }

        return view('profile.edit', compact('user'));
    }

    public function update(UserUpdateRequest $request, User $user)
    {
        $user->update($request->validated());
        return to_route('profile.index')->with('succes', 'Profile updated');
    }


    public function changePassword()
    {
        return view('auth.change-password');
    }

    public function newPassword(PasswordUpdateRequest $request): RedirectResponse
    {
        $request->validated();
        $request->authenticate();
        User::whereId(auth()->user()->id)->update([
            'password' => Hash::make($request->newPassword),
        ]);

        return to_route('profile.index')->with('success', 'Password changed');
    }
}
