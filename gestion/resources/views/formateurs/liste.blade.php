@extends('layouts.app')

@section('title', 'Liste des formateurs')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-8">
    <!--  Titres  -->
    <div class="flex flex-col lg:flex-row justify-between items-center gap-4 mb-8">

        <div>
            <h2 class="text-2xl font-bold text-gray-700">
                Gestion des formateurs
            </h2>
            <p class="text-gray-500 mt-1">
                Consultez, modifiez et supprimez les formateurs.
            </p>
        </div>
    
        <!-- Notifications -->
        @if(session('success'))
            <div id="notif"
                class="mb-6 rounded-xl border border-green-200 bg-green-50 px-5 py-4 text-green-700 shadow-md transition-all duration-500">

                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-check text-green-600 text-xl"></i>
                    <span>{{ session('success') }}</span>
                </div>
            </div>
        @endif

        @if(session('error'))
            <div id="notif"
                class="mb-6 rounded-xl border border-red-200 bg-red-50 px-5 py-4 text-red-700 shadow-md transition-all duration-500">

                <div class="flex items-center gap-3">
                    <i class="fa-solid fa-circle-xmark text-red-600 text-xl"></i>
                    <span>{{ session('error') }}</span>
                </div>
            </div>
        @endif
            
        <!-- BTN AJOUT de formation -->
        <a href="{{ route('formateurs.create') }}"
            class="inline-flex items-center gap-3
            bg-gradient-to-r from-blue-600 to-blue-500
            hover:from-blue-700 hover:to-blue-600
            text-white
            px-6 py-3
            rounded-xl
            shadow-lg
            transition">

            <i class="fa-solid fa-plus"></i>
            Ajouter un formateur
        </a>
    </div>

    <!-- CARTES -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
        <!-- CARTES TOTAL FORMATEURS -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 hover:-translate-y-1 hover:shadow-xl transition">

            <div class="flex items-center gap-4">

                <div class="w-16 h-16 rounded-full bg-blue-100 flex justify-center items-center">
                    <i class="fa-solid fa-graduation-cap text-blue-600 text-2xl"></i>
                </div>

                <div>
                    <p class="text-gray-500 text-sm">
                        Total formateurs
                    </p>
                    <h3 class="text-3xl font-bold">
                        {{ $totalFormateurs }}
                    </h3>
                </div>
            </div>
        </div>
        <!-- CARTES DES SPECIALITES -->
         @php
            $specialiteIcons = [
                'Call Center' => [
                    'icon' => 'fa-headset',
                    'color' => 'text-blue-500'
                ],
                'Développement Python et Intelligence Artificielle' => [
                    'icon' => 'fa-brain',
                    'color' => 'text-purple-600'
                ],
                'Développement Web' => [
                    'icon' => 'fa-code',
                    'color' => 'text-green-500'
                ],
                'Robotique' => [
                    'icon' => 'fa-robot',
                    'color' => 'text-orange-500'
                ],
                'UI/UX Design' => [
                    'icon' => 'fa-palette',
                    'color' => 'text-pink-500'
                ],
                'Réseaux informatiques et Cybersécurité' => [
                    'icon' => 'fa-shield-halved',
                    'color' => 'text-red-600'
                ],
            ];
        @endphp
        @foreach($specialitesStat as $specialiteStat)
            @php
                $info = $specialiteIcons[$specialiteStat->nom_specialite] ?? [
                    'icon' => 'fa-book',
                    'color' => 'text-gray-500'
                ];
            @endphp
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 hover:-translate-y-1 hover:shadow-xl transition">

                <div class="flex items-center gap-4">

                    <div class="w-16 h-16 rounded-full bg-blue-100 flex justify-center items-center">
                        <i class="fas {{ $info['icon'] }} {{ $info['color'] }} text-2xl"></i>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm">
                            {{ $specialiteStat->nom_specialite }}
                        </p>

                        <h3 class="text-3xl font-bold">
                            {{ $specialiteStat->formateurs_count }}
                        </h3>
                    </div>

                </div>

            </div>

        @endforeach

    </div>

    <!--  Tableau  -->
    <div class="bg-white rounded-3xl border border-gray-200 shadow-lg p-6">
        <div class="flex flex-col lg:flex-row justify-between gap-4 mb-6">
            <form action="{{ route('formateurs.index') }}" method="GET" id="searchForm" class="flex flex-col md:flex-row gap-3 w-full">
                <!-- Barre de recherche -->
                <div class="relative w-full md:w-96">
                    <i class="fa-solid fa-magnifying-glass absolute left-4 top-1/2 -translate-y-1/2 text-gray-400"></i>
                    <input type="text"
                            id="search"
                            name="search"
                            value="{{ request('search') }}"
                            placeholder="Rechercher un formateur..."
                            class="w-full pl-11 pr-4 py-3 rounded-xl border border-gray-300 focus:ring-2 focus:ring-blue-500 outline-none"
                    >
                </div>
                
                <!-- Filtre par spécialité -->
                <select name="specialite"
                        onchange="this.form.submit()"
                        class="rounded-xl border border-gray-300 px-5 py-3">

                    <option value="" {{ request('specialite') == '' ? 'selected' : '' }}>
                        Toutes les spécialités</option>

                    @foreach($specialites as $specialite)
                        <option value="{{ $specialite->id }}"
                            {{ request('specialite') == $specialite->id ? 'selected' : '' }} >
                            {{ $specialite->nom_specialite }}
                        </option>
                    @endforeach
                </select>
            </form>
        </div>
    </div>

    <div class="overflow-x-auto">
        <table class="w-full">

            <thead class="bg-slate-100">
                <tr>
                    <th class="p-4 text-left">Spécialité(s)</th>
                    <th class="p-4 text-left">Nom</th>
                    <th class="p-4 text-left">Prénom</th>
                    <th class="p-4 text-left">Contact</th>
                    <th class="p-4 text-center">Actions</th>
                </tr>
            </thead>

            <tbody>

                @foreach($formateurs as $formateur)

                    <tr class="border-b border-gray-200 hover:bg-slate-50 transition duration-300">

                        <td class="px-6 py-5 font-medium text-gray-700">
                            @foreach($formateur->specialites as $specialite)
                                <span>{{ $specialite->nom_specialite }}</span><br>
                            @endforeach
                        </td>
                        <!-- Nom -->
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 rounded-full bg-blue-100 flex items-center justify-center">
                                    <i class="fa-solid fa-user text-blue-600"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800">
                                        {{ $formateur->nom_formateur }}
                                    </h3>
                                </div>
                            </div>
                        </td>

                        <td class="px-6 py-5">
                            {{ $formateur->prenom_formateur }}
                        </td>
                        
                        <td class="px-4 py-2">

                            @if($formateur->email)
                                <div><i class="fa-regular fa-envelope"></i> {{ $formateur->email }}</div>
                            @endif

                            @if($formateur->telephone)
                                <div><i class="fa-solid fa-phone"></i> {{ $formateur->telephone }}</div>
                            @endif

                        </td>

                        <td class="px-6 py-5">

                            <div class="flex justify-center gap-4">

                                {{-- MODIFIER --}}
                                <a href="{{ route('formateurs.edit', $formateur->id) }}"
                                  class="w-10 h-10 rounded-full
                                        bg-blue-100
                                        text-blue-600
                                        hover:bg-blue-600
                                        hover:text-white
                                        transition
                                        duration-300
                                        flex items-center justify-center">

                                    <i class="fa-solid fa-pen"></i>

                                </a>

                                {{-- SUPPRIMER --}}
                                <form action="{{ route('formateurs.destroy', $formateur->id) }}"
                                      method="POST"
                                      onsubmit="return confirm('Supprimer ce formateur ?')">

                                    @csrf

                                    @method('DELETE')

                                    <button type="submit"
                                            style="cursor: pointer;"
                                            class="w-10 h-10 rounded-full
                                            bg-red-100
                                            text-red-600
                                            hover:bg-red-600
                                            hover:text-white
                                            transition
                                            duration-300
                                            flex items-center justify-center">

                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                </form>
                            </div>
                        </td>

                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@if($formateurs->count() == 0)
    <div class="py-16 text-center">
        <div class="w-24 h-24 mx-auto rounded-full bg-gray-100 flex items-center justify-center mb-6">
            <i class="fa-solid fa-folder-open text-4xl text-gray-400"></i>
        </div>
        <h2 class="text-2xl font-semibold text-gray-700">
            Aucun formateur trouvé
        </h2>
        <p class="text-gray-500 mt-2">
            Essayez une autre recherche ou ajoutez un nouveau formateur.
        </p>
    </div>
@endif

<!--  Pagination  -->
@if($formateurs->hasPages())
    <div class="mt-8 flex justify-center">
        {{ $formateurs->links() }}
    </div>
@endif

@endsection

@section('scripts')
<script>
    //pour permettre la recherche automatique
    let timer;

    document.getElementById('search').addEventListener('input', function () {
        clearTimeout(timer);

        timer = setTimeout(() => {
            document.getElementById('searchForm').submit();
        }, 500); // délai de 500 ms
    });
</script>
@endsection