<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ProfileController extends Controller
{
    public function show()
    {
        return view('profile.show', [
            'user' => auth()->user(),
        ]);
    }


    public function edit(User $user)
    {
        if (!Gate::allows('is-user', $user)) {
            abort(404);
        }

        dd('edit');
    }


    public function update(Request $request, User $user)
    {
        //
    }
}
