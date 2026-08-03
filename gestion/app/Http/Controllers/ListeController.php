<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Formation;
use App\Models\Specialite;
use App\Models\Formateur;
use Carbon\Carbon;

class ListeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        // ==========================================
        // Mise à jour automatique des statuts
        // ==========================================

        $aujourdhui = Carbon::today();

        // Les formations qui doivent passer en cours
        $formationsEnCours = Formation::whereDate('date_debut', '<=', $aujourdhui)
            ->where('statut', 'en_inscription')
            ->get();

        foreach ($formationsEnCours as $formation) {

            $formation->update([
                'statut' => 'en_cours'
            ]);

            //historique
            \App\Helpers\AdminHistory::add(
                "Changement automatique du statut de la formation (en_cours): ".$formation->nom_formation." | Référence : ".$formation->specialite->nom_specialite
            );
        }

        // Les formations qui doivent être terminées
        $formationsEnCours = Formation::where('statut', 'en_cours')->get();

        foreach ($formationsEnCours as $formation) {
            // Calcul de la date de fin
            $dateFin = Carbon::parse($formation->date_debut)
                    ->addDays($formation->nb_jours - 1); 
            // Si la date de fin est dépassée
            //Si la date d'aujourd'hui est strictement supérieure à la date de fin de la formation.
            // est une méthode de Carbon qui signifie Greater Than (supérieur à)
            if ($aujourdhui->gt($dateFin)) {

                $formation->update([
                    'statut' => 'termine'
                ]);
                //historique
                \App\Helpers\AdminHistory::add(
                    "Changement automatique du statut de la formation (termine): ".$formation->nom_formation." | Référence : ".$formation->specialite->nom_specialite
                );
            }
        }

        // ==========================================
        // Liste complète
        // ==========================================
        $search = $request->search;
        $statut = $request->statut;

        $formations = Formation::with(['formateur', 'specialite'])
        ->when($search, function ($query) use ($search) {
            $query->where('nom_formation', 'like', "%{$search}%");
        })
        ->when($statut, function ($query) use ($statut) {
            $query->where('statut', $statut);
        })
        ->orderBy('nom_formation', 'asc')
        //->get();
        ->paginate(5) // Pagination avec 5 éléments par page
        ->withQueryString();

        $totalFormations = Formation::count();
        //récupération du nombre de formations par statut
        $formationsInscription = Formation::where('statut', 'en_inscription')->count();
        $formationsEnCours = Formation::where('statut', 'en_cours')->count();
        $formationsTerminees = Formation::where('statut', 'termine')->count();

        return view('formations.liste', compact('formations', 'totalFormations', 'formationsInscription', 'formationsEnCours', 'formationsTerminees'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
    public function edit($id)
    {
        //pour modifier une formation, on va chercher la formation dont l'id est $id et on retourne la vue de modification
        $formation = Formation::findOrFail($id);
        $specialites = Specialite::all();
        $formateurs = Formateur::all();

        return view(
            'formations.edit',
            compact('formation', 'specialites', 'formateurs')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        //validation des données
        //after_or_equal:today: il faut que la date soit supérieur ou égal à la date d'aujourd'hui
        $validator = Validator::make($request->all(),[
            'ref_formation' => 'required',
            'nom_formation' => 'required',
            'date_debut' => 'required|date|after_or_equal:today',
            'statut' => 'required' ,
        ]);

        /*Va chercher dans la table formations l'enregistrement dont l'id vaut $id, stocke-le dans $formation
        et si cet enregistrement n'existe pas, retourne automatiquement une erreur 404.*/
        $formation = Formation::findOrFail($id);
        
        if($request->statut == 'en_inscription' && Carbon::parse($request->date_debut)<= Carbon::today()) {
            $request->date_debut = Carbon::today()->addDays(1);
        }

        $formation->update([
            'nom_formation' => $request->nom_formation,
            'date_debut' => $request->date_debut,
            'nb_jours' => $request->nb_jours,
            'statut' => $request->statut,
            'specialite_id' => $request->specialite_id,
            'formateur_id' => $request->formateur_id,
        ]);

        //historique
        \App\Helpers\AdminHistory::add(
            "Modification de la formation : ".$formation->nom_formation." | Référence : ".$formation->specialite->nom_specialite
        );
        return redirect()
            ->route('liste.index')
            ->with('success', 'Formation modifiée');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //historique
        $formation = Formation::findOrFail($id);
        \App\Helpers\AdminHistory::add(
            "Suppression de la formation : ".$formation->nom_formation." | Référence : ".$formation->specialite->nom_specialite
        );

        $formation->delete();
        
        return redirect()
            ->route('liste.index')
            ->with('success', 'Formation supprimée');
    }
}
