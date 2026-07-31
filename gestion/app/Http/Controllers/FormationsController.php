<?php

namespace App\Http\Controllers;

use App\Models\Formation;
use Illuminate\Http\Request;
use App\Http\Requests\StoreFormationRequest;
use App\Models\Specialite;
use App\Models\Formateur;

class FormationsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $statut = $request->statut;
        //recherche par nom
        $formations = Formation::with([
            'formateur',
            'specialite'
        ])
        ->when($search, function ($query) use ($search) {
            $query->where('nom_formation', 'like', "%{$search}%");
        })
        //filtre par statut
        ->when($statut, function ($query) use ($statut) {
            $query->where('statut', $statut);
        })
        ->orderBy('nom_formation', 'asc')   // Tri alphabétique A → Z
        //->get();
        ->paginate(5) // Pagination avec 5 éléments par page
        ->withQueryString();//pour conserver les paramètres de recherche lors de la pagination

        $totalFormations = Formation::count();
        //récupération du nombre de formations par statut
        $formationsInscription = Formation::where('statut', 'en_inscription')->count();
        $formationsEnCours = Formation::where('statut', 'en_cours')->count();
        $formationsTerminees = Formation::where('statut', 'termine')->count();

        //on fait une recherche et renvois la liste des formations concernées 
        return view('formations.liste', compact('formations', 'totalFormations', 'formationsInscription', 'formationsEnCours', 'formationsTerminees'));
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

        $formateur = Formateur::findOrFail($request->formateur_id);

        //create création de ligne dans une bdd donc on prend le modele
        $formation = Formation::create([
            'nom_formation' => $request->nom_formation,
            'date_debut' => $request->date,
            'nb_jours' => $request->capacite,
            'statut' => $request->statut,
            'nb_participant' => $request->nb_participant,
            'formateur_id' => $request->formateur_id,
            'specialite_id' => $request->specialite_id,
        ]);

        //historique
        \App\Helpers\AdminHistory::add(
            "Ajout de la formation : ".$formation->nom_formation." | Référence : ".$formation->ref_formation
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
