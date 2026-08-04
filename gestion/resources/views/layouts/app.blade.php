<!DOCTYPE html>
<html>
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title')</title>
     <script>
        if (localStorage.getItem('theme') === 'dark' ||(!('theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        }
    </script>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    <link rel="stylesheet" href="{{ asset('css/header.css') }}">
    <link rel="stylesheet" href="{{ asset('css/dashboard.css') }}">
    <link rel="stylesheet" href="{{ asset('css/notification.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css">
</head>

<body  class="bg-gray-50 dark:bg-gray-900 text-gray-800 dark:text-gray-100 transition-colors duration-300">

<header class="bg-white dark:bg-gray-800 border-b border-gray-200 dark:border-gray-700 transition-colors duration-300 sticky top-0 z-40">
    <nav class="flex justify-between items-center px-5 md:px-8 py-3">

        <div>
            <!-- Logo mode clair -->
            <img
                src="{{ asset('img/Logo.png') }}"
                alt="Logo"
                class="w-28 md:w-32 block dark:hidden">

            <!-- Logo mode sombre -->
            <img
                src="{{ asset('img/Logo-dark.png') }}"
                alt="Logo"
                class="w-28 md:w-32 hidden dark:block">
        </div>
        
        <!-- Notification -->
        <ul class="flex items-center gap-3 md:gap-5">
            <li class="relative">
                <button id="notifToggle"
                        class="w-10 h-10 flex items-center justify-center rounded-full hover:bg-gray-100 dark:hover:bg-gray-700
                        transition-colors duration-300 relative">
                        <i class="fa-solid fa-bell text-gray-600 dark:text-gray-300 text-lg"></i>

                        @if(count($headerAlerts ?? []) > 0)
                            <span class="absolute top-1.5 right-1.5 w-4 h-4 bg-red-500 text-white text-[10px]
                                        rounded-full flex items-center justify-center font-bold">
                                {{ count($headerAlerts) }}
                            </span>
                        @endif
                </button>

                <!-- Interieur de la notification -->
                <div id="notifDropdown"
                    class="hidden absolute right-0 mt-2 w-80 bg-white dark:bg-gray-800 rounded-2xl shadow-2xl border border-gray-200 dark:border-gray-700
                            max-h-96 overflow-y-auto z-50">

                    <div class="p-4 border-b border-gray-100 dark:border-gray-700">
                        <p class="font-semibold text-gray-700 dark:text-gray-200">Notifications</p>
                    </div>

                    @forelse($headerAlerts ?? [] as $alerte)
                        <a href="{{ $alerte['lien'] }}"
                            class="flex items-start gap-3 p-4 border-b border-gray-50 dark:border-gray-700/50 hover:bg-gray-50 dark:hover:bg-gray-700/50 transition-colors">

                            <div class="w-8 h-8 rounded-full flex items-center justify-center flex-shrink-0
                                        {{ $alerte['type'] === 'danger' ? 'bg-red-100 dark:bg-red-900/40' : '' }}
                                        {{ $alerte['type'] === 'warning' ? 'bg-orange-100 dark:bg-orange-900/40' : '' }}
                                        {{ $alerte['type'] === 'info' ? 'bg-blue-100 dark:bg-blue-900/40' : '' }}">
                                <i class="fa-solid {{ $alerte['icon'] }} text-xs
                                        {{ $alerte['type'] === 'danger' ? 'text-red-600 dark:text-red-400' : '' }}
                                        {{ $alerte['type'] === 'warning' ? 'text-orange-600 dark:text-orange-400' : '' }}
                                        {{ $alerte['type'] === 'info' ? 'text-blue-600 dark:text-blue-400' : '' }}"></i>
                            </div>

                            <p class="text-sm text-gray-600 dark:text-gray-300">
                                {{ $alerte['message'] }}
                            </p>

                        </a>
                    @empty
                        <p class="p-6 text-center text-sm text-gray-400 dark:text-gray-500">
                            Aucune alerte pour le moment.
                        </p>
                    @endforelse

                </div>
            </li>

            <!-- bouton theme sombre et clair -->
            <li>
                <button id="themeToggle" class="w-10 h-10 flex items-center 
                        justify-center rounded-full hover:bg-gray-100 dark:hover:bg-gray-700 transition-colors duration-300" title="Changer de thème">
                    <i id="iconSun" class="fa-solid fa-sun text-yellow-500 hidden dark:inline text-lg"></i>
                    <i id="iconMoon" class="fa-solid fa-moon text-gray-600 dark:hidden text-lg"></i>
                </button>
            </li>

            <!-- Nom de l'admin avec font  -->
            <li>
                <div class="flex items-center gap-2 pl-2 pr-3 py-1.5 rounded-full border border-gray-200 dark:border-gray-600 bg-gray-50 dark:bg-gray-700/50
                            hover:shadow-md transition-shadow duration-300">
                    <span class="w-8 h-8 flex items-center justify-center rounded-full bg-blue-100 dark:bg-blue-900/40 text-blue-600 dark:text-blue-400">
                        <i class="fas fa-user text-sm"></i>
                    </span>
                    <span class="font-medium text-sm text-gray-700 dark:text-gray-200 hidden sm:inline">
                        {{ Auth::user()->name }}
                    </span>
                </div>
            </li>
            
            <!-- bouton de deconnexion -->
            <li>
                <a href="{{ route('logout') }}" title="Se déconnecter"
                   class="w-10 h-10 flex items-center justify-center rounded-full text-gray-600 dark:text-gray-300
                          hover:bg-red-50 dark:hover:bg-red-900/30 hover:text-red-500 transition-colors duration-300">
                    <i class="fa-solid fa-right-from-bracket text-lg"></i>
                </a>
            </li>

            <!-- Bouton burger pour sidebar -->
            <li onclick="Menu()"
                class="w-10 h-10 flex items-center justify-center rounded-full cursor-pointer text-gray-600 dark:text-gray-300
                       hover:bg-blue-50 dark:hover:bg-blue-900/30 hover:text-blue-500 transition-colors duration-300">
                <i class="fa-solid fa-bars text-lg"></i>
            </li>

        </ul>
    </nav>
</header>

<div id="sidebarOverlay" onclick="Menu()" class="fixed inset-0  z-40 hidden "></div>

<!-- Sidebar -->
<div id="sidebar" class="fixed top-0 left-0 h-full w-72 bg-gray-900 dark:bg-gray-950 text-gray-300 z-50 shadow-2xl
                  transform -translate-x-full transition-transform duration-300 ease-in-out pt-6 overflow-y-auto">

    <!-- Bouton fermer -->
    <div onclick="Menu()"
         class="absolute top-5 right-4 w-9 h-9 flex items-center justify-center rounded-full text-gray-400 hover:bg-red-500/15 hover:text-red-400
                cursor-pointer transition-colors duration-200">
        <i class="fa-solid fa-xmark text-lg"></i>
    </div>

    <div class="px-6 pb-6 mb-2 border-b border-gray-700">
        <span class="text-white font-semibold text-lg">GASY TECH</span>
    </div>

    <nav class="flex flex-col px-3">

        <a href="{{ route('dashboard') }}"
           class="flex items-center gap-3 px-4 py-3 mx-1 my-0.5 rounded-lg hover:bg-blue-500/15 hover:text-white transition-colors duration-200">
            <i class="fa-solid fa-chart-line w-5 text-center text-gray-500"></i>
            Dashboard
        </a>

        <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 px-4 mt-6 mb-2">
            Gestion
        </p>

        <a href="{{ route('liste.index') }}"
           class="flex items-center gap-3 px-4 py-3 mx-1 my-0.5 rounded-lg hover:bg-blue-500/15 hover:text-white transition-colors duration-200">
            <i class="fa-solid fa-graduation-cap w-5 text-center text-gray-500"></i>
            Liste Formation
        </a>

        <a href="{{ route('formateurs.index') }}"
           class="flex items-center gap-3 px-4 py-3 mx-1 my-0.5 rounded-lg hover:bg-blue-500/15 hover:text-white transition-colors duration-200">
            <i class="fa-solid fa-users w-5 text-center text-gray-500"></i>
            Liste des Formateurs
        </a>

        <p class="text-xs font-semibold uppercase tracking-wider text-gray-500 px-4 mt-6 mb-2">
            Génération PDF
        </p>

        <a href="{{ route('fiche.create') }}"
           class="flex items-center gap-3 px-4 py-3 mx-1 my-0.5 rounded-lg hover:bg-blue-500/15 hover:text-white transition-colors duration-200">
            <i class="fa-solid fa-file-lines w-5 text-center text-gray-500"></i>
            Fiche Formation
        </a>

        <a href="{{ route('proforma.create') }}"
           class="flex items-center gap-3 px-4 py-3 mx-1 my-0.5 rounded-lg hover:bg-blue-500/15 hover:text-white transition-colors duration-200">
            <i class="fa-solid fa-file-invoice w-5 text-center text-gray-500"></i>
            Génération Proforma
        </a>

        <a href="{{ route('factures.create') }}"
           class="flex items-center gap-3 px-4 py-3 mx-1 my-0.5 rounded-lg hover:bg-blue-500/15 hover:text-white transition-colors duration-200">
            <i class="fa-solid fa-file-invoice-dollar w-5 text-center text-gray-500"></i>
            Génération Facture
        </a>

    </nav>
    <div class="border-t border-gray-700 mt-6 pt-3">
        <a href="{{ route('profil.edit') }}"
           class="flex items-center gap-3 px-4 py-3 mx-1 my-0.5 rounded-lg hover:bg-blue-500/15 hover:text-white transition-colors duration-200">
            <i class="fa-solid fa-user-gear w-5 text-center text-gray-500"></i>
            Paramètres du compte
        </a>
    </div>

</div>

<main>
    @yield('content')
</main>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script src="{{ asset('js/dashboard.js')}}"></script>
<script src="{{ asset('js/formulaire_ajout.js')}}"></script>
<script src="{{ asset('js/modifier.js')}}"></script>
<script src="{{ asset('js/validation.js') }}"></script>
<script src="{{ asset('js/formateur.js') }}"></script>
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

    document.getElementById('themeToggle')?.addEventListener('click', function () {
    document.documentElement.classList.toggle('dark');
    localStorage.setItem(
        'theme',
        document.documentElement.classList.contains('dark') ? 'dark' : 'light'
        );
    });


    document.getElementById('notifToggle')?.addEventListener('click', function (e) {
    e.stopPropagation();
    document.getElementById('notifDropdown')?.classList.toggle('hidden');
});

document.addEventListener('click', function (e) {
    const dropdown = document.getElementById('notifDropdown');
    const toggle = document.getElementById('notifToggle');
    if (dropdown && !dropdown.contains(e.target) && !toggle.contains(e.target)) {
        dropdown.classList.add('hidden');
    }
});
</script>
@yield('scripts')

</body>
</html>