@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')

@include('layouts.notification')

<div class="text-center mt-8 ">

    <h1 class="text-2xl md:text-4xl font-bold text-gray-700 tracking-tight dark:text-gray-400">
        Tableau de bord administrateur
    </h1>

    <p class="mt-3 text-gray-500 text-base md:text-lg dark:text-gray-500">
        Consultez les statistiques et l'historique des activités de la plateforme.
    </p>

</div>
<div class="max-w-7xl mx-auto px-6 py-6">

    <!-- Cartes statistiques -->

    <div class="grid grid-cols-2 md:grid-cols-4 gap-6 mb-8">

            <!-- Total Formations -->
                <a href="{{ route('liste.index') }}" class="block">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl
                                hover:border-teal-300 dark:hover:border-teal-500 cursor-pointer">

                        <div class="flex items-center justify-between mb-3">
                            <i class="fas fa-graduation-cap text-teal-500 dark:text-teal-400 text-xl"></i>
                            <i class="fas fa-arrow-right text-gray-300 dark:text-gray-600 text-sm"></i>
                        </div>

                        <p class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                            {{ $total ?? 0 }}
                        </p>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Formations
                        </p>

                        @if($ecartFormations > 0)
                            <p class="text-xs text-green-600 dark:text-green-400 mt-2 flex items-center gap-1">
                                <i class="fas fa-arrow-up"></i> +{{ $ecartFormations }} vs mois dernier
                            </p>
                        @elseif($ecartFormations < 0)
                            <p class="text-xs text-red-500 dark:text-red-400 mt-2 flex items-center gap-1">
                                <i class="fas fa-arrow-down"></i> {{ $ecartFormations }} vs mois dernier
                            </p>
                        @else
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-2">
                                Stable vs mois dernier
                            </p>
                        @endif

                    </div>
                </a>

            <!-- Formateurs -->
                <a href="{{ route('formateurs.index') }}" class="block">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl
                                hover:border-blue-300 dark:hover:border-blue-500 cursor-pointer">

                        <div class="flex items-center justify-between mb-3">
                            <i class="fas fa-chalkboard-teacher text-blue-500 dark:text-blue-400 text-xl"></i>
                            <i class="fas fa-arrow-right text-gray-300 dark:text-gray-600 text-sm"></i>
                        </div>

                        <p class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                            {{ $totalFormateurs ?? 0 }}
                        </p>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Formateurs
                        </p>

                        @if($ecartFormateurs > 0)
                            <p class="text-xs text-green-600 dark:text-green-400 mt-2 flex items-center gap-1">
                                <i class="fas fa-arrow-up"></i> +{{ $ecartFormateurs }} vs mois dernier
                            </p>
                        @elseif($ecartFormateurs < 0)
                            <p class="text-xs text-red-500 dark:text-red-400 mt-2 flex items-center gap-1">
                                <i class="fas fa-arrow-down"></i> {{ $ecartFormateurs }} vs mois dernier
                            </p>
                        @else
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-2">
                                Stable vs mois dernier
                            </p>
                        @endif

                    </div>
                </a>

            <!-- Factures -->
                <a href="{{ route('factures.create') }}" class="block">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl
                                hover:border-orange-300 dark:hover:border-orange-500 cursor-pointer">

                        <div class="flex items-center justify-between mb-3">
                            <i class="fas fa-file-invoice-dollar text-orange-500 dark:text-orange-400 text-xl"></i>
                            <i class="fas fa-arrow-right text-gray-300 dark:text-gray-600 text-sm"></i>
                        </div>

                        <p class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                            {{ $totalFactures ?? 0 }}
                        </p>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Factures téléchargées <span class="text-gray-400 dark:text-gray-500">(ce mois)</span>
                        </p>

                        @if($ecartFactures > 0)
                            <p class="text-xs text-green-600 dark:text-green-400 mt-2 flex items-center gap-1">
                                <i class="fas fa-arrow-up"></i> +{{ $ecartFactures }} vs mois dernier
                            </p>
                        @elseif($ecartFactures < 0)
                            <p class="text-xs text-red-500 dark:text-red-400 mt-2 flex items-center gap-1">
                                <i class="fas fa-arrow-down"></i> {{ $ecartFactures }} vs mois dernier
                            </p>
                        @else
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-2">
                                Stable vs mois dernier
                            </p>
                        @endif

                    </div>
                </a>

            <!-- Proforma -->
                <a href="{{ route('proforma.create') }}" class="block">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl
                                hover:border-purple-300 dark:hover:border-purple-500 cursor-pointer">

                        <div class="flex items-center justify-between mb-3">
                            <i class="fas fa-file-signature text-purple-500 dark:text-purple-400 text-xl"></i>
                            <i class="fas fa-arrow-right text-gray-300 dark:text-gray-600 text-sm"></i>
                        </div>

                        <p class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                            {{ $totalProforma ?? 0 }}
                        </p>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Proforma téléchargées <span class="text-gray-400 dark:text-gray-500">(ce mois)</span>
                        </p>

                        @if($ecartProforma > 0)
                            <p class="text-xs text-green-600 dark:text-green-400 mt-2 flex items-center gap-1">
                                <i class="fas fa-arrow-up"></i> +{{ $ecartProforma }} vs mois dernier
                            </p>
                        @elseif($ecartProforma < 0)
                            <p class="text-xs text-red-500 dark:text-red-400 mt-2 flex items-center gap-1">
                                <i class="fas fa-arrow-down"></i> {{ $ecartProforma }} vs mois dernier
                            </p>
                        @else
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-2">
                                Stable vs mois dernier
                            </p>
                        @endif

                    </div>
                </a>

            <!-- Fiches téléchargées -->
                <a href="{{ route('fiche.create') }}" class="block">
                    <div class="bg-white dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl
                                hover:border-green-300 dark:hover:border-green-500 cursor-pointer">

                        <div class="flex items-center justify-between mb-3">
                            <i class="fas fa-download text-green-500 dark:text-green-400 text-xl"></i>
                            <i class="fas fa-arrow-right text-gray-300 dark:text-gray-600 text-sm"></i>
                        </div>

                        <p class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                            {{ $totalFiches ?? 0 }}
                        </p>

                        <p class="text-sm text-gray-500 dark:text-gray-400 mt-1">
                            Fiches téléchargées <span class="text-gray-400 dark:text-gray-500">(ce mois)</span>
                        </p>

                        @if($ecartFiches > 0)
                            <p class="text-xs text-green-600 dark:text-green-400 mt-2 flex items-center gap-1">
                                <i class="fas fa-arrow-up"></i> +{{ $ecartFiches }} vs mois dernier
                            </p>
                        @elseif($ecartFiches < 0)
                            <p class="text-xs text-red-500 dark:text-red-400 mt-2 flex items-center gap-1">
                                <i class="fas fa-arrow-down"></i> {{ $ecartFiches }} vs mois dernier
                            </p>
                        @else
                            <p class="text-xs text-gray-400 dark:text-gray-500 mt-2">
                                Stable vs mois dernier
                            </p>
                        @endif

                    </div>
                </a>
    </div>

    <div class="max-w-7xl mx-auto px-6 py-6">
    
        <!-- Graphiques -->

        <div class="grid grid-cols-1 xl:grid-cols-2 gap-8">

            <!-- Evolution -->

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl
                 hover:border-blue-300 dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-6 transition-all duration-300
                 hover:-translate-y-1 hover:shadow-xl hover:border-blue-300 dark:hover:border-blue-500">

                <h2 class="text-xl font-semibold text-gray-800 mb-6 dark:text-gray-100 mb-6">
                    Evolution du nombre de formations
                </h2>

                <div class="h-72">
                    <canvas id="formationGraphe"></canvas>
                </div>

                <div class="flex justify-center gap-3 mt-6">

                    <button id="btnPrev"
                        class="w-11 h-11 rounded-full bg-slate-100 hover:bg-blue-500 hover:text-white transition duration-300 shadow dark:bg-gray-700
                        hover:bg-blue-500 hover:text-white dark:text-gray-200 dark:hover:bg-blue-500 dark:hover:text-white transition duration-300 shadow">

                        <i class="fas fa-chevron-left"></i>

                    </button>

                    <button id="btnNext"
                        class="w-11 h-11 rounded-full bg-slate-100 hover:bg-blue-500 hover:text-white transition duration-300 shadow dark:bg-gray-700
                        hover:bg-blue-500 hover:text-white dark:text-gray-200 dark:hover:bg-blue-500 dark:hover:text-white
                        transition duration-300 shadow">

                        <i class="fas fa-chevron-right"></i>

                    </button>

                </div>

            </div>

            <!-- Donut -->

            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-6 transition-all duration-300 hover:-translate-y-1 hover:shadow-xl
                 hover:border-blue-300 dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-6 transition-all duration-300
                 hover:-translate-y-1 hover:shadow-xl hover:border-blue-300 dark:hover:border-blue-500">

                <h2 class="text-xl font-semibold text-gray-800 mb-6 dark:text-gray-100 mb-6">
                    Répartition des formations
                </h2>

                <div class="h-72 flex justify-center items-center">
                    <canvas id="formationsChart"></canvas>
                </div>

        </div>

    </div>

    <!-- tableau des historiques -->

    <div class="mt-8 bg-white rounded-2xl border border-gray-200 shadow-sm transition-all duration-300 hover:shadow-xl hover:border-blue-300
                dark:bg-gray-800 rounded-2xl border dark:border-gray-700 shadow-sm transition-all duration-300 hover:shadow-xl hover:border-blue-300 dark:hover:border-blue-500">

        <div class="px-6 py-5 border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700 rounded-2xl">

            <h2 class="text-2xl font-semibold text-gray-800 dark:text-gray-100">
                Historique des actions
            </h2>

            <p class="text-sm text-gray-500 mt-1 dark:text-gray-400 mt-1">
                Toutes les opérations réalisées sur la plateforme.
            </p>

        </div>

        <div class="overflow-x-auto">

            @if(count($history))

            <table class="w-full">

                <thead class="bg-slate-50 dark:bg-gray-700">

                    <tr>

                        <th class="px-6 py-4 text-left text-xs uppercase tracking-wider text-gray-600 dark:text-gray-300">
                            Date
                        </th>

                        <th class="px-6 py-4 text-left text-xs uppercase tracking-wider text-gray-600 dark:text-gray-300">
                            Action
                        </th>

                        <th class="px-6 py-4 text-left text-xs uppercase tracking-wider text-gray-600 dark:text-gray-300">
                            Type
                        </th>

                    </tr>

                </thead>

                <tbody>

                    @foreach($history as $item)

                        @php
                            $msg = strtolower($item['message']);

                            if (str_contains($msg, 'connexion')) {
                                $typeLabel = 'Connexion';
                                $icon = 'fa-right-to-bracket';
                                $color = 'text-green-600 dark:text-green-400';
                                $badgeBg = 'bg-green-100 dark:bg-green-900/40';
                                $badgeText = 'text-green-700 dark:text-green-300';
                            } elseif (str_contains($msg, 'suppress') || str_contains($msg, 'supprim')) {
                                $typeLabel = 'Suppression';
                                $icon = 'fa-trash';
                                $color = 'text-red-600 dark:text-red-400';
                                $badgeBg = 'bg-red-100 dark:bg-red-900/40';
                                $badgeText = 'text-red-700 dark:text-red-300';
                            } elseif (str_contains($msg, 'créat') || str_contains($msg, 'ajout') || str_contains($msg, 'création')) {
                                $typeLabel = 'Création';
                                $icon = 'fa-file-circle-plus';
                                $color = 'text-blue-600 dark:text-blue-400';
                                $badgeBg = 'bg-blue-100 dark:bg-blue-900/40';
                                $badgeText = 'text-blue-700vdark:text-blue-300 ';
                            } else {
                                $typeLabel = 'Autre';
                                $icon = 'fa-pen';
                                $color = 'text-gray-500 dark:text-gray-400';
                                $badgeBg = 'bg-gray-100 dark:bg-gray-700';
                                $badgeText = 'text-gray-600 dark:text-gray-300';
                            }
                        @endphp

                        <tr class="border-t border-gray-200 hover:bg-blue-50 transition duration-300 dark:border-gray-700
                            hover:bg-blue-50 dark:hover:bg-gray-700 transition duration-300">

                            <td class="px-6 py-4 whitespace-nowrap text-gray-600 dark:text-gray-300">
                                {{ $item['time'] }}
                            </td>

                            <td class="px-6 py-4 text-gray-700 dark:text-gray-200">
                                <i class="fa-solid {{ $icon }} {{ $color }} mr-2"></i>
                                {{ $item['message'] }}
                            </td>

                            <td class="px-6 py-4">
                                <span class="inline-block px-3 py-1 rounded-full text-xs font-medium {{ $badgeBg }} {{ $badgeText }}">
                                    {{ $typeLabel }}
                                </span>
                            </td>

                        </tr>

                    @endforeach

                </tbody>

            </table>

            @else

            <div class="py-16 text-center">
                <i class="fa-solid fa-clock-rotate-left text-5xl text-gray-300 mb-4 dark:text-gray-600 mb-4"></i>
                <p class="text-gray-500 text-lg dark:text-gray-400 text-lg">
                    Aucun historique disponible.
                </p>
            </div>

            @endif

        </div>

    </div>

