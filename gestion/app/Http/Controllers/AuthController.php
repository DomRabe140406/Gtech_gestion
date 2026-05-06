<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{

    public function login(Request $request)
    {
        $request->validate([
             'email' => 'required|email',
            'password' => 'required'
        ]);
         if (Auth::attempt($request->only('email', 'password'))) {
        return redirect('/dashboard')->with('success', 'Bienvenue Admin');
    }

    return back()->with('error', 'Identifiants incorrects');
    }
}


