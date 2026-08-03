<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFormationRequest;
use App\Models\Specialite;
use App\Models\Formateur;
use Carbon\Carbon;

class FormationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //creation de formation donc on retourne la vue de creation
        $specialites = Specialite::all();
        $formateurs = Formateur::all();
        return view ('formations.create', compact('specialites', 'formateurs'));
    }

    /**
     * Store a newly created resource in storage.
     */
    /*Fonction sert a enregistrer qlq chose dans une bdd*/
    public function store(StoreFormationRequest $request)
    { 
        //validation des données est fait grâce à la requête StoreFormationRequest

        //create création de ligne dans une bdd donc on prend le modele
        $formation = Formation::create([
            'nom_formation' => $request->nom_formation,
            'date_debut' => $request->date,
            'nb_jours' => $request->capacite,
            'statut' => $request->statut,
            'nb_participant' => $request->nb_participant,
            'formateur_id' => $request->formateur_id ?: null,
            'specialite_id' => $request->specialite_id,
        ]);
        //historique
        \App\Helpers\AdminHistory::add(
            "Ajout de la formation : ".$formation->nom_formation." | Référence : ".$formation->specialite->nom_specialite
        );
        return redirect()->route('liste.index')->with('success', 'Formation ajoutée avec succes');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
