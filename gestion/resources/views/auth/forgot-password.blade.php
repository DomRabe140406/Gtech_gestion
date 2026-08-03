@extends('layouts.auth')
@section('title', 'Mot de passe oublié')
@section('content')

//formulaire quand on clique sur mdp oublier
<div class="login-page">

    <div class="background-circle circle1"></div>
    <div class="background-circle circle2"></div>

    <div class="login-card">

        <div class="logo">
            <img src="{{ asset('img/Logo.png') }}" alt="Logo">
        </div>

        <h1>Mot de passe oublié</h1>

        <p class="subtitle">
            Entre ton email, on t'enverra un lien de réinitialisation.
        </p>

        @if(session('success'))
            <div class="mb-7 -mt-4 p-4 rounded-2xl bg-emerald-50 text-emerald-700 border border-emerald-200 text-sm">
                {{ session('success') }}
            </div>
        @endif

        <form action="{{ route('password.email') }}" method="POST">

            @csrf

            <div class="input-group">

                <label for="email">Email:</label>

                <div class="input-box">
                    <i class="fa-regular fa-envelope"></i>
                    <input id="email" type="email" name="email" placeholder="admin@example.com" value="{{ old('email') }}" required>
                </div>

                @error('email')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

            </div>

            <button type="submit" class="login-btn">
                Envoyer le lien
                <i class="fa-solid fa-paper-plane"></i>
            </button>

        </form>

        <div class="footer">

            <div class="separator">
                <span>
                    <i class="fa-solid fa-arrow-left"></i>
                </span>
            </div>

            <p>
                <a href="{{ route('login') }}" class="text-indigo-600 hover:underline font-medium">
                    Retour à la connexion
                </a>
            </p>

        </div>