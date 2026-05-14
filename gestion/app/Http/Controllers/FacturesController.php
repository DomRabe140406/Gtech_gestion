<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FacturesController extends Controller
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
        return view ('factures.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // =========================
        // DONNÉES
        // =========================

        $client = $request->input('nom') ?: 'Client inconnu';
        $adresse = $request->input('adresse') ?: 'Adresse inconnue';

        $formation = DB::table('formations')
            ->where('id', $request->input('designation'))
            ->first();
        if($formation == null){
            $date_debut_affiche = '';
            $date_fin_affiche = '';
        } else{
            $date_debut = $formation->date_debut;
            $date_fin = Carbon::parse($date_debut)
                ->addDays($duree - 1);
            $date_debut_affiche = Carbon::parse($date_debut)
                ->format('d/m/Y');
            $date_fin_affiche = $date_fin->format('d/m/Y');
        }
        $duree = (double)($formation->nb_jours ?? 0);
        $designation = $formation->nom_formation ?? 'Formation inconnue';
        $montant_unitaire = (double)$request->input('prix', 0);
        $indemnite = (double)$request->input('indemnite', 0);
        $tva = (double)$request->input('tva', 0);
        $date_facture = Carbon::now()->format('d/m/Y');
        $date1 = Carbon::now()->format('Y-m');

        // =========================
        // CALCULS
        // =========================

        $montant_service = $duree * $montant_unitaire;
        $montant_indemnite = $duree * $indemnite;
        $tva_total =
            ($montant_service + $montant_indemnite)
            * ($tva / 100);
        $total =
            $montant_service
            + $montant_indemnite
            + $tva_total;
        $lettre = nombreEnLettres((int)$total);
        // =========================
        // PDF
        // =========================
        //“Prends la vue Blade factures.pdf et transforme son HTML en PDF.”
        $pdf = Pdf::loadView('factures.pdf', [

            'client' => $client,
            'adresse' => $adresse,
            'designation' => $designation,

            'duree' => $duree,

            'date_facture' => $date_facture,
            'date_debut_affiche' => $date_debut_affiche,
            'date_fin_affiche' => $date_fin_affiche,

            'montant_unitaire' => $montant_unitaire,
            'montant_service' => $montant_service,

            'indemnite' => $indemnite,
            'montant_indemnite' => $montant_indemnite,

            'tva' => $tva,
            'tva_total' => $tva_total,

            'total' => $total,

            'lettre' => $lettre,

            'date1' => $date1

        ]);

        $pdf->setPaper('A4', 'portrait');

        $filename =
            'facture_gasy_tech_' .
            Carbon::now()->format('Y-m-d_His') .
            '.pdf';

        // =========================
        // APERÇU
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
