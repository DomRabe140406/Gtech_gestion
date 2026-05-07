@extends('layouts.app')

@section('title', 'Création Facture')

@section('content')

<div class="min-h-screen flex items-start justify-center bg-gray-100 py-10 px-4">

<form id="form_principale"
      action="{{ route('factures.store') }}"
      method="POST"
      class="bg-white w-full max-w-2xl p-10 rounded-3xl shadow-2xl">

    @csrf

    <h2 class="text-3xl font-bold text-gray-700 mb-8 text-center">
        Création de facture
    </h2>

    <!-- ETAPE 1 -->
    <div id="etape1" class="etape active space-y-5">

        <h3 class="text-xl font-semibold text-gray-600">Client</h3>

        <div>
            <label class="text-gray-600">Nom du client</label>
            <input name="nom"
                   class="w-full mt-2 p-3 border rounded-xl focus:ring-2 focus:ring-blue-400">
        </div>

        <div>
            <label class="text-gray-600">Adresse du client</label>
            <input name="adresse"
                   class="w-full mt-2 p-3 border rounded-xl focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="flex justify-between pt-6">
            <button type="button"
                    onclick="etapeSuivante(1,2);updateProgressFacture(2)"
                    class="bg-blue-500 text-white px-6 py-3 rounded-xl hover:bg-blue-600 transition">
                Suivant
            </button>

            <button type="button"
                    onclick="annulerForm()"
                    class="bg-red-500 text-white px-6 py-3 rounded-xl hover:bg-red-600 transition">
                Annuler
            </button>
        </div>

    </div>

    <!-- ETAPE 2 -->
    <div id="etape2" class="etape space-y-5">

        <h3 class="text-xl font-semibold text-gray-600">Formation</h3>

        <input type="date"
               name="date_debut"
               class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-400">

        <input type="date"
               name="date_fin"
               class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-400">

        <select name="designation"
                class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-400">

            <option value="">Choisir la formation</option>

            @foreach($formations ?? [] as $r)
                <option value="{{ $r->id_formation }}">
                    {{ $r->titre_formation }}
                </option>
            @endforeach

        </select>

        <div class="flex justify-between pt-6">

            <button type="button"
                    onclick="etapePrecedente(2,1);updateProgressFacture(1)"
                    class="bg-gray-500 text-white px-6 py-3 rounded-xl hover:bg-gray-600 transition">
                Précédent
            </button>

            <button type="button"
                    onclick="etapeSuivante(2,3);updateProgressFacture(3)"
                    class="bg-blue-500 text-white px-6 py-3 rounded-xl hover:bg-blue-600 transition">
                Suivant
            </button>

        </div>

    </div>

    <!-- ETAPE 3 -->
    <div id="etape3" class="etape space-y-5">

        <h3 class="text-xl font-semibold text-gray-600">Frais</h3>

        <input type="number"
               name="prix"
               placeholder="Prix formation"
               class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-400">

        <input type="number"
               name="indemnite"
               placeholder="Indemnité"
               class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-400">

        <input type="number"
               name="tva"
               placeholder="TVA"
               class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-400">

        <div class="flex justify-between pt-6">

            <button type="button"
                    onclick="etapePrecedente(3,2);updateProgressFacture(2)"
                    class="bg-gray-500 text-white px-6 py-3 rounded-xl hover:bg-gray-600 transition">
                Précédent
            </button>

            <button type="button"
                    onclick="etapeSuivante(3,4);updateProgressFacture(4)"
                    class="bg-blue-500 text-white px-6 py-3 rounded-xl hover:bg-blue-600 transition">
                Suivant
            </button>

        </div>

    </div>

    <!-- ETAPE 4 -->
    <div id="etape4" class="etape space-y-6 text-center">

        <h3 class="text-xl font-semibold text-gray-600">Finalisation</h3>

        <button type="submit"
                name="btn_apercu"
                class="w-full bg-green-500 text-white px-6 py-3 rounded-xl hover:bg-green-600 transition">
            Aperçu PDF
        </button>

        <button type="submit"
                name="btn_telecharge"
                class="w-full bg-blue-500 text-white px-6 py-3 rounded-xl hover:bg-blue-600 transition">
            Télécharger PDF
        </button>

        <button type="button"
                onclick="etapePrecedente(4,3);updateProgressFacture(4)"
                class="text-gray-500 underline">
            Retour
        </button>

    </div>
    <div class="mt-10">

        <div class="w-full bg-gray-200 rounded-full h-3 overflow-hidden">
            <div id="progress"
                class="bg-blue-500 h-3 rounded-full transition-all duration-500"
                style="width: 25%;">
            </div>
        </div>

        <div class="flex justify-between text-sm mt-3 text-gray-500 px-1">
            <span>Étape 1</span>
            <span>Étape 2</span>
            <span>Étape 3</span>
            <span>Étape 4</span>
        </div>
    </div>
</form>

</div>

@endsection