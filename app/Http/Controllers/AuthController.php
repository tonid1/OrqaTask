<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class AuthController extends Controller
{
    public function register(Request $request){
        $fields = $request->validate([
            'name' => ['required', 'string', 'min:3', 'unique:users,name'],
            'email' => ['required', 'email', 'unique:users,email'],
            'password' => ['required', 'min:8']
        ], [
            'name.unique' => 'That username is already taken.',
            'email.unique' => 'An account with this email already exists.',
            'password.min' => 'Password must be at least 8 characters.',
        ]);

        $fields['password'] = bcrypt($fields['password']);
        $fields['role'] = 'user';

        $user = User::create($fields);
        auth()->login($user);

        return redirect('/');
    }

    public function login(Request $request){
        $fields = $request->validate([
            'name' => 'required',
            'password' => 'required'
        ]);

        if(auth()->attempt([
            'name' => $fields['name'], 
            'password' => $fields['password']
        ])) {
            $request->session()->regenerate();
            return redirect('/');
        }

        return back()
        ->withErrors(['name' => 'Wrong username or password.']);
    }

    public function logout(){
        auth()->logout();

        return redirect('/');
    }
}
