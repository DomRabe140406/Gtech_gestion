@extends('layouts.app')

@section('title', 'Liste des formateurs')

@section('content')

<div class="max-w-7xl mx-auto px-6 py-8">
    <!--  Titres  -->
    <div class="flex flex-col lg:flex-row justify-between items-center gap-4 mb-8">

        <div>
            <h2 class="text-2xl font-bold text-gray-700 dark:text-gray-400">
                Gestion des formateurs
            </h2>
            <p class="text-gray-500 mt-1 dark:text-gray-500">
                Consultez, modifiez et supprimez les formateurs.
            </p>
        </div>
    
        
        <!-- BTN AJOUT formateur -->
        <a href="{{ route('formateurs.create') }}" 
           class="inline-flex items-center gap-3 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 dark:bg-none dark:bg-blue-900/40 dark:hover:bg-blue-900/60
           text-white px-6 py-3 rounded-xl shadow-lg transition-colors duration-300 ">
            <i class="fa-solid fa-plus"></i>
            Ajouter un formateur
        </a>
    
    <!-- BTN AJOUT spécialité -->
        <button type="button" onclick="ouvrirPopupSpecialite()"
                class="inline-flex items-center gap-3 bg-gradient-to-r from-blue-600 to-blue-500 hover:from-blue-700 hover:to-blue-600 dark:bg-none dark:bg-blue-900/40 dark:hover:bg-blue-900/60
           text-white px-6 py-3 rounded-xl shadow-lg transition-colors duration-300 ">
    
        <i class="fa-solid fa-plus mr-2"></i>
            Ajouter une spécialité
        </button>

    <!-- BTN SUPPRIMER spécialité -->
        <button type="button" onclick="ouvrirPopupSuppressionSpecialite()"
                class="inline-flex items-center gap-3 bg-gradient-to-r from-red-600 to-red-500 hover:from-red-700 hover:to-red-600 dark:bg-none dark:bg-red-900/40 dark:hover:bg-red-900/60
           text-white px-6 py-3 rounded-xl shadow-lg transition-colors duration-300 ">

                 <i class="fa-solid fa-trash"></i>
                Supprimer des spécialités
        </button>
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

