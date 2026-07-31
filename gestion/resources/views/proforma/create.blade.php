@extends('layouts.app')
@section('title', 'Création Proforma')
@section('content')

<div class="min-h-screen flex items-start justify-center bg-gray-100 dark:bg-gray-900 py-10 px-4 transition-colors duration-300">

<form id="form_principale" action="{{ route('proforma.store') }}" method="POST"
      class="bg-white dark:bg-gray-800 w-full max-w-2xl p-10 rounded-3xl shadow-2xl border border-transparent dark:border-gray-700 transition-colors duration-300">
    @csrf

    <h2 class="text-3xl font-bold text-gray-700 dark:text-gray-100 mb-8 text-center">
        Création de proforma
    </h2>

    <!-- ETAPE 1 -->
    <div id="etape1" class="etape active space-y-5">

        <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-300">Client</h3>

        <div>
            <label class="flex items-center gap-2 mb-1 font-medium text-gray-600 dark:text-gray-300">
                <i class="fas fa-user text-blue-500 dark:text-blue-400 text-sm"></i>
                Nom du client
            </label>
            <input name="nom"
                   class="w-full mt-2 p-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                          focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500 transition-colors">
        </div>

        <div>
            <label class="flex items-center gap-2 mb-1 font-medium text-gray-600 dark:text-gray-300">
                <i class="fas fa-location-dot text-blue-500 dark:text-blue-400 text-sm"></i>
                Adresse du client
            </label>
            <input name="adresse"
                   class="w-full mt-2 p-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                          focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500 transition-colors">
        </div>

        <div class="flex justify-between pt-6">
            <button type="button" onclick="etapeSuivante(1,2);updateProgressFacture(2)"
                    class="bg-blue-500 hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-500 text-white px-6 py-3 rounded-xl transition-colors duration-300 flex items-center gap-2">
                Suivant
                <i class="fas fa-arrow-right text-sm"></i>
            </button>

            <button type="button" onclick="annulerForm()"
                    class="bg-gray-100 dark:bg-gray-700 hover:bg-red-500 dark:hover:bg-red-600 text-gray-600 dark:text-gray-200 hover:text-white
                           px-6 py-3 rounded-xl transition-colors duration-300">
                Annuler
            </button>
        </div>

    </div>

    <!-- ETAPE 2 -->
    <div id="etape2" class="etape space-y-5">

        <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-300">Formation</h3>

        <div>
            <label class="flex items-center gap-2 mb-1 font-medium text-gray-600 dark:text-gray-300">
                <i class="fas fa-book text-blue-500 dark:text-blue-400 text-sm"></i>
                Formation concernée
            </label>
            <select name="designation"
                    class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                           focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500 transition-colors">

                <option value="">Choisir la formation</option>
                <?php
                    $form = DB::table('formations')
                        ->select('id', 'nom_formation')
                        ->distinct()
                        ->get();
                            foreach($form as $formation) : ?>
                            <option value="{{ $formation->id }}"><?php echo $formation->nom_formation; ?></option>
                <?php endforeach ?>
            </select>
        </div>

        <div class="flex justify-between pt-6">

            <button type="button" onclick="etapePrecedente(2,1);updateProgressFacture(1)"
                    class="bg-gray-500 hover:bg-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600 text-white px-6 py-3 rounded-xl transition-colors duration-300 flex items-center gap-2">
                <i class="fas fa-arrow-left text-sm"></i>
                Précédent
            </button>

            <button type="button" onclick="etapeSuivante(2,3);updateProgressFacture(3)"
                    class="bg-blue-500 hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-500 text-white px-6 py-3 rounded-xl transition-colors duration-300
                           flex items-center gap-2">
                Suivant
                <i class="fas fa-arrow-right text-sm"></i>
            </button>

        </div>

    </div>

    <!-- ETAPE 3 -->
    <div id="etape3" class="etape space-y-5">

        <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-300">Frais</h3>

        <div>
            <label class="flex items-center gap-2 mb-1 font-medium text-gray-600 dark:text-gray-300">
                <i class="fas fa-tag text-blue-500 dark:text-blue-400 text-sm"></i>
                Prix formation
            </label>
            <input type="number" name="prix" placeholder="Prix formation"
                   class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500
                          focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500 transition-colors">
        </div>

        <div>
            <label class="flex items-center gap-2 mb-1 font-medium text-gray-600 dark:text-gray-300">
                <i class="fas fa-wallet text-blue-500 dark:text-blue-400 text-sm"></i>
                Indemnité
            </label>
            <input type="number" name="indemnite" placeholder="Indemnité"
                   class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 placeholder-gray-400 dark:placeholder-gray-500
                          focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500 transition-colors">
        </div>

        <div>
            <label class="flex items-center gap-2 mb-1 font-medium text-gray-600 dark:text-gray-300">
                <i class="fas fa-percent text-blue-500 dark:text-blue-400 text-sm"></i>
                TVA
            </label>
            <input type="number" name="tva" placeholder="TVA"
                   class="w-full p-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                          placeholder-gray-400 dark:placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500 transition-colors">
        </div>

        <div class="flex justify-between pt-6">

            <button type="button" onclick="etapePrecedente(3,2);updateProgressFacture(2)"
                    class="bg-gray-500 hover:bg-gray-600 dark:bg-gray-700 dark:hover:bg-gray-600
                           text-white px-6 py-3 rounded-xl transition-colors duration-300 flex items-center gap-2">
                <i class="fas fa-arrow-left text-sm"></i>
                Précédent
            </button>

            <button type="button" onclick="etapeSuivante(3,4);updateProgressFacture(4)"
                    class="bg-blue-500 hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-500
                           text-white px-6 py-3 rounded-xl transition-colors duration-300 flex items-center gap-2">
                Suivant
                <i class="fas fa-arrow-right text-sm"></i>
            </button>

        </div>

    </div>

    <!-- ETAPE 4 -->
    <div id="etape4" class="etape space-y-6 text-center">

        <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-300">Finalisation</h3>

        <button type="submit" name="btn_apercu" onclick="document.getElementById('form_principale').target='_blank'"
                class="w-full bg-green-500 hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-500 text-white px-6 py-3 rounded-xl transition-colors duration-300
                       flex items-center justify-center gap-2">
            <i class="fas fa-eye text-sm"></i>
            Aperçu PDF
        </button>

        <button type="submit" name="btn_telecharge" onclick="document.getElementById('form_principale').target='_self'"
                class="w-full bg-blue-500 hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-500 text-white px-6 py-3 rounded-xl transition-colors duration-300
                       flex items-center justify-center gap-2">
            <i class="fas fa-download text-sm"></i>
            Télécharger PDF
        </button>

        <button type="button" onclick="etapePrecedente(4,3);updateProgressFacture(3)" class="text-gray-500 dark:text-gray-400 underline cursor-pointer">
            Retour à l'étape précédente
        </button>
        <br>
        <button type="button" onclick="etapePrecedente(4,1);updateProgressFacture(1)" class="text-gray-500 dark:text-gray-400 underline cursor-pointer">
            Retour depuis le début
        </button>

    </div>

    <!-- Barre de progression-->
    <div class="mt-10">

        <div class="flex items-center justify-between mb-2">
            <span id="stepLabelFacture" class="text-sm font-medium text-gray-600 dark:text-gray-300">Étape 1 sur 4</span>
            <span id="stepPercentFacture" class="text-sm text-gray-400 dark:text-gray-500">25%</span>
        </div>

        <div class="flex gap-1.5">
            @for($i = 1; $i <= 4; $i++)
                <div id="segmentFacture{{ $i }}" class="h-2 flex-1 rounded-full {{ $i == 1 ? 'bg-blue-500' : 'bg-gray-200 dark:bg-gray-700' }} transition-colors duration-300">
                </div>
            @endfor
        </div>

    </div>
</form>

</div>
@endsection