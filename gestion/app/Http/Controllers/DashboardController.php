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
    public function index()
    {
        $total = Formation::count();

        //récupération du nombre total de formateurs
        $totalFormateurs = Formateur::count();

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

        $totalFactures = FactureDownload::whereMonth('downloaded_at', now()->month)
        ->whereYear('downloaded_at', now()->year)
        ->count();

        $totalProforma = ProformaDownload::whereMonth('downloaded_at', now()->month)
        ->whereYear('downloaded_at', now()->year)
        ->count();

        $totalFiches = FicheDownload::whereMonth('downloaded_at', now()->month)
        ->whereYear('downloaded_at', now()->year)
        ->count();
        //pour le graphe
        //on récupère les données( date de création et le nombre de formations créées par mois) de la table formations
        // Toutes les formations regroupées par mois
        $formations = Formation::select(
                DB::raw('YEAR(created_at) as annee'),
                DB::raw('MONTH(created_at) as mois'),
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('annee', 'mois')
            ->get();

        // Tableau associatif
        $donnees = [];

        foreach ($formations as $formation) {

            $cle = $formation->annee.'-'.$formation->mois;

            $donnees[$cle] = $formation->total;
        }

        // Déterminer le premier mois de la base
        $premiereFormation = Formation::orderBy('created_at')->first();

        if ($premiereFormation) {
            $debut = Carbon::parse($premiereFormation->created_at)->startOfMonth();
        } else {
            //si aucune formation n'existe, on prend le mois actuel comme début
            $debut = now()->startOfMonth();
        }

        // Dernier mois = après 11 mois à partir du premier mois
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
            'totalFiches'
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
