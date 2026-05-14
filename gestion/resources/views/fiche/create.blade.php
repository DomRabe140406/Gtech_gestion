@extends('layouts.app')

@section('title', 'Création Fiche de formation')

@section('content')

<div class="min-h-screen flex items-start justify-center bg-gray-100 py-10 px-4">

<form id="form_principale"
      action="{{ route('fiche.store') }}"
      method="POST"
      class="bg-white w-full max-w-2xl p-10 rounded-3xl shadow-2xl">

    @csrf

    <h2 class="text-3xl font-bold text-gray-700 mb-8 text-center">
        Création de fiche de formation
    </h2>

    <!-- ETAPE 1 -->
    <div id="etape1" class="etape space-y-5" style="display:block">

        <h3 class="text-xl font-semibold text-gray-600">Formation</h3>
        <select name="designation"
                class="w-full p-3 border rounded-xl focus:ring-2 focus:ring-blue-400">

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

        <div>
            <label class="text-gray-600">Description</label>
            <input name="objectif"
                   class="w-full mt-2 p-3 border rounded-xl focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="flex justify-between pt-6">
            <button type="button"
                    onclick="etapeSuivante(1,2);updateProgressFiche(2)"
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

        <h3 class="text-xl font-semibold text-gray-600">Contenu de la formation et déroulement</h3>

        <div>
            <label class="text-gray-600">Nom du client</label>
            <input name="nom"
                   class="w-full mt-2 p-3 border rounded-xl focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="flex justify-between pt-6">

            <button type="button"
                    onclick="etapePrecedente(2,1);updateProgressFiche(1)"
                    class="bg-gray-500 text-white px-6 py-3 rounded-xl hover:bg-gray-600 transition">
                Précédent
            </button>

            <button type="button"
                    onclick="etapeSuivante(2,3);updateProgressFiche(3)"
                    class="bg-blue-500 text-white px-6 py-3 rounded-xl hover:bg-blue-600 transition">
                Suivant
            </button>

        </div>

    </div>

        <!-- ETAPE 3 -->
    <div id="etape3" class="etape space-y-5">

        <h3 class="text-xl font-semibold text-gray-600">Outils et Supports utilisés</h3>

        <div>
            <label class="text-gray-600">Nom du client</label>
            <input name="nom"
                   class="w-full mt-2 p-3 border rounded-xl focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="flex justify-between pt-6">

            <button type="button"
                    onclick="etapePrecedente(3,2);updateProgressFiche(2)"
                    class="bg-gray-500 text-white px-6 py-3 rounded-xl hover:bg-gray-600 transition">
                Précédent
            </button>

            <button type="button"
                    onclick="etapeSuivante(3,4);updateProgressFiche(4)"
                    class="bg-blue-500 text-white px-6 py-3 rounded-xl hover:bg-blue-600 transition">
                Suivant
            </button>

        </div>

    </div>

        <!-- ETAPE 4 -->
    <div id="etape4" class="etape space-y-5">

        <h3 class="text-xl font-semibold text-gray-600">Bénéfices pour les participants</h3>

        <div>
            <label class="text-gray-600">Nom du client</label>
            <input name="nom"
                   class="w-full mt-2 p-3 border rounded-xl focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="flex justify-between pt-6">

            <button type="button"
                    onclick="etapePrecedente(4,3);updateProgressFiche(3)"
                    class="bg-gray-500 text-white px-6 py-3 rounded-xl hover:bg-gray-600 transition">
                Précédent
            </button>

            <button type="button"
                    onclick="etapeSuivante(4,5);updateProgressFiche(5)"
                    class="bg-blue-500 text-white px-6 py-3 rounded-xl hover:bg-blue-600 transition">
                Suivant
            </button>

        </div>

    </div>

        <!-- ETAPE 5 -->
    <div id="etape5" class="etape space-y-5">

        <h3 class="text-xl font-semibold text-gray-600">Public cible</h3>

        <div>
            <label class="text-gray-600">Nom du client</label>
            <input name="nom"
                   class="w-full mt-2 p-3 border rounded-xl focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="flex justify-between pt-6">

            <button type="button"
                    onclick="etapePrecedente(5,4);updateProgressFiche(4)"
                    class="bg-gray-500 text-white px-6 py-3 rounded-xl hover:bg-gray-600 transition">
                Précédent
            </button>

            <button type="button"
                    onclick="etapeSuivante(5,6);updateProgressFiche(6)"
                    class="bg-blue-500 text-white px-6 py-3 rounded-xl hover:bg-blue-600 transition">
                Suivant
            </button>

        </div>

    </div>

        <!-- ETAPE 6 -->
    <div id="etape6" class="etape space-y-5">

        <h3 class="text-xl font-semibold text-gray-600">Prérequis</h3>

        <div>
            <label class="text-gray-600">Nom du client</label>
            <input name="nom"
                   class="w-full mt-2 p-3 border rounded-xl focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="flex justify-between pt-6">

            <button type="button"
                    onclick="etapePrecedente(6,5);updateProgressFiche(5)"
                    class="bg-gray-500 text-white px-6 py-3 rounded-xl hover:bg-gray-600 transition">
                Précédent
            </button>

            <button type="button"
                    onclick="etapeSuivante(6,7);updateProgressFiche(7)"
                    class="bg-blue-500 text-white px-6 py-3 rounded-xl hover:bg-blue-600 transition">
                Suivant
            </button>

        </div>

    </div>

    <!-- ETAPE 7 -->
    <div id="etape7" class="etape space-y-5">

        <h3 class="text-xl font-semibold text-gray-600">Objectif(s) de la formation</h3>

        <div>
            <label class="text-gray-600">Nom du client</label>
            <input name="nom"
                   class="w-full mt-2 p-3 border rounded-xl focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="flex justify-between pt-6">

            <button type="button"
                    onclick="etapePrecedente(7,6);updateProgressFiche(6)"
                    class="bg-gray-500 text-white px-6 py-3 rounded-xl hover:bg-gray-600 transition">
                Précédent
            </button>

            <button type="button"
                    onclick="etapeSuivante(7,8);updateProgressFiche(8)"
                    class="bg-blue-500 text-white px-6 py-3 rounded-xl hover:bg-blue-600 transition">
                Suivant
            </button>

        </div>

    </div>

    <!-- ETAPE 8 -->
    <div id="etape8" class="etape space-y-5">

        <h3 class="text-xl font-semibold text-gray-600">Conclusion</h3>

        <div>
            <label class="text-gray-600">Nom du client</label>
            <input name="nom"
                   class="w-full mt-2 p-3 border rounded-xl focus:ring-2 focus:ring-blue-400">
        </div>

        <div class="flex justify-between pt-6">

            <button type="button"
                    onclick="etapePrecedente(8,7);updateProgressFacture(7)"
                    class="bg-gray-500 text-white px-6 py-3 rounded-xl hover:bg-gray-600 transition">
                Précédent
            </button>

            <button type="button"
                    onclick="etapeSuivante(8,9);updateProgressFiche(9)"
                    class="bg-blue-500 text-white px-6 py-3 rounded-xl hover:bg-blue-600 transition">
                Suivant
            </button>

        </div>

    </div>

    <!-- ETAPE 9 -->
    <div id="etape9" class="etape space-y-6 text-center">

        <h3 class="text-xl font-semibold text-gray-600">Finalisation</h3>

        <button type="submit"
                name="btn_apercu"
                onclick="document.getElementById('form_principale').target='_blank'"
                class="w-full bg-green-500 text-white px-6 py-3 rounded-xl hover:bg-green-600 transition">
            Aperçu PDF
        </button>

        <button type="submit"
                name="btn_telecharge"
                onclick="document.getElementById('form_principale').target='_self'"
                class="w-full bg-blue-500 text-white px-6 py-3 rounded-xl hover:bg-blue-600 transition">
            Télécharger PDF
        </button>

        <button type="button"
                style="cursor:pointer;"
                onclick="etapePrecedente(9,8);updateProgressFiche(8)"
                class="text-gray-500 underline">
            Retour à l'étape précédente
        </button>
        <br>
        <button type="button"
                style="cursor:pointer;"
                onclick="etapePrecedente(9,1);updateProgressFiche(1)"
                class="text-gray-500 underline">
            Retour depuis le début
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
            <span>Étape 5</span>
            <span>Étape 6</span>
            <span>Étape 7</span>
            <span>Étape 8</span>
            <span>Étape 9</span>
        </div>
    </div>
</form>

</div>

@endsection