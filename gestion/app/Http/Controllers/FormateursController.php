<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use App\Models\Specialite;
use App\Models\Formateur;

class FormateursController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $search = $request->search;
        $specialite = $request->specialite;

        $formateurs = Formateur::with('specialites')

        // Recherche par nom ou prénom
        ->when($search, function ($query) use ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('nom_formateur', 'like', "%{$search}%")
                  ->orWhere('prenom_formateur', 'like', "%{$search}%");
            });
        })

        // Filtre par spécialité
        ->when($specialite, function ($query) use ($specialite) {
            $query->whereHas('specialites', function ($q) use ($specialite) {
                $q->where('specialites.id', $specialite);
            });
        })
        // Tri alphabétique
        ->orderBy('nom_formateur', 'asc')
        // Pagination
        ->paginate(5)
        // Conserver les paramètres dans la pagination
        ->withQueryString();

        // Liste des spécialités pour le filtre
        $specialites = Specialite::orderBy('nom_specialite')->get();

        //récupération du nombre total de formateurs
        $totalFormateurs = Formateur::count();

        //récupération du nombre de chaque spécialité pour les cadres
        $specialitesStat = Specialite::withCount('formateurs')
        ->orderBy('nom_specialite')
        ->get();

        return view('formateurs.liste', compact('formateurs', 'specialites', 'totalFormateurs', 'specialitesStat'));

    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialites = Specialite::all();
        return view('formateurs.create', compact('specialites'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //validation
        //unique:formateurs,email : La valeur saisie doit être unique dans la colonne email de la table formateurs.
        $validator = Validator::make($request->all(),[
            //les règles
            'nom_formateur' => 'required',
            'prenom_formateur' => 'required',
            'email' => 'nullable|email|unique:formateurs,email|required_without:telephone',
            'telephone' => [
                'nullable',
                'required_without:email',
                'regex:/^(\+261|261|0)(32|33|34|38)[0-9]{7}$/',
            ],
            'specialites' => 'required|array',
            'specialites.*' => 'distinct|exists:specialites,id',
        ],
        [
            //les messages d'erreurs
            'nom_formateur.required' => 'Le nom est obligatoire.',
            'prenom_formateur.required' => 'Le prénom est obligatoire.',

            'email.required_without' => 'Veuillez renseigner un email ou un numéro de téléphone.',
            'email.email' => 'L\'adresse email est invalide.',
            'email.unique' => 'Cette adresse email est déjà utilisée.',

            'telephone.required_without' => 'Veuillez renseigner un numéro de téléphone ou une adresse email.',

            'specialites.required' => 'Veuillez sélectionner au moins une spécialité.',
            'specialites.*.exists' => 'Une spécialité sélectionnée est invalide.',
        ]);
        //vérifie si la validation est ok ou non
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator)
                ->withInput();
        }
        $formateur = Formateur::create([
            'nom_formateur' => $request->nom_formateur,
            'prenom_formateur' => $request->prenom_formateur,
            'email' => $request->email,
            'telephone' => $request->telephone
        ]);

        //attach() : Il ajoute automatiquement les lignes dans la table formateur_specialite(table de lien entre eux)
        $formateur->specialites()->attach($request->specialites);
        //historique
        \App\Helpers\AdminHistory::add(
            "Ajout du formateur : ".$formateur->nom_formateur." ".$formateur->prenom_formateur
        );

        return redirect()->route('formateurs.index')->with('success', 'Formateur ajouté avec succes');
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
        // Récupérer le formateur avec ses spécialités
        $formateur = Formateur::with('specialites')->findOrFail($id);
        
        //retourne le formulaire de modification
        $specialites = Specialite::all();

        return view('formateurs.edit', compact('formateur', 'specialites'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Formateur $formateur)
    {
        //met à jour le formateur sélectionné
        //validation
        $validator = Validator::make($request->all(),[
            'nom_formateur' => 'required',
            'prenom_formateur' => 'required',
            'email' => [
                'nullable',
                'email',
                'required_without:telephone',
                Rule::unique('formateurs', 'email')->ignore($formateur->id),
            ],
            'telephone' => 'nullable|string|max:20|required_without:email',
        ]);

        //'champ' => $request->name
        $formateur->update([
            'nom_formateur' => $request->nom_formateur,
            'prenom_formateur' => $request->prenom_formateur,
            'email' => $request->email,
            'telephone' => $request->telephone,
        ]);
        //sync(): Laravel supprime les anciennes valeurs et garde les nouvelles
        $formateur->specialites()->sync($request->specialites);

        //historique
        \App\Helpers\AdminHistory::add(
            "Modification du formateur : ".$formateur->nom_formateur." ".$formateur->prenom_formateur
        );

        return redirect()
            ->route('formateurs.index')
            ->with('success', 'Formateur modifié avec succès.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Formateur $formateur)
    {
        //historique
        \App\Helpers\AdminHistory::add(
            "Suppression du formateur : ".$formateur->nom_formateur." ".$formateur->prenom_formateur
        );

        $formateur->delete();

        return redirect()
            ->route('formateurs.index')
            ->with('success', 'Formateur supprimé avec succès.');
    }
}