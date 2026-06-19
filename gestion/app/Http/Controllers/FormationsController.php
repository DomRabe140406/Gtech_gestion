<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;

class FormationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;

        $formations = Formation::when($search, function ($query) use ($search) {

            $query->where('nom_formation', 'like', "%{$search}%");

        })
        ->orderBy('nom_formation', 'asc')   // Tri alphabétique A → Z
        //->get();
        ->paginate(10) // Pagination avec 10 éléments par page
        ->withQueryString();//pour conserver les paramètres de recherche lors de la pagination

        //on fait une recherche et renvois la liste des formations concernées 
        return view('formations.liste', compact('formations'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //creation de formation donc on retourne la vue de creation
        return view ('formations.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    /*Fonction sert a enregistrer qlq chose dans une bdd*/
    public function store(Request $request)
    { 
        //validation des données
        //after:today: il faut que la date soit strictement supérieur à la date d'aujourd'hui
        $request->validate([
        'ref_formation' => 'required',
        'nom_formation' => 'required',
        'date' => 'required|date|after:today',
        'statut' => 'required|in:en_inscription,en_cours,termine' ]);
        
        //create création de ligne dans une bdd donc on prend le modele
        Formation::create([
            'ref_formation' => $request->ref_formation,
            'nom_formation' => $request->nom_formation,
            'date_debut' => $request->date,
            'nb_jours' => $request->capacite,
            'statut' => $request->statut,
            'nb_participant' => $request->nb_participant,
            'nom_formateur' => $request->nom_formateur,
            'prenom_formateur' => $request->prenom_formateur,
        ]);
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
