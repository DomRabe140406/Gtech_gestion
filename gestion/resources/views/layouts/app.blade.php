<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/notification.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body>

<header>
    <!--
    <nav class="nav_header">
        <div class="logo">
            <img src="{{ asset('img/Logo.png') }}" alt="Logo">
        </div>

        <ul>
            <li class="btnheader" id="sortie">
                <a href="{{ route('logout') }}">
                    <i class="fa-solid fa-right-from-bracket"></i>
                </a>
            </li>

            <li class="btnheader" onclick="Menu()">
                <div><i class="fa-solid fa-bars"></i></div>
            </li>
        </ul>
    </nav>-->
    <nav class="flex justify-between items-center px-5 py-4 shadow">

        <div>
            <img src="{{ asset('img/Logo.png') }}" alt="Logo"
                class="w-28 md:w-32">
        </div>

        <ul class="flex items-center gap-4 md:gap-6">

            <li>

                <a href="{{ route('logout') }}"
                class="text-xl md:text-2xl hover:text-red-500">

                    <i class="fa-solid fa-right-from-bracket"></i>

                </a>

            </li>

            <li onclick="Menu()"
                class="text-xl md:text-2xl cursor-pointer hover:text-blue-500">

                <i class="fa-solid fa-bars"></i>

            </li>

        </ul>

    </nav>
</header>

<div id="sidebar" class="sidebar">
    <div class="closebtn" onclick="Menu()">✖️</div>

    <a href="{{ route('dashboard') }}">Dashboard</a>
    <a href="{{ route('liste.index') }}">Liste Formation</a>
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