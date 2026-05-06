<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<header>
    <nav class="nav_header">
        <div class="logo">
            <img src="{{ asset('img/Logo.png') }}" alt="Logo">
        </div>

        <ul>
            <li class="theme">
                <button id="theme-toggle">🌙 / ☀️</button>
            </li>

            <li class="btnheader" id="sortie">
                <a href="{{ url('/logout') }}">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>
            </li>

            <li class="btnheader" onclick="Menu()">
                <div>☰</div>
            </li>
        </ul>
    </nav>
</header>

<div id="sidebar" class="sidebar">
    <div class="closebtn" onclick="Menu()">✖️</div>

    <a href="{{ route('dashboard') }}">Dashboard</a>
    <a href="{{ route('formations.index') }}">Liste Formation</a>
    <a href="{{ route('formations.create') }}">Ajouter Formation</a>
    <a href="#">Fiche Formation</a>
    <a href="#">Generation Proforma</a>
    <a href="{{ route('factures.create') }}">Generation Facture</a>
</div>

<main>
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('js/dashboard.js')}}"></script>
<script src="{{ asset('js/formulaire_ajout.js')}}"></script>
<script src="{{ asset('js/modifier.js')}}"></script>

</body>
</html>