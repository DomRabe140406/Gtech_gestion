<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Specialite;

class SpecialitesController extends Controller
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
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nom_specialite' => 'required|string|unique:specialites,nom_specialite',
        ], [
            'nom_specialite.required' => 'Veuillez saisir le nom de la spécialité.',
            'nom_specialite.unique'   => 'Cette spécialité existe déjà.',
        ]);

        Specialite::create([
            'nom_specialite' => $request->nom_specialite,
        ]);

        //historique
        \App\Helpers\AdminHistory::add(
            "Ajout de la spécialité : ".$request->nom_specialite
        );
        return back()->with('success', 'La spécialité a été ajoutée avec succès.');
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
    public function destroyMultiple(Request $request)
    {
        //l'admin doit cocher au moins 1 s'il clique sur Supprimer
        $request->validate([
            'specialites' => 'required|array|min:1',
            'specialites.*' => 'exists:specialites,id'
        ],[
            'specialites.required' => 'Veuillez sélectionner au moins une spécialité.'
        ]);
        
        foreach($request->specialites as $id)
        {
            $specialite = Specialite::find($id);

            if($specialite)
            {
                // supprimer les relations avec les formateurs
                $specialite->formateurs()->detach();

                // supprimer la spécialité
                $specialite->delete();
            }
        }

        return redirect()
            ->back()
            ->with('success', 'Spécialité supprimée avec succès.');
    }
}
