@extends('layouts.app')
@section('title', 'Création Fiche de formation')
@section('content')

<div class="min-h-screen flex items-start justify-center bg-gray-100 dark:bg-gray-900 py-10 px-4 transition-colors duration-300">

<form id="form_principale" action="{{ route('fiche.store') }}" method="POST"
      class="bg-white dark:bg-gray-800 w-full max-w-2xl p-10 rounded-3xl shadow-2xl border border-transparent dark:border-gray-700 transition-colors duration-300">

    @csrf

    <h2 class="text-3xl font-bold text-gray-700 dark:text-gray-100 mb-8 text-center">
        Création de fiche de formation
    </h2>

    <!-- ETAPE 1 -->
    <div id="etape1" class="etape active space-y-5">

        <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-300">Formation</h3>
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

        <div>
            <label class="text-gray-600 dark:text-gray-300">Description</label>
            <input name="description"
                   class="w-full mt-2 p-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                          focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500 transition-colors">
        </div>

        <div class="flex justify-between pt-6">
            <button type="button" onclick="etapeSuivante(1,2);updateProgressFiche(2)"
                    class="bg-blue-500 hover:bg-blue-600 dark:bg-blue-900/40 dark:hover:bg-blue-500
                           text-white px-6 py-3 rounded-xl transition-colors duration-300">
                Suivant
            </button>

            <button type="button" onclick="annulerForm()"
                    class="bg-gray-100 dark:bg-gray-700 hover:bg-red-500 dark:hover:bg-red-600 text-gray-600 dark:text-gray-200 hover:text-white
                           px-6 py-3 rounded-xl transition-colors duration-300 dark:bg-red-900/40">
                Annuler
            </button>
        </div>

    </div>

    <!-- ETAPE 2 -->
    <div id="etape2" class="etape space-y-5">

        <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-300">Contenu de la formation et déroulement</h3>

        <div id="contenus-container">
            <div class="contenu-block p-5 rounded-2xl mb-8 relative bg-gray-50 dark:bg-gray-900/50 border border-gray-200 dark:border-gray-700">

                <div class="field-group">
                    <label class="text-gray-600 dark:text-gray-300">Grand contenu</label>
                    <input type="text" name="titres[]" placeholder="Titre"
                           class="w-full mt-2 p-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                                  focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500 transition-colors">
                    <div class="add-main-btn">+</div>
                </div>

                <div class="sous-contenus mt-6">
                    <div class="field-group sous-item">
                        <input type="text" name="sous_contenus[0][]" placeholder="Sous contenu"
                               class="w-full mt-2 p-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                                      focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500 transition-colors">
                        <div class="add-sub-btn">+</div>
                    </div>
                </div>
            </div>

        </div>

        <div class="flex justify-between pt-6">

            <button type="button" onclick="etapePrecedente(2,1);updateProgressFiche(1)"
                    class="bg-gray-500 hover:bg-gray-600 dark:bg-gray-700/40 dark:hover:bg-gray-600
                           text-white px-6 py-3 rounded-xl transition-colors duration-300">
                Précédent
            </button>

            <button type="button" onclick="etapeSuivante(2,3);updateProgressFiche(3)"
                    class="bg-blue-500 hover:bg-blue-600 dark:bg-blue-900/40 dark:hover:bg-blue-500
                           text-white px-6 py-3 rounded-xl transition-colors duration-300">
                Suivant
            </button>

        </div>

    </div>

    <!-- ETAPE 3 -->
    <div id="etape3" class="etape space-y-5">

        <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-300">Outils et Supports utilisés</h3>
        <div class="fields-container">
            <div class="field-group">
                <input type="text" name="outils[]"
                       class="w-full mt-2 p-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                              focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500 transition-colors">
                <div class="add-btn">+</div>
            </div>
        </div>

        <div class="flex justify-between pt-6">

            <button type="button" onclick="etapePrecedente(3,2);updateProgressFiche(2)"
                    class="bg-gray-500 hover:bg-gray-600 dark:bg-gray-700/40 dark:hover:bg-gray-600 text-white px-6 py-3 rounded-xl transition-colors duration-300">
                Précédent
            </button>

            <button type="button" onclick="etapeSuivante(3,4);updateProgressFiche(4)"
                    class="bg-blue-500 hover:bg-blue-600 dark:bg-blue-900/40 dark:hover:bg-blue-500 text-white px-6 py-3 rounded-xl transition-colors duration-300">
                Suivant
            </button>

        </div>

    </div>

    <!-- ETAPE 4 -->
    <div id="etape4" class="etape space-y-5">

        <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-300">Bénéfices pour les participants</h3>
        <div class="fields-container">
            <div class="field-group">
                <input type="text" name="benefices[]"
                       class="w-full mt-2 p-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                              focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500 transition-colors">
                <div class="add-btn">+</div>
            </div>
        </div>

        <div class="flex justify-between pt-6">

            <button type="button" onclick="etapePrecedente(4,3);updateProgressFiche(3)"
                    class="bg-gray-500 hover:bg-gray-600 dark:bg-gray-900/40 dark:hover:bg-gray-600 text-white px-6 py-3 rounded-xl transition-colors duration-300">
                Précédent
            </button>

            <button type="button" onclick="etapeSuivante(4,5);updateProgressFiche(5)"
                    class="bg-blue-500 hover:bg-blue-600 dark:bg-blue-900/40 dark:hover:bg-blue-500 text-white px-6 py-3 rounded-xl transition-colors duration-300">
                Suivant
            </button>

        </div>

    </div>

    <!-- ETAPE 5 -->
    <div id="etape5" class="etape space-y-5">

        <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-300">Public cible</h3>
        <div class="fields-container">
            <div class="field-group">
                <input type="text" name="public_cible[]"
                    class="w-full mt-2 p-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                           focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500 transition-colors">
                <div class="add-btn">+</div>
            </div>
        </div>

        <div class="flex justify-between pt-6">

            <button type="button" onclick="etapePrecedente(5,4);updateProgressFiche(4)"
                    class="bg-gray-500 hover:bg-gray-600 dark:bg-gray-900/40 dark:hover:bg-gray-600 text-white px-6 py-3 rounded-xl transition-colors duration-300">
                Précédent
            </button>

            <button type="button" onclick="etapeSuivante(5,6);updateProgressFiche(6)"
                    class="bg-blue-500 hover:bg-blue-600 dark:bg-blue-900/40 dark:hover:bg-blue-500 text-white px-6 py-3 rounded-xl transition-colors duration-300">
                Suivant
            </button>

        </div>

    </div>

    <!-- ETAPE 6 -->
    <div id="etape6" class="etape space-y-5">

        <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-300">Prérequis</h3>
        <div class="fields-container">
            <div class="field-group">
                <input type="text" name="prerequis[]"
                       class="w-full mt-2 p-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                              focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500 transition-colors">
                <div class="add-btn">+</div>
            </div>
        </div>

        <div class="flex justify-between pt-6">

            <button type="button" onclick="etapePrecedente(6,5);updateProgressFiche(5)"
                    class="bg-gray-500 hover:bg-gray-600 dark:bg-gray-900/40 dark:hover:bg-gray-600 text-white px-6 py-3 rounded-xl transition-colors duration-300">
                Précédent
            </button>

            <button type="button" onclick="etapeSuivante(6,7);updateProgressFiche(7)"
                    class="bg-blue-500 hover:bg-blue-600 dark:bg-blue-900/40 dark:hover:bg-blue-500 text-white px-6 py-3 rounded-xl transition-colors duration-300">
                Suivant
            </button>

        </div>

    </div>

    <!-- ETAPE 7 -->
    <div id="etape7" class="etape space-y-5">

        <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-300">Objectif(s) de la formation</h3>
        <div class="fields-container">
            <div class="field-group">
                <input type="text" name="objectifs[]"
                       class="w-full mt-2 p-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                              focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500 transition-colors">
                <div class="add-btn">+</div>
            </div>
        </div>

        <div class="flex justify-between pt-6">

            <button type="button" onclick="etapePrecedente(7,6);updateProgressFiche(6)"
                    class="bg-gray-500 hover:bg-gray-600 dark:bg-gray-900/40 dark:hover:bg-gray-600 text-white px-6 py-3 rounded-xl transition-colors duration-300">
                Précédent
            </button>

            <button type="button" onclick="etapeSuivante(7,8);updateProgressFiche(8)"
                    class="bg-blue-500 hover:bg-blue-600 dark:bg-blue-900/40 dark:hover:bg-blue-500 text-white px-6 py-3 rounded-xl transition-colors duration-300">
                Suivant
            </button>

        </div>

    </div>

    <!-- ETAPE 8 -->
    <div id="etape8" class="etape space-y-5">

        <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-300">Conclusion</h3>
        <div class="fields-container">
            <div class="field-group">
                <input type="text" name="conclusion[]"
                       class="w-full mt-2 p-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100
                              focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500 transition-colors">
                <div class="add-btn">+</div>
            </div>
        </div>

        <div class="flex justify-between pt-6">

            <button type="button" onclick="etapePrecedente(8,7);updateProgressFiche(7)"
                    class="bg-gray-500 hover:bg-gray-600 dark:bg-gray-900/40 dark:hover:bg-gray-600 text-white px-6 py-3 rounded-xl transition-colors duration-300">
                Précédent
            </button>

            <button type="button" onclick="etapeSuivante(8,9);updateProgressFiche(9)"
                    class="bg-blue-500 hover:bg-blue-600 dark:bg-blue-900/40 dark:hover:bg-blue-500 text-white px-6 py-3 rounded-xl transition-colors duration-300">
                Suivant
            </button>

        </div>

    </div>

    <!-- ETAPE 9 -->
    <div id="etape9" class="etape space-y-6 text-center">

        <h3 class="text-xl font-semibold text-gray-600 dark:text-gray-300">Finalisation</h3>

        <button type="submit" name="btn_apercu" onclick="document.getElementById('form_principale').target='_blank'"
                class="w-full bg-green-500 hover:bg-green-600 dark:bg-green-600 dark:hover:bg-green-500 text-white px-6 py-3 rounded-xl transition-colors duration-300">
            Aperçu PDF
        </button>

        <button type="submit" name="btn_telecharge" onclick="document.getElementById('form_principale').target='_self'"
                class="w-full bg-blue-500 hover:bg-blue-600 dark:bg-blue-600 dark:hover:bg-blue-500 text-white px-6 py-3 rounded-xl transition-colors duration-300">
            Télécharger PDF
        </button>

        <button type="button" onclick="etapePrecedente(9,8);updateProgressFiche(8)" class="text-gray-500 dark:text-gray-400  underline cursor-pointer">
            Retour à l'étape précédente
        </button>
        <br>
        <button type="button" onclick="etapePrecedente(9,1);updateProgressFiche(1)" class="text-gray-500 dark:text-gray-400 underline cursor-pointer">
            Retour depuis le début
        </button>

    </div>

    <!-- Barre de progression -->
    <div class="mt-10">

        <div class="flex items-center justify-between mb-2">
            <span id="stepLabel" class="text-sm font-medium text-gray-600 dark:text-gray-300">Étape 1 sur 9</span>
            <span id="stepPercent" class="text-sm text-gray-400 dark:text-gray-500">10%</span>
        </div>

        <div class="flex gap-1.5">
            @for($i = 1; $i <= 9; $i++)
                <div id="segment{{ $i }}"
                     class="h-2 flex-1 rounded-full {{ $i == 1 ? 'bg-blue-500' : 'bg-gray-200 dark:bg-gray-700' }} transition-colors duration-300">
                </div>
            @endfor
        </div>

    </div>

</form>

</div>

<style>
    .field-group{
        position:relative; margin-bottom:35px;
    }

    .add-btn,
    .add-main-btn,
    .add-sub-btn{
        position:absolute; bottom:-14px;right:10px;width:28px;height:28px;border-radius:999px;background:#2563eb;color:white;display:flex;align-items:center;
        justify-content:center;cursor:pointer;opacity:0;transition:.2s;font-weight:bold;
    }

    .remove-btn,
    .remove-main-btn,
    .remove-sub-btn{
        position:absolute;bottom:-14px;right:45px;width:28px;height:28px;border-radius:999px;background:#ef4444;color:white;display:flex;align-items:center;
        justify-content:center;cursor:pointer;opacity:0;transition:.2s;font-weight:bold;
    }

    .field-group:hover .remove-main-btn,
    .field-group:hover .remove-sub-btn,
    .field-group:hover .add-main-btn,
    .field-group:hover .add-sub-btn,
    .field-group:hover .remove-btn,
    .field-group:hover .add-btn{opacity:1;}

    /* Dark mode pour les inputs générés dynamiquement en JS */
    .dark .contenu-block,
    .dark .field-group input{background-color: #111827;border-color: #4b5563;color: #f3f4f6;}

    .dark .field-group label{color: #d1d5db;}
</style>

<script>

// PROGRESSION
function updateProgressFiche(step)
{
    const largeurs = {1:10,2:25,3:35,4:45,5:55,6:65,7:75,8:87.5,9:100};
    const stepLabel = document.getElementById("stepLabel");
    const stepPercent = document.getElementById("stepPercent");

    if (stepLabel) stepLabel.textContent = "Étape " + step + " sur 9";
    if (stepPercent) stepPercent.textContent = Math.round(largeurs[step]) + "%";

    for (let i = 1; i <= 9; i++) {
        const segment = document.getElementById("segment" + i);
        if (!segment) continue;

        if (i <= step) {
            segment.classList.remove("bg-gray-200", "dark:bg-gray-700");
            segment.classList.add("bg-blue-500");
        } else {
            segment.classList.remove("bg-blue-500");
            segment.classList.add("bg-gray-200", "dark:bg-gray-700");
        }
    }
}

// GESTION DES CHAMPS DYNAMIQUES (+ / -)
let contenuIndex = 1;

document.addEventListener('click', function(e){

    if(e.target.classList.contains('add-main-btn')){
        const container = document.getElementById('contenus-container');
        const newBlock = document.createElement('div');
        newBlock.classList.add('contenu-block','p-5','rounded-2xl','mb-8','relative','bg-gray-50','dark:bg-gray-900/50','border','border-gray-200','dark:border-gray-700');

        newBlock.innerHTML = `
            <div class="field-group">
                <label class="text-gray-600 dark:text-gray-300">Grand contenu</label>
                <input type="text" name="titres[]" placeholder="Titre"
                       class="w-full mt-2 p-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500 transition-colors">
                <div class="remove-main-btn">-</div>
                <div class="add-main-btn">+</div>
            </div>

            <div class="sous-contenus mt-6">
                <div class="field-group sous-item">
                    <input type="text" name="sous_contenus[${contenuIndex}][]" placeholder="Sous contenu"
                           class="w-full mt-2 p-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500 transition-colors">
                    <div class="add-sub-btn">+</div>
                </div>
            </div>
        `;

        container.appendChild(newBlock);
        contenuIndex++;
    }

    if(e.target.classList.contains('remove-main-btn')){
        e.target.closest('.contenu-block').remove();
    }

    if(e.target.classList.contains('add-sub-btn')){
        const fieldGroup = e.target.parentElement;
        const container = fieldGroup.parentElement;
        const input = fieldGroup.querySelector('input');
        const inputName = input.getAttribute('name');

        const newSous = document.createElement('div');
        newSous.classList.add('field-group','sous-item');
        newSous.innerHTML = `
            <input type="text" name="${inputName}" placeholder="Sous contenu"
                   class="w-full mt-2 p-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500 transition-colors">
            <div class="remove-sub-btn">-</div>
            <div class="add-sub-btn">+</div>
        `;
        container.appendChild(newSous);
    }

    if(e.target.classList.contains('remove-sub-btn')){
        e.target.parentElement.remove();
    }
});

document.addEventListener('click', function(e){

    if(e.target.classList.contains('add-btn')){
        const fieldGroup = e.target.parentElement;
        const container = fieldGroup.parentElement;
        const input = fieldGroup.querySelector('input');
        const inputName = input.getAttribute('name');

        const newField = document.createElement('div');
        newField.classList.add('field-group');
        newField.innerHTML = `
            <input type="text" name="${inputName}"
                   class="w-full mt-2 p-3 border border-gray-300 dark:border-gray-600 rounded-xl bg-white dark:bg-gray-900 text-gray-800 dark:text-gray-100 focus:outline-none focus:ring-2 focus:ring-blue-400 dark:focus:ring-blue-500 transition-colors">
            <div class="remove-btn">-</div>
            <div class="add-btn">+</div>
        `;

        container.appendChild(newField);
    }

    if(e.target.classList.contains('remove-btn')){
        e.target.parentElement.remove();
    }
});
</script>

@endsection