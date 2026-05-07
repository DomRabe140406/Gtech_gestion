<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;

class FormationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view ('formations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    /*Fonction sert a enregistrer qlq chose dans une bdd*/
    public function store(Request $request)
    { //create création de ligne dans une bdd donc on prend le modele
        Formation::create([
            'nom_formation' => $request->nom_formation,
            'date_debut' => $request->date,
            'nb_jours' => $request->capacite,
            'nb_participant' => $request->nb_participant,
            'nom_formateur' => $request->nom_formateur,
            'prenom_formateur' => $request->prenom_formateur,
        ]);
        return redirect()->back()->with('success', 'Formation ajoutée avec succes');
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
