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
            \App\Helpers\AdminHistory::add("Connexion au système");//ajout d'une ligne dans l'historique de l'admin
            return redirect('/dashboard')->with('success', 'Bienvenue Admin');
        }

        return back()->with('error', 'Identifiants incorrects');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/login')
            ->with('success', 'Déconnexion réussie');
    }
}


