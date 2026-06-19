@extends('layouts.auth')

@section('title', 'Login Admin')

@section('content')

@include('layouts.notification')

<form action="{{ route ('login') }}" method="POST" class="loginForm">

    @csrf

    <img src="{{ asset('img/Logo.png') }}" alt="logo">

    <h2>Connexion Admin</h2>

    <input type="email" name="email" placeholder="Email" required>
    <div class="password-field">
        <input
            type="password"
            name="password"
            id="password"
            placeholder="Password"
            required
        >

        <!-- Icône œil -->
        <i id="eyeIcon" class="fa-solid fa-eye"></i>
    </div>

    <button type="submit">Se connecter</button>

</form>
<script>
    const password = document.getElementById('password');
    //const togglePassword = document.getElementById('togglePassword');
    const eyeIcon = document.getElementById('eyeIcon');

    eyeIcon.addEventListener('click', function () {

        if (password.type === 'password') {
            password.type = 'text';
            eyeIcon.classList.remove('fa-eye');
            eyeIcon.classList.add('fa-eye-slash');
        } else {
            password.type = 'password';
            eyeIcon.classList.remove('fa-eye-slash');
            eyeIcon.classList.add('fa-eye');
        }

    });
</script>@endsection