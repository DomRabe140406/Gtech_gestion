<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;

class FicheController extends Controller
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
        return view ('fiche.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $designation = DB::table('formations')
            ->where('id', $request->input('designation'))
            ->value('nom_formation');
        if($designation == null){
            $designation = 'Inconnue';
        }
        $description = $request->input('description') ?: 'Aucune description';

        //$contenus = $request->contenu_formation;
        $outils = $request->outils;
        $benefices = $request->benefices;
        $public = $request->public_cible;
        $prerequis = $request->prerequis;
        $objectifs = $request->objectifs;
        $conclusion = $request->conclusion;

        $pdf = Pdf::loadView('fiche.pdf', [
            'designation' => $designation,
            'description' => $description,
            'outils' => $outils,
            'benefices' => $benefices,
            'public' => $public,
            'prerequis' => $prerequis,
            'objectifs' => $objectifs,
            'conclusion' => $conclusion
        ]);

        // =========================
        // OUTPUT
        // =========================
                
        $filename = 'fiche_gasy_tech_' . Carbon::now()->format('Y-m-d_His') . '.pdf';
        // =========================
        // APERCU
        // =========================
        if ($request->has('btn_apercu')) {
            return $pdf->stream($filename);
        }

        // =========================
        // TÉLÉCHARGEMENT
        // =========================
        if ($request->has('btn_telecharge')) {
            return $pdf->download($filename);
        }
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
