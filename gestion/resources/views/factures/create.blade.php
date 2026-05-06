@extends('layouts.app')

@section('title', 'Création Facture')

@section('content')

<section id="Facture">
    <h2>Création de facture</h2>

    <form action="{{ route('factures.store') }}" method="POST">
        @csrf

        <!-- ETAPE 1 -->
        <div id="etape1" class="etape active">
            <h3>Client</h3>

            <label>Nom du client:</label><br>
            <input name="nom" placeholder="Nom client"><br><br>

            <label>Adresse du client:</label><br>
            <input name="adresse" placeholder="Adresse"><br><br>

            <button type="button" onclick="etapeSuivante(1,2)">Suivant</button>
            <button type="button" onclick="annulerForm()">Annuler</button>
        </div>

        <!-- ETAPE 2 -->
        <div id="etape2" class="etape">
            <h3>Formation</h3>

            <label>Date début:</label><br>
            <input type="date" name="date_debut"><br><br>

            <label>Date fin:</label><br>
            <input type="date" name="date_fin"><br><br>

            <select name="designation">
                <option value="">Choisir la formation</option>

                @foreach($formations ?? [] as $r)
                    <option value="{{ $r->id_formation }}">
                        {{ $r->titre_formation }}
                    </option>
                @endforeach
            </select><br><br>

            <button type="button" onclick="etapePrecedente(2,1)">Précédent</button>
            <button type="button" onclick="etapeSuivante(2,3)">Suivant</button>
            <button type="button" onclick="annulerForm()">Annuler</button>
        </div>

        <!-- ETAPE 3 -->
        <div id="etape3" class="etape">
            <h3>Frais</h3>

            <label>Prix Formation:</label><br>
            <input type="number" name="prix" min="100"><br><br>

            <label>Indemnité:</label><br>
            <input type="number" name="indemnite" min="100"><br><br>

            <label>TVA:</label><br>
            <input type="number" name="tva" min="0"><br><br>

            <button type="button" onclick="etapePrecedente(3,2)">Précédent</button>
            <button type="button" onclick="etapeSuivante(3,4)">Suivant</button>
            <button type="button" onclick="annulerForm()">Annuler</button>
        </div>

        <!-- ETAPE 4 -->
        <div id="etape4" class="etape">
            <h3>PDF créée</h3>

            <button type="submit" name="btn_apercu" class="btn btn-success">
                Aperçu PDF
            </button>

            <button type="submit" name="btn_telecharge" class="btn btn-success">
                Télécharger PDF
            </button>
        </div>

    </form>
</section>

@endsection