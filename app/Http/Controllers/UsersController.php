<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UsersController extends Controller
{
    public function index (User $user) {
        if (auth()->user()->id !== $user['id']) {
            return redirect('/');
        }

        return view('pages.profile', ['user' => $user]);
    }

    public function updateUser (User $user, Request $request) {
        if (auth()->user()->id !== $user['id']) {
            return redirect('/');
        }

        $fields = $request->validate([
            'name' => ['required', 'string', 'min:3'],
            'email' => ['required', 'email'],
        ]);

        $user->update($fields);

        return back();
    }
}
