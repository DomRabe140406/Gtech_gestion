@extends('layouts.auth')

@section('title', 'Connexion Admin')

@section('content')

@include('layouts.notification')

<div class="login-page">

    <div class="background-circle circle1"></div>
    <div class="background-circle circle2"></div>

    <div class="login-card">

        <div class="logo">
            <img src="{{ asset('img/Logo.png') }}" alt="Logo">
        </div>

        <h1>Connexion Admin</h1>

        <p class="subtitle">
            Veuillez saisir vos identifiants pour accéder au tableau de bord.
        </p>

        <form action="{{ route('login') }}" method="POST">

            @csrf

            <div class="input-group">

                <label for="email">Email:</label>

                <div class="input-box">

                    <i class="fa-regular fa-envelope"></i>

                    <input
                        id="email"
                        type="email"
                        name="email"
                        placeholder="admin@example.com"
                        value="{{ old('email') }}"
                        required>

                </div>

            </div>

            <div class="input-group">

                <label for="password">Mot de passe:</label>

                <div class="input-box">

                    <i class="fa-solid fa-lock"></i>

                    <input
                        id="password"
                        type="password"
                        name="password"
                        placeholder="************"
                        required>

                    <button
                        type="button"
                        id="togglePassword">

                        <i id="eyeIcon" class="fa-solid fa-eye"></i>

                    </button>

                </div>

            </div>

            <button class="login-btn">

                Se connecter

                <i class="fa-solid fa-arrow-right"></i>

            </button>

        </form>

        <div class="footer">

            <div class="separator">

                <span>
                    <i class="fa-solid fa-shield"></i>
                </span>

            </div>

            <p>
                Accès sécurisé réservé aux administrateurs
            </p>

        </div>

    </div>

</div>

<script>

const password=document.getElementById('password');
const toggle=document.getElementById('togglePassword');
const eye=document.getElementById('eyeIcon');

toggle.addEventListener('click',()=>{

    if(password.type==="password"){

        password.type="text";

        eye.classList.replace("fa-eye","fa-eye-slash");

    }else{

        password.type="password";

        eye.classList.replace("fa-eye-slash","fa-eye");

    }

});

</script>

@endsection