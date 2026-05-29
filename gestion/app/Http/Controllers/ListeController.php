<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ListeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formations = DB::table('formations')
        ->orderBy('id', 'desc')
        ->get();
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
         DB::table('formations')
        ->where('id', $id)
        ->update([
            'nom_formation' =>
                $request->nom_formation
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
