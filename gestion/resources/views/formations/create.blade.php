@extends('layouts.app')

@section('title', 'Ajouter Formation')

@section('content')
@include('layouts.notification')
<div class="min-h-screen flex items-center justify-center bg-gradient-to-br from-gray-100 to-gray-200 p-6">

<form id="form_principale"
      action="{{ route('formations.store') }}"
      method="POST"
      class="bg-white shadow-2xl rounded-3xl p-5 w-full max-w-2xl transition-all">
      

    @csrf

    <!-- ETAPE 1 -->
    <div id="etape1" class="etape active space-y-5">

        <h3 class="text-3xl font-bold text-gray-700 mb-6">
            Ajouter une formation
        </h3>

        <div>
            <label for="Ref_formation" class="block mb-1 font-medium text-gray-600">Référence:</label>
            <input type="text"
                   name="ref_formation"
                    id="Ref_formation"
                    placeholder="Référence de la formation"
                   class="w-full border border-gray-300 rounded-xl p-5 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div>
            <label for="Nom_formation" class="block mb-1 font-medium text-gray-600">Nom formation:</label>
            <input type="text"
                   name="nom_formation"
                    id="Nom_formation"
                    placeholder="Nom de la formation"
                   class="w-full border border-gray-300 rounded-xl p-5 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-600" for="Date">Date de début:</label>
            <input type="date"
                    id="Date"
                   name="date"
                   class="w-full border border-gray-300 rounded-xl p-4 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div>
            <label class="block mb-1 font-medium text-gray-600" for="Nb_j">Nombre de jours:</label>
            <input type="number"
                   name="capacite"
                   min="1"
                   id="Nb_j"
                   value="5"
                   class="w-full border border-gray-300 rounded-xl p-4 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="mb-3">
            <label class="form-label">Statut:</label>

            <select name="statut" class="form-control">
                <option value="en_inscription">En inscription</option>
                <option value="en_cours">En cours</option>
            </select>
        </div>

        <div class="flex justify-between">

            <button type="button"
                    onclick="etapeSuivante(1,2); updateProgress(2)"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-xl transition shadow">
                Suivant
            </button>

            <button type="button"
                    onclick="annulerForm()"
                    class="bg-red-500 hover:bg-red-600 text-white px-6 py-3 rounded-xl transition shadow">
                Annuler
            </button>
        </div>

    </div>

    <!-- ETAPE 2 -->
    <div id="etape2" class="etape hidden space-y-5">

        <h3 class="text-3xl font-bold text-gray-700 mb-6">
            Nombre de participant
        </h3>

        <div>
            <label class="block mb-2 font-medium text-gray-600">
                Nombre de participant
            </label>

            <input type="number"
                   name="nb_participant"
                   min="0"
                   value="20"
                   class="w-full border border-gray-300 rounded-xl p-4 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="flex justify-between pt-6">

            <button type="button"
                    onclick="etapePrecedente(2,1); updateProgress(1)"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl transition shadow">
                Précédent
            </button>

            <button type="button"
                    onclick="etapeSuivante(2,3); updateProgress(3)"
                    class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-xl transition shadow">
                Suivant
            </button>

        </div>

    </div>

    <!-- ETAPE 3 -->
    <div id="etape3" class="etape hidden space-y-5">

        <h3 class="text-3xl font-bold text-gray-700 mb-6">
            Ajout Formateur
        </h3>

        <div>
            <label class="block mb-2 font-medium text-gray-600">
                Nom formateur
            </label>

            <input type="text"
                   name="nom_formateur"
                   class="w-full border border-gray-300 rounded-xl p-4 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div>
            <label class="block mb-2 font-medium text-gray-600">
                Prénom formateur
            </label>

            <input type="text"
                   name="prenom_formateur"
                   class="w-full border border-gray-300 rounded-xl p-4 focus:outline-none focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="flex justify-between pt-6">

            <button type="button"
                    onclick="etapePrecedente(3,2); updateProgress(2)"
                    class="bg-gray-500 hover:bg-gray-600 text-white px-6 py-3 rounded-xl transition shadow">
                Précédent
            </button>

            <button type="submit"
                    class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-xl transition shadow">
                Envoyer
            </button>

        </div>

    </div>
    <!-- Progress Bar -->
    <div class="mt-10">

        <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
            <div id="progress"
                 class="bg-blue-500 h-3 rounded-full transition-all duration-500"
                 style="width: 33%;">
            </div>
        </div>
        <div class="flex justify-between  text-sm mt-3 text-gray-500 px-1">
            <span>Étape 1</span>
            <span>Étape 2</span>
            <span>Étape 3</span>
        </div>

    </div>
</form>

</div>

@endsection