<!-- CARTES -->
    <div class="grid grid-cols-1 md:grid-cols-2 xl:grid-cols-4 gap-6 mb-8">
        <!-- CARTES TOTAL FORMATEURS -->
        <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 hover:-translate-y-1 hover:shadow-xl transition
                    dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5 transition-all duration-300
                    hover:-translate-y-1 hover:shadow-xl hover:border-blue-300 dark:hover:border-blue-500">

            <div class="flex items-center gap-4">

                <div class="w-16 h-16 rounded-full bg-blue-100 flex justify-center items-center">
                    <i class="fa-solid fa-graduation-cap text-blue-600 text-2xl"></i>
                </div>

                <div>
                    <p class="text-gray-500 text-sm dark:text-gray-500">
                        Total formateurs
                    </p>
                    <h3 class="text-3xl font-bold dark:text-gray-500">
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
                'Réseaux Informatiques et Cybersécurité' => [
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
            <div class="bg-white rounded-2xl border border-gray-200 shadow-sm p-5 hover:-translate-y-1 hover:shadow-xl transition 
                        dark:bg-gray-800 rounded-2xl border border-gray-200 dark:border-gray-700 shadow-sm p-5 transition-all duration-300
                        hover:-translate-y-1 hover:shadow-xl hover:border-blue-300 dark:hover:border-blue-500">

                <div class="flex items-center gap-4">

                    <div class="w-16 h-16 rounded-full bg-blue-100 flex justify-center items-center">
                        <i class="fas {{ $info['icon'] }} {{ $info['color'] }} text-2xl"></i>
                    </div>

                    <div>
                        <p class="text-gray-500 text-sm dark:text-gray-500">
                            {{ $specialiteStat->nom_specialite }}
                        </p>

                        <h3 class="text-3xl font-bold dark:text-gray-400">
                            {{ $specialiteStat->formateurs_count }}
                        </h3>
                    </div>

                </div>

            </div>

        @endforeach

    </div>

    <!--  Tableau  -->
    <div class="bg-white rounded-3xl border border-gray-200 shadow-lg p-6  dark:bg-gray-800 rounded-2xl border 
                dark:border-gray-700 shadow-sm transition-all    duration-300 hover:shadow-xl hover:border-blue-300 dark:hover:border-blue-500">
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
        
        <div class="overflow-x-auto">
        <table class="w-full">

            <thead class="bg-slate-100 dark:bg-gray-700">
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
                
                <tr class="border-b border-gray-200 hover:bg-slate-50 transition duration-300 dark:border-gray-700
                           hover:bg-blue-50 dark:hover:bg-gray-700 transition duration-300">
                    
                    <td class="px-6 py-5 font-medium text-gray-700 dark:text-gray-300">
                        @foreach($formateur->specialites as $specialite)
                                <span>{{ $specialite->nom_specialite }}</span><br>
                            @endforeach
                        </td>
                        <!-- Nom -->
                        <td class="px-6 py-5">
                            <div class="flex items-center gap-3">
                                <div class="w-11 h-11 rounded-full bg-blue-100 flex items-center justify-center dark:bg-blue-900/40">
                                    <i class="fa-solid fa-user text-blue-600"></i>
                                </div>
                                <div>
                                    <h3 class="font-semibold text-gray-800 dark:text-gray-300">
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
                                  class="w-10 h-10 rounded-full bg-blue-100 text-blue-600 hover:bg-blue-600 hover:text-white
                                        transition duration-300 flex items-center justify-center dark:bg-blue-900/40">

                                    <i class="fa-solid fa-pen"></i>

                                </a>

                                {{-- SUPPRIMER --}}
                                <form action="{{ route('formateurs.destroy', $formateur->id) }}" method="POST" onsubmit="return confirm('Supprimer ce formateur ?')">

                                    @csrf

                                    @method('DELETE')
                                    
                                    <button type="submit" style="cursor: pointer;"
                                            class="w-10 h-10 rounded-full bg-red-100 text-red-600 hover:bg-red-600 hover:text-white transition duration-300
                                            flex items-center justify-center dark:bg-red-900/40">

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
<!--  Si liste vide  -->
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
    
</div>
    <!--  Pagination  -->
    @if($formateurs->hasPages())
    <div class="mt-8 flex justify-center">
        {{ $formateurs->links() }}
    </div>
@endif

<!--  popup pour ajouter une spécialité  -->
<div id="popupSpecialite"
     class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50 p-4">

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-md p-6 border border-transparent dark:border-gray-700 transition-colors duration-300">

        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-full bg-green-100 dark:bg-green-900/40 flex items-center justify-center">
                <i class="fas fa-plus text-green-600 dark:text-green-400"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                Nouvelle spécialité
            </h2>
        </div>

        <form action="{{ route('specialites.store') }}" method="POST">

            @csrf

            <div class="mb-5">

                <label class="block mb-2 font-medium text-gray-600 dark:text-gray-300">
                    Nom de la spécialité
                </label>

                <input type="text" name="nom_specialite" value="{{ old('nom_specialite') }}"
                       class="w-full border border-gray-300 dark:border-gray-600 rounded-xl p-3 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                       focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500 transition-colors
                       @error('nom_specialite') border-red-500 dark:border-red-500 @enderror">

                @error('nom_specialite')
                    <p class="text-red-500 dark:text-red-400 text-sm mt-2">
                        {{ $message }}
                    </p>
                @enderror

                <small id="erreur-nom-specialite" class="text-red-500 dark:text-red-400"></small>

            </div>

            <div class="flex justify-end gap-3">

                <button type="button" onclick="fermerPopupSpecialite()"
                        class="bg-gray-100  hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-600 dark:bg-red-900/40 dark:text-red-300
                        px-5 py-2.5 rounded-xl transition-colors duration-300 font-medium">
                    Annuler
                </button>

                <button type="submit"
                        class="bg-green-600 hover:bg-green-700  dark:hover:bg-green-500 text-white px-5 py-2.5 rounded-xl transition-colors duration-300
                        font-medium flex items-center gap-2 dark:bg-green-900/40 dark:text-green-300">
                    <i class="fas fa-check text-sm"></i>
                    Enregistrer
                </button>

            </div>

        </form>

    </div>

</div>

<!--  popup pour supprimer une spécialité  -->
<div id="popupSuppressionSpecialite"
     class="fixed inset-0 bg-black/50 backdrop-blur-sm hidden items-center justify-center z-50 p-4">

    <div class="bg-white dark:bg-gray-800 rounded-2xl shadow-2xl w-full max-w-lg p-6 border border-transparent dark:border-gray-700 transition-colors duration-300">

        <div class="flex items-center gap-3 mb-6">
            <div class="w-10 h-10 rounded-full bg-red-100 dark:bg-red-900/40 flex items-center justify-center">
                <i class="fas fa-trash text-red-600 dark:text-red-400"></i>
            </div>
            <h2 class="text-2xl font-bold text-gray-800 dark:text-gray-100">
                Supprimer des spécialités
            </h2>
        </div>

        <form
            action="{{ route('specialites.destroyMultiple') }}"
            method="POST">

            @csrf
            @method('DELETE')

            <div class="space-y-1 max-h-72 overflow-y-auto pr-1">

                @foreach($specialites as $specialite)

                    <label class="flex items-center gap-3 p-2.5 rounded-lg hover:bg-red-50 dark:hover:bg-gray-700 text-gray-700 dark:text-gray-200
                                  cursor-pointer transition-colors">

                        <input type="checkbox" name="specialites[]" value="{{ $specialite->id }}"
                            class="rounded border-gray-300 dark:border-gray-600 text-red-600 dark:bg-gray-900 focus:ring-red-400 dark:focus:ring-red-500">

                        {{ $specialite->nom_specialite }}

                    </label>

                @endforeach

            </div>

            @error('specialites')
                <p class="text-red-500 dark:text-red-400 mt-3">
                    {{ $message }}
                </p>
            @enderror

            <div class="flex justify-end gap-3 mt-6">

                <button type="button" onclick="fermerPopupSuppressionSpecialite()"
                        class="bg-gray-100 hover:bg-gray-200 dark:hover:bg-gray-600 text-gray-600 dark:bg-gray-900/40 dark:text-gray-300
                        px-5 py-2.5 rounded-xl transition-colors duration-300 font-medium">
                    Annuler
                </button>

                <button type="submit"
                        class="bg-red-600 hover:bg-red-700 dark:hover:bg-red-500 text-white px-5 py-2.5 rounded-xl transition-colors duration-300
                           font-medium flex items-center gap-2 dark:bg-red-900/40 dark:text-red-300">
                    <i class="fas fa-trash text-sm"></i>
                    Supprimer
                </button>

            </div>

        </form>

    </div>

</div>

@endsection

@section('scripts')

@if ($errors->has('nom_specialite'))
<script>
    //ouvrir automatiquement le popup d'ajout de specialite si une erreur de validation se produit
    document.addEventListener("DOMContentLoaded", function () {
        ouvrirPopupSpecialite();
        //pour que le curseur soit tout de suite sur champ
        document.querySelector('input[name="nom_specialite"]').focus();
    });
</script>
@endif
@if ($errors->has('specialites'))
<script>
    //ouvrir automatiquement le popup de suppression de specialite si une erreur de validation se produit
    document.addEventListener("DOMContentLoaded", function () {
        ouvrirPopupSuppressionSpecialite();
        //pour que le curseur soit tout de suite sur champ
        document.querySelector('input[name="nom_specialite"]').focus();
    });
</script>
@endif

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