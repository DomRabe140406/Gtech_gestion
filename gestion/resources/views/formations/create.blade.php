@extends('layouts.app')

@section('title', 'Ajouter Formation')

@section('content')

<form id="form_principale" action="{{ route('formations.store') }}" method="POST">

    @csrf

    <!-- Etape 1 -->
    <div id="etape1" class="etape active">
        <h3>Ajouter une formation</h3>

        <label>Nom formation:</label><br>
        <input type="text" name="nom_formation" required><br><br>

        <label>Date de début:</label><br>
        <input type="date" name="date" required><br><br>

        <label>Nombre de jours:</label><br>
        <input type="number" name="capacite" min="1" value="5"><br><br>

        <button type="button" onclick="etapeSuivante(1,2)">Suivant</button>
        <button type="button" onclick="annulerForm()">Annuler</button>
    </div>

    <!-- Etape 2 -->
    <div id="etape2" class="etape">
        <h3>Nombre de participant</h3>

        <label>Nombre de participant:</label><br>
        <input type="number" name="nb_participant" min="0" value="20"><br><br>

        <button type="button" onclick="etapePrecedente(2,1)">Précédent</button>
        <button type="button" onclick="etapeSuivante(2,3)">Suivant</button>
        <button type="button" onclick="annulerForm()">Annuler</button>
    </div>

    <!-- Etape 3 -->
    <div id="etape3" class="etape">
        <h3>Ajout Formateur</h3>

        <label>Nom formateur:</label><br>
        <input type="text" name="nom_formateur"><br><br>

        <label>Prénom formateur:</label><br>
        <input type="text" name="prenom_formateur"><br><br>

        <button type="button" onclick="etapePrecedente(3,2)">Précédent</button>
        <button type="submit">Envoyer</button>
        <button type="button" onclick="annulerForm()">Annuler</button>
    </div>

</form>

@endsection