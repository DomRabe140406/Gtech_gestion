<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/notification.css') }}">
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
                <a href="{{ route('logout') }}">
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
    <a href="{{ route('fiche.create') }}">Fiche Formation</a>
    <a href="{{ route('proforma.create') }}">Generation Proforma</a>
    <a href="{{ route('factures.create') }}">Generation Facture</a>
</div>

<main>
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script src="{{ asset('js/dashboard.js')}}"></script>
<script src="{{ asset('js/formulaire_ajout.js')}}"></script>
<script src="{{ asset('js/modifier.js')}}"></script>
<script>
    document.addEventListener("DOMContentLoaded", function () {
        let notif = document.getElementById("notif");

        if (notif) {
            setTimeout(() => {
                notif.style.opacity = "0";
                notif.style.transform = "translateY(-30px)";
                setTimeout(() => notif.remove(), 500);
            }, 3000); // disparaît après 3 secondes
        }
    });
</script>
</body>
</html>