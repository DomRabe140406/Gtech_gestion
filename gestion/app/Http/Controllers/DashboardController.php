<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Formation;
use App\Helpers\AdminHistory;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $total = Formation::count();

        $enInscription = Formation::where(
            'statut',
            'en_inscription'
        )->count();

        $enCours = Formation::where(
            'statut',
            'en_cours'
        )->count();

        $termine = Formation::where(
            'statut',
            'termine'
        )->count();

        $history = AdminHistory::get();//pour afficher l'historique de l'admin sur le dashboard

        return view('dashboard', compact(
            'total',
            'enInscription',
            'enCours',
            'termine',
            'history'
        ));
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
