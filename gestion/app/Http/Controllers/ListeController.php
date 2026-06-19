<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Formation;

class ListeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formations = DB::table('formations')
        ->orderBy('nom_formation', 'asc')
        //->get();
        ->paginate(10); // Pagination avec 10 éléments par page

        return view('formations.liste', compact('formations'));
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
        $formation = DB::table('formations')
        ->where('id', $id)
        ->first();

        return view('formations.edit', compact('formation'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(),[
            'ref_formation' => 'required',
            'nom_formation' => 'required',
            'date_debut' => 'required|date|after_or_equal:today',
            'statut' => 'required' ,
        ]);
        //validation des données
        //after_or_equal:today: il faut que la date soit supérieur ou égal à la date d'aujourd'hui
        /*$request->validate([
            'ref_formation' => 'required',
            'nom_formation' => 'required',
            'date_debut' => 'required|date|after_or_equal:today',
            'statut' => 'required' , ]);*/

        /*Va chercher dans la table formations l'enregistrement dont l'id vaut $id, stocke-le dans $formation
        et si cet enregistrement n'existe pas, retourne automatiquement une erreur 404.*/
        $formation = Formation::findOrFail($id);

        DB::table('formations')
        ->where('id', $id)
        ->update([
            'nom_formation' => $request->nom_formation,
            'date_debut' => $request->date_debut,
            'ref_formation' => $request->ref_formation,
            'statut' => $request->statut
        ]);

        return redirect()
            ->route('liste.index')
            ->with('success', 'Formation modifiée');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        DB::table('formations')
        ->where('id', $id)
        ->delete();

        return redirect()
            ->route('liste.index')
            ->with('success', 'Formation supprimée');
    }
}
