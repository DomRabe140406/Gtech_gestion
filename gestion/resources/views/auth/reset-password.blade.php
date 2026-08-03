@extends('layouts.auth')
@section('title', 'Réinitialiser le mot de passe')
@section('content')

<div class="login-page">

    <div class="background-circle circle1"></div>
    <div class="background-circle circle2"></div>

    <div class="login-card">

        <div class="logo">
            <img src="{{ asset('img/Logo.png') }}" alt="Logo">
        </div>

        <h1>Nouveau mot de passe</h1>

        <p class="subtitle">
            Choisis un nouveau mot de passe sécurisé.
        </p>

        <form action="{{ route('password.update') }}" method="POST">

            @csrf

            <input type="hidden" name="token" value="{{ $token }}">

            <div class="input-group">

                <label for="email">Email:</label>

                <div class="input-box">
                    <i class="fa-regular fa-envelope"></i>
                    <input id="email" type="email" name="email" value="{{ old('email', $email) }}" required>
                </div>

                @error('email')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

            </div>

            <div class="input-group">

                <label for="password">Nouveau mot de passe:</label>

                <div class="input-box">
                    <i class="fa-solid fa-lock"></i>
                    <input id="password" type="password" name="password" placeholder="************" required>
                    <button type="button" id="togglePassword">
                        <i id="eyeIcon" class="fa-solid fa-eye"></i>
                    </button>
                </div>

                @error('password')
                    <p class="text-red-500 text-sm mt-2">{{ $message }}</p>
                @enderror

            </div>

            <div class="input-group">

                <label for="password_confirmation">Confirmer le mot de passe:</label>

                <div class="input-box">
                    <i class="fa-solid fa-lock"></i>
                    <input id="password_confirmation" type="password" name="password_confirmation" placeholder="************" required>
                    <button type="button" id="togglePassword">
                        <i id="eyeIcon" class="fa-solid fa-eye"></i>
                    </button>
                </div>

            </div>

            <button type="submit" class="login-btn">
                Réinitialiser le mot de passe
                <i class="fa-solid fa-check"></i>
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
    const password = document.getElementById('password');
    const toggle = document.getElementById('togglePassword');
    const eye = document.getElementById('eyeIcon');

    toggle.addEventListener('click', () => {
        if (password.type === "password") {
            password.type = "text";
            eye.classList.replace("fa-eye", "fa-eye-slash");
        } else {
            password.type = "password";
            eye.classList.replace("fa-eye-slash", "fa-eye");
        }
    });
</script>

@endsection