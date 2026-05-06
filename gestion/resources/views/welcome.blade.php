@extends('layouts.auth')

@section('title', 'Login Admin')

@section('content')

<form action="{{ route ('login') }}" method="POST" class="loginForm">

    @csrf

    <img src="{{ asset('img/Logo.png') }}" alt="logo">

    <h2>Connexion Admin</h2>

    <input type="email" name="email" placeholder="Email" required><br><br>

    <input type="password" name="password" placeholder="Password" required><br><br>

    <button type="submit">Se connecter</button>

</form>

@endsection