</div>

<!-- footer -->
<footer class="mt-12 bg-white border-t border-gray-200">

    <div class="max-w-7xl mx-auto px-6 py-6 flex flex-col lg:flex-row justify-between items-center gap-6 dark:bg-gray-800">

        <div class="flex items-center gap-3">

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

        <div class="text-center">
            <p class="text-gray-500 text-sm dark:text-gray-100">
                © {{ date('Y') }}
                <span class="font-semibold text-gray-700 dark:text-gray-100">
                    GASY TECH
                </span>
                • Tous droits réservés.
            </p>
            <p class=" italic text-gray-500 dark:text-gray-100">"Ny Fahaizana no ampinga enti-miady"</p>
        </div>

        <!-- icones reseaux sociaux -->
        <div class="flex gap-4">
            <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-blue-500 hover:text-white transition">
                <i class="fab fa-facebook-f"></i>
            </a>
            <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-sky-500 hover:text-white transition">
                <i class="fab fa-twitter"></i>
            </a>
            <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-blue-700 hover:text-white transition">
                <i class="fab fa-linkedin-in"></i>
            </a>
            <a href="#" class="w-10 h-10 rounded-full bg-gray-100 flex items-center justify-center text-gray-600 hover:bg-red-500 hover:text-white transition">
                <i class="fas fa-envelope"></i>
            </a>
        </div>
    </div>
</footer>

@endsection
@section('scripts')
<script>
    //pour le donut
    window.dashboardData = {
        enInscription: @json($enInscription),
        enCours: @json($enCours),
        termine: @json($termine),
        total: @json($total)
    };
    //pour le graphe
    window.formationData = {
        labels: @json($labels),
        data: @json($data)
    };
</script>
@vite('public/js/dashboard.js')

@endsection