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
    <div id="etape1" class="etape active space-y-5">

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
            <input name="description"
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

        <div id="contenus-container">
            <div class="contenu-block p-5 rounded-2x1 mb-8 relative">
                {{-- TITRE PRINCIPAL --}}
                <div class="field-group">
                    <label class="text-gray-600">Grand contenu</label>
                    <input
                        type="text"
                        name="titres[]"
                        placeholder="Titre"
                        class="w-full mt-2 p-3 border rounded-xl"
                        >
                    <div class="add-main-btn">
                        +
                    </div>
                </div>

                {{-- SOUS CONTENUS --}}
                <div class="sous-contenus mt-6">
                    <div class="field-group sous-item">
                        <input
                            type="text"
                            name="sous_contenus[0][]"
                            class="w-full mt-2 p-3 border rounded-xl"
                            placeholder="Sous contenu"
                        >
                        <div class="add-sub-btn">
                            +
                        </div>
                    </div>
                </div>
            </div>

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
        <!--
        <div>
            <label class="text-gray-600">Nom du client</label>
            <input name="nom"
                   class="w-full mt-2 p-3 border rounded-xl focus:ring-2 focus:ring-blue-400">
        </div>
        Le [] permet d’envoyer plusieurs champs dans Laravel
        -->

        <div class="fields-container">
            <div class="field-group">
                <input
                    type="text"
                    name="outils[]"
                    class="w-full mt-2 p-3 border rounded-xl focus:ring-2 focus:ring-blue-400"
                >
                <div class="add-btn">
                    +
                </div>
            </div>
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
        <!--
        <div>
            <label class="text-gray-600">Nom du client</label>
            <input name="nom"
                   class="w-full mt-2 p-3 border rounded-xl focus:ring-2 focus:ring-blue-400">
        </div>
        -->
        <div class="fields-container">
            <div class="field-group">
                <input
                    type="text"
                    name="benefices[]"
                    class="w-full mt-2 p-3 border rounded-xl focus:ring-2 focus:ring-blue-400"
                >
                <div class="add-btn">
                    +
                </div>
            </div>
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
        <!--
        <div>
            <label class="text-gray-600">Nom du client</label>
            <input name="nom"
                   class="w-full mt-2 p-3 border rounded-xl focus:ring-2 focus:ring-blue-400">
        </div>
        -->
        <div class="fields-container">
            <div class="field-group">
                <input
                    type="text"
                    name="public_cible[]"
                    class="w-full mt-2 p-3 border rounded-xl focus:ring-2 focus:ring-blue-400"
                >
                <div class="add-btn">
                    +
                </div>
            </div>
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
        <!--
        <div>
            <label class="text-gray-600">Nom du client</label>
            <input name="nom"
                   class="w-full mt-2 p-3 border rounded-xl focus:ring-2 focus:ring-blue-400">
        </div>
        -->
        <div class="fields-container">
            <div class="field-group">
                <input
                    type="text"
                    name="prerequis[]"
                    class="w-full mt-2 p-3 border rounded-xl focus:ring-2 focus:ring-blue-400"
                >
                <div class="add-btn">
                    +
                </div>
            </div>
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
        <!-- 
        <div>
            <label class="text-gray-600">Nom du client</label>
            <input name="nom"
                   class="w-full mt-2 p-3 border rounded-xl focus:ring-2 focus:ring-blue-400">
        </div>
        -->
        <div class="fields-container">
            <div class="field-group">
                <input
                    type="text"
                    name="objectifs[]"
                    class="w-full mt-2 p-3 border rounded-xl focus:ring-2 focus:ring-blue-400"
                >
                <div class="add-btn">
                    +
                </div>
            </div>
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
        <!--
        <div>
            <label class="text-gray-600">Nom du client</label>
            <input name="nom"
                   class="w-full mt-2 p-3 border rounded-xl focus:ring-2 focus:ring-blue-400">
        </div>
        -->
        <div class="fields-container">
            <div class="field-group">
                <input
                    type="text"
                    name="conclusion[]"
                    class="w-full mt-2 p-3 border rounded-xl focus:ring-2 focus:ring-blue-400"
                >
                <div class="add-btn">
                    +
                </div>
            </div>
        </div>

        <div class="flex justify-between pt-6">

            <button type="button"
                    onclick="etapePrecedente(8,7);updateProgressFiche(7)"
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
                style="width: 10%;">
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

<style>
/*pour les nouveaux champs ave les boutons + et -*/
    .field-group{
        position:relative;
        margin-bottom:35px;
    }

    .add-btn,
    .add-main-btn,
    .add-sub-btn{
        position:absolute;
        bottom:-14px;
        right:10px;
        width:28px;
        height:28px;
        border-radius:999px;
        background:#2563eb;
        color:white;
        display:flex;
        align-items:center;
        justify-content:center;
        cursor:pointer;
        opacity:0;
        transition:.2s;
        font-weight:bold;
    }

    .remove-btn,
    .remove-main-btn,
    .remove-sub-btn{
    position:absolute;
    bottom:-14px;
    right:45px;
    width:28px;
    height:28px;
    border-radius:999px;
    background:#ef4444;
    color:white;
    display:flex;
    align-items:center;
    justify-content:center;
    cursor:pointer;
    opacity:0;
    transition:.2s;
    font-weight:bold;
    }

    .field-group:hover .remove-main-btn,
    .field-group:hover .remove-sub-btn,
    .field-group:hover .add-main-btn,
    .field-group:hover .add-sub-btn,
    .field-group:hover .remove-btn,
    .field-group:hover .add-btn{
        opacity:1;
    }

</style>

<script>
//fonctionnement btn + et - de l'etape 2
let contenuIndex =1;
document.addEventListener('click', function(e){
    //AJOUTER GRAND CONTENU
    if(e.target.classList.contains('add-main-btn')){
        const container = document.getElementById('contenus-container');
        const newBlock = document.createElement('div');
        newBlock.classList.add(
            'contenu-block',
            'p-5',
            'rounded-2x1',
            'mb-8',
            'relative'
        );
        
        newBlock.innerHTML =`
            <div class="field-group">
                <label class="text-gray-600">Grand contenu</label>
                <input
                    type="text"
                    name="titres[]"
                    placeholder="Titre"
                    class="w-full mt-2 p-3 border rounded-xl"
                >
                <div class="remove-main-btn">
                    -
                </div>
                <div class="add-main-btn">
                   +
                </div>
            </div>

            <div class="sous-contenus mt-6">
                <div class="field-group sous-item">
                    <input
                        type="text"
                        name="sous_contenus[${contenuIndex}][]"
                        class="w-full mt-2 p-3 border rounded-xl"
                        placeholder="Sous contenu"
                    >
                    <div class="add-sub-btn">
                        +
                    </div>
                </div>
            </div>
            

        `;

        container.appendChild(newBlock);
        contenuIndex++;
    }

    //SUPPRIMER GRAND CONTENU
    if(e.target.classList.contains('remove-main-btn')){
        e.target.closest('.contenu-block').remove();
    }

    //AJOUTER SOUS CONTENU
    if(e.target.classList.contains('add-sub-btn')){
        const fieldGroup = e.target.parentElement;
        const container = fieldGroup.parentElement;
        const input = fieldGroup.querySelector('input');
        const inputName = input.getAttribute('name');
        // Création nouveau champ
        const newSous = document.createElement('div');
        newSous.classList.add('field-group','sous-item');
        newSous.innerHTML = `
            <input
                type="text"
                name="${inputName}"
                class="w-full mt-2 p-3 border rounded-xl"
                placeholder="Sous contenu"
            >
            <div class="remove-sub-btn">
                -
            </div>
            <div class="add-sub-btn">
                +
            </div>
        `;
        container.appendChild(newSous);
    }

    //SUPPRIMER SOUS CONTENU
    if(e.target.classList.contains('remove-sub-btn')){
        e.target.parentElement.remove();
    }
});

//pour le fonctionnement des boutons + et -
document.addEventListener('click', function(e){

    //AJOUTER UN CHAMP
    if(e.target.classList.contains('add-btn')){

        const fieldGroup = e.target.parentElement;
        const container = fieldGroup.parentElement;
        const input = fieldGroup.querySelector('input');
        const inputName = input.getAttribute('name');

        // Création nouveau champ
        const newField = document.createElement('div');
        newField.classList.add('field-group');
        newField.innerHTML = `
            <input
                type="text"
                name="${inputName}"
                class="w-full mt-2 p-3 border rounded-xl focus:ring-2 focus:ring-blue-400"
            >
            <div class="remove-btn">
                -
            </div>
            <div class="add-btn">
                +
            </div>
        `;

        container.appendChild(newField);
    }

     // SUPPRIMER UN CHAMP
    if(e.target.classList.contains('remove-btn')){

        e.target.parentElement.remove();

    }
});

</script>

@endsection