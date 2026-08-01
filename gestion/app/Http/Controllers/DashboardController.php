<?php

namespace App\Http\Controllers;

use App\Models\FicheDownload;
use App\Models\ProformaDownload;
use App\Models\FactureDownload;
use Illuminate\Http\Request;
use App\Models\Formation;
use App\Models\Formateur;
use App\Helpers\AdminHistory;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     */


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
    public function index()
    {
        $total = Formation::count();

        // récupération du nombre total de formateurs
        $totalFormateurs = Formateur::count();

        $enInscription = Formation::where('statut', 'en_inscription')->count();
        $enCours = Formation::where('statut', 'en_cours')->count();
        $termine = Formation::where('statut', 'termine')->count();

        $history = AdminHistory::get();

        $totalFactures = FactureDownload::whereMonth('downloaded_at', now()->month)
            ->whereYear('downloaded_at', now()->year)
            ->count();

        $totalProforma = ProformaDownload::whereMonth('downloaded_at', now()->month)
            ->whereYear('downloaded_at', now()->year)
            ->count();

        $totalFiches = FicheDownload::whereMonth('downloaded_at', now()->month)
            ->whereYear('downloaded_at', now()->year)
            ->count();

        // Comparaison des valeurs avec ceux du mois derniers

        $moisDernier = now()->subMonth();

        $formateursCeMois = Formateur::whereMonth('created_at', now()->month)
            ->whereYear('created_at', now()->year)
            ->count();

        $formateursMoisDernier = Formateur::whereMonth('created_at', $moisDernier->month)
            ->whereYear('created_at', $moisDernier->year)
            ->count();

        $facturesMoisDernier = FactureDownload::whereMonth('downloaded_at', $moisDernier->month)
            ->whereYear('downloaded_at', $moisDernier->year)
            ->count();

        $proformaMoisDernier = ProformaDownload::whereMonth('downloaded_at', $moisDernier->month)
            ->whereYear('downloaded_at', $moisDernier->year)
            ->count();

        $fichesMoisDernier = FicheDownload::whereMonth('downloaded_at', $moisDernier->month)
            ->whereYear('downloaded_at', $moisDernier->year)
            ->count();

        $formationsCeMois = Formation::whereMonth('created_at', now()->month)
        ->whereYear('created_at', now()->year)
        ->count();

        $formationsMoisDernier = Formation::whereMonth('created_at', $moisDernier->month)
        ->whereYear('created_at', $moisDernier->year)
        ->count();

        
        $ecartFormations = $formationsCeMois - $formationsMoisDernier;
        $ecartFormateurs = $formateursCeMois - $formateursMoisDernier;
        $ecartFactures = $totalFactures - $facturesMoisDernier;
        $ecartProforma = $totalProforma - $proformaMoisDernier;
        $ecartFiches = $totalFiches - $fichesMoisDernier;

        // Graphe

        $formations = Formation::select(
                DB::raw('YEAR(created_at) as annee'),
                DB::raw('MONTH(created_at) as mois'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('annee', 'mois')
            ->get();

        $donnees = [];
        foreach ($formations as $formation) {
            $cle = $formation->annee.'-'.$formation->mois;
            $donnees[$cle] = $formation->total;
        }

        $premiereFormation = Formation::orderBy('created_at')->first();

        if ($premiereFormation) {
            $debut = Carbon::parse($premiereFormation->created_at)->startOfMonth();
        } else {
            $debut = now()->startOfMonth();
        }

        $fin = $debut->copy()->addMonths(11);

        $labels = [];
        $data = [];
        while ($debut <= $fin) {
            $cle = $debut->year.'-'.$debut->month;
            $labels[] = $debut->translatedFormat('M Y');
            $data[] = $donnees[$cle] ?? 0;
            $debut->addMonth();
        }

        return view('dashboard', compact(
            'total',
            'totalFormateurs',
            'enInscription',
            'enCours',
            'termine',
            'history',
            'labels',
            'data',
            'totalFactures',
            'totalProforma',
            'totalFiches',
            'ecartFormateurs',
            'ecartFactures',
            'ecartProforma',
            'ecartFiches',
            'ecartFormations'
        ));
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
