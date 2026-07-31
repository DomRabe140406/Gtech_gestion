@extends('layouts.app')

@section('title', 'Ajouter Formateur')

@section('content')
@include('layouts.notification')

<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200 dark:from-gray-900 dark:to-gray-800 p-6">

 <form id="form_principale" action="{{ route('formateurs.store') }}" method="POST"
      class="bg-white dark:bg-gray-800 shadow-2xl rounded-3xl p-6 md:p-8 w-full max-w-2xl transition-all border border-transparent dark:border-gray-700">
      

    @csrf
    <h3 class="text-3xl font-bold text-gray-700 mb-6 dark:text-gray-100 mb-6">
        Ajouter un formateur
    </h3>
    <!-- ETAPE 1 -->
    <div id="etape1" class="etape active space-y-5">
        <!-- Nom -->
        <div>
            <label for="Nom_formateur" class="block mb-1 font-medium text-gray-600 dark:text-gray-300">Nom :</label>
            <input type="text" name="nom_formateur" id="Nom_formateur" placeholder="RAKOTO"
                    class="w-full border border-gray-300 rounded-xl p-5 focus:outline-none focus:ring-2 focus:ring-blue-400 dark:text-gray-100
                          placeholder-gray-400 dark:placeholder-gray-500focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500
                          transition-colors">
            <!-- Message d'erreur en cas de champ invalide -->
            @error('nom_formateur')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror
            <small id="erreur-nom" class="text-red-500"></small>
        </div>

        <!-- Prénom -->
        <div>
            <label for="Prenom_formateur" class="block mb-1 font-medium text-gray-600 dark:text-gray-300">Prénom :</label>
            <input type="text" name="prenom_formateur" id="Prenom_formateur" placeholder="Jean"
                    class="w-full border border-gray-300 rounded-xl p-5 focus:outline-none focus:ring-2 focus:ring-blue-400 dark:text-gray-300">
            <!-- Message d'erreur en cas de champ invalide -->
            @error('prenom_formateur')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror
            <small id="erreur-prenom" class="text-red-500"></small>
        </div>

        <!-- Sélection des specialités -->
        <div id="specialites" class="mb-4">
            <label for="specialites" class="block font-medium">
                Spécialités
            </label>

            @foreach($specialites as $specialite)

                <label class="flex items-center gap-2 mb-2">

                    <input type="checkbox" name="specialites[]" value="{{ $specialite->id }}" class="rounded">
                    {{ $specialite->nom_specialite }}
                </label>

            @endforeach
            <small id="erreur-specialites" class="text-red-500"></small>
        </div>

        <div class="flex justify-between">

            <button type="button" onclick="passerEtapeFormateur(1)"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-xl transition shadow dark:bg-blue-900/40 dark:text-blue-300">
                Suivant
            </button>

            <button type="button" onclick="annulerFormateur()"
                    class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-xl transition shadow dark:bg-red-900/40 dark:text-red-300">
                Annuler
            </button>
        </div>

    </div>

    <!-- ETAPE 2 -->
    <div id="etape2" class="etape hidden space-y-5">

        <div>
            <label class="block mb-2 font-medium text-gray-600">
                E-mail :
            </label>

            <input type="text" id="email" name="email" placeholder="jean@gmail.com" class="w-full border border-gray-300 rounded-xl p-4 focus:outline-none focus:ring-2 focus:ring-blue-400">
            <!-- Message d'erreur en cas de champ invalide -->
            @error('email')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror
            <small id="erreur-email" class="text-red-500"></small>
        </div>

        <div>
            <label class="block mb-2 font-medium text-gray-600">
                Téléphone :
            </label>

            <input type="text" id="telephone" name="telephone" placeholder="03*******" class="w-full border border-gray-300 rounded-xl p-4 focus:outline-none focus:ring-2 focus:ring-blue-400">
            <!-- Message d'erreur en cas de champ invalide -->
            @error('telephone')
                <p class="text-red-500 text-sm mt-1">
                    {{ $message }}
                </p>
            @enderror
            <small id="erreur-telephone" class="text-red-500"></small>
        </div>

        <div class="flex justify-between pt-6">

            <button type="button" onclick="etapePrecedente(2,1); updateProgress(1)"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl transition shadow dark:bg-gray-900/40 dark:text-gray-300">
                Précédent
            </button>

            <button type="button" onclick="annulerFormateur()"
                    class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-xl transition shadow dark:bg-red-900/40 dark:text-red-300">
                Annuler
            </button>

            <button type="button" onclick="envoyerFormulaireFormateur()"
                    class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-xl transition shadow dark:bg-green-900/40 dark:text-green-300">
                Envoyer
            </button>

    </div>
</form>
</div>
@endsection