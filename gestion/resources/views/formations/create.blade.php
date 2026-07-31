@extends('layouts.app')

@section('title', 'Ajouter Formation')

@section('content')
@include('layouts.notification')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-900 dark:to-gray-800 p-6">

<form id="form_principale" action="{{ route('formations.store') }}" method="POST"
      class="bg-white dark:bg-gray-800 shadow-2xl rounded-3xl p-6 md:p-8 w-full max-w-2xl transition-all border border-transparent dark:border-gray-700">
      @csrf


    <!-- ETAPE 1 -->
    <div id="etape1" class="etape active space-y-5">

        <h3 class="text-2xl md:text-3xl font-bold text-gray-700 dark:text-gray-100 mb-6">
            Ajouter une formation
        </h3>

        <div>
            <label for="Ref_formation" class="flex items-center gap-2 mb-1 font-medium text-gray-600 dark:text-gray-300">
                <i class="fas fa-hashtag text-blue-500 dark:text-blue-400 text-sm"></i>
                Référence:
            </label>
            <input type="text" name="ref_formation" id="Ref_formation" placeholder="Référence de la formation"
                   class="w-full border border-gray-300 dark:border-gray-600 rounded-xl p-4 bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                          placeholder-gray-400 dark:placeholder-gray-500focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500
                          transition-colors">
            @error('ref_formation')
                <p class="text-red-500 dark:text-red-400 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror
            <small class="text-red-500 dark:text-red-400 erreur"></small>
        </div>

        <div>
            <label for="Nom_formation" class="flex items-center gap-2 mb-1 font-medium text-gray-600 dark:text-gray-300">
                <i class="fas fa-book text-blue-500 dark:text-blue-400 text-sm"></i>
                Nom formation:
            </label>
            <input type="text" name="nom_formation" id="Nom_formation" placeholder="Nom de la formation"
                   class="w-full border border-gray-300 dark:border-gray-600 rounded-xl p-4
                          bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                          placeholder-gray-400 dark:placeholder-gray-500
                          focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500
                          transition-colors">
            @error('nom_formation')
                <p class="text-red-500 dark:text-red-400 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror
            <small class="text-red-500 dark:text-red-400 erreur"></small>
        </div>

        <div>
            <label class="flex items-center gap-2 mb-1 font-medium text-gray-600 dark:text-gray-300" for="Date">
                <i class="fas fa-calendar text-blue-500 dark:text-blue-400 text-sm"></i>
                Date de début:
            </label>
            <input type="date" id="Date" name="date"
                   class="w-full border border-gray-300 dark:border-gray-600 rounded-xl p-4
                          bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                          focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500
                          transition-colors
                          [color-scheme:light] dark:[color-scheme:dark]">
            @error('date')
                <p class="text-red-500 dark:text-red-400 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror
            <small class="text-red-500 dark:text-red-400 erreur"></small>
        </div>

        <div>
            <label class="flex items-center gap-2 mb-1 font-medium text-gray-600 dark:text-gray-300" for="Nb_j">
                <i class="fas fa-clock text-blue-500 dark:text-blue-400 text-sm"></i>
                Nombre de jours:
            </label>
            <input type="number" name="capacite" min="1" id="Nb_j" value="5"
                   class="w-full border border-gray-300 dark:border-gray-600 rounded-xl p-4
                          bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                          focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500
                          transition-colors">
            @error('capacite')
                <p class="text-red-500 dark:text-red-400 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror
            <small class="text-red-500 dark:text-red-400 erreur"></small>
        </div>

        <div class="mb-3">
            <label class="flex items-center gap-2 mb-1 font-medium text-gray-600 dark:text-gray-300">
                <i class="fas fa-list-check text-blue-500 dark:text-blue-400 text-sm"></i>
                Statut:
            </label>

            <select id="Statut" name="statut"
                    class="w-full border border-gray-300 dark:border-gray-600 rounded-xl p-4
                           bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                           focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500
                           transition-colors">
                <option value="en_inscription">En inscription</option>
                <option value="en_cours">En cours</option>
            </select>
            @error('statut')
                <p class="text-red-500 dark:text-red-400 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror
            <small class="text-red-500 dark:text-red-400 erreur"></small>

        </div>

        <div class="flex justify-between pt-2">

            <button type="button" onclick="annulerForm()"
                    class="bg-gray-100 dark:bg-gray-700 hover:bg-red-500 dark:hover:bg-red-600
                           text-gray-600 dark:text-gray-200 hover:text-white
                           px-6 py-3 rounded-xl transition-colors duration-300 shadow font-medium">
                Annuler
            </button>

            <button type="button" onclick="passerEtape(1)"
                    class="bg-blue-500 hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-500
                           text-white px-6 py-3 rounded-xl transition-colors duration-300 shadow font-medium
                           flex items-center gap-2">
                Suivant
                <i class="fas fa-arrow-right text-sm"></i>
            </button>

        </div>

    </div>

    <!-- ETAPE 2 -->
    <div id="etape2" class="etape hidden space-y-5">

        <h3 class="text-2xl md:text-3xl font-bold text-gray-700 dark:text-gray-100 mb-6">
            Nombre de participant
        </h3>

        <div>
            <label class="flex items-center gap-2 mb-2 font-medium text-gray-600 dark:text-gray-300">
                <i class="fas fa-users text-blue-500 dark:text-blue-400 text-sm"></i>
                Nombre de participant
            </label>

            <input type="number" id="Nb_participant" name="nb_participant" value="20"
                   class="w-full border border-gray-300 dark:border-gray-600 rounded-xl p-4
                          bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                          focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500
                          transition-colors">
            @error('nb_participant')
                <p class="text-red-500 dark:text-red-400 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror
            <small class="text-red-500 dark:text-red-400 erreur"></small>
        </div>

        <div class="flex justify-between pt-6">

            <button type="button" onclick="etapePrecedente(2,1); updateProgress(1)"
                    class="bg-gray-500 hover:bg-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600
                           text-white px-6 py-3 rounded-xl transition-colors duration-300 shadow font-medium
                           flex items-center gap-2">
                <i class="fas fa-arrow-left text-sm"></i>
                Précédent
            </button>

            <button type="button" onclick="passerEtape(2)"
                    class="bg-blue-500 hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-500
                           text-white px-6 py-3 rounded-xl transition-colors duration-300 shadow font-medium
                           flex items-center gap-2">
                Suivant
                <i class="fas fa-arrow-right text-sm"></i>
            </button>

        </div>

    </div>

    <!-- ETAPE 3 -->
    <div id="etape3" class="etape hidden space-y-5">

        <h3 class="text-2xl md:text-3xl font-bold text-gray-700 dark:text-gray-100 mb-6">
            Ajout Formateur
        </h3>

        <div>
            <label class="flex items-center gap-2 mb-2 font-medium text-gray-600 dark:text-gray-300">
                <i class="fas fa-user text-blue-500 dark:text-blue-400 text-sm"></i>
                Nom formateur
            </label>

            <input type="text" name="nom_formateur"
                   class="w-full border border-gray-300 dark:border-gray-600 rounded-xl p-4
                          bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                          focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500
                          transition-colors">
        </div>

        <div>
            <label class="flex items-center gap-2 mb-2 font-medium text-gray-600 dark:text-gray-300">
                <i class="fas fa-id-card text-blue-500 dark:text-blue-400 text-sm"></i>
                Prénom formateur
            </label>

            <input type="text" name="prenom_formateur"
                   class="w-full border border-gray-300 dark:border-gray-600 rounded-xl p-4
                          bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                          focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500
                          transition-colors">
        </div>

        <div class="flex justify-between pt-6">

            <button type="button" onclick="etapePrecedente(3,2); updateProgress(2)"
                    class="bg-gray-500 hover:bg-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600
                           text-white px-6 py-3 rounded-xl transition-colors duration-300 shadow font-medium
                           flex items-center gap-2">
                <i class="fas fa-arrow-left text-sm"></i>
                Précédent
            </button>

            <button type="submit"
                    class="bg-green-500 hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-500
                           text-white px-6 py-3 rounded-xl transition-colors duration-300 shadow font-medium
                           flex items-center gap-2">
                Envoyer
                <i class="fas fa-check text-sm"></i>
            </button>

        </div>

    </div>

    <!-- Progress Bar -->
    <div class="mt-10">

        <div class="w-full bg-gray-200 dark:bg-gray-700 rounded-full h-3 overflow-hidden">
            <div id="progress"
                 class="bg-blue-500 dark:bg-blue-400 h-3 rounded-full transition-all duration-500" style="width: 33%;">
            </div>
        </div>
        <div class="flex justify-between text-sm mt-3 text-gray-500 dark:text-gray-400 px-1">
            <span>Étape 1</span>
            <span>Étape 2</span>
            <span>Étape 3</span>
        </div>

    </div>
</form>
</div>
@endsection