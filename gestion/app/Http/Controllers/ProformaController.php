<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class ProformaController extends Controller
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
        return view ('proforma.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // =========================
        // DONNEES
        // =========================
        $date_proforma = Carbon::now()->format('d/m/Y');
        $client = $request->input('nom') ?: 'Client inconnu';
        $adresse = $request->input('adresse') ?: 'Adresse inconnue';
        $formation = DB::table('formations')
            ->where('id', $request->designation)
            ->first();
        $duree = (double)($formation->nb_jours ?? 0);
        $designation = $formation->nom_formation ?? 'inconnue';
        $ref = $formation->ref_formation ?? 'Référence inconnue';
        $date1 = Carbon::now()->format('Y-m');
        $montant_unitaire = (double)($request->input('prix', 0));
        $indemnite = (double)($request->input('indemnite', 0));
        $tva = (double)($request->input('tva', 0));

        //calcul montant
        $montant_service = $duree * $montant_unitaire;
        $montant_indemnite = $duree * $indemnite;
        $montant_total_HT = $montant_service + $montant_indemnite;
        $tva_total = $montant_total_HT * ($tva / 100);
        $total = $montant_total_HT + $tva_total;

        $conditions = [

            [
                'type' => 'normal',
                'text' => "1. Cette facture proforma ne constitue pas une facture définitive."
            ],
            [
                'type' => 'normal',
                'text' => "2. Si le nombre de participants inscrits dépasse vingt-cinq (25) personnes, un supplément de cent mille (100 000) Ariary par jour sera facturé afin de couvrir les frais additionnels. De plus, un formateur supplémentaire sera mobilisé par nos soins afin de garantir un encadrement pédagogique optimal."
            ],
            [
                'type' => 'normal',
                'text' => "3. 100% du montant total doit être réglé au plus tard 60 jours après la fin de la formation."
            ],
            [
                'type' => 'normal',
                'text' => "4. Si le paiement n'est pas effectué dans les 60 jours suivant la fin de la formation, une pénalité de 40 000 Ar par jour de retard sera appliquée, à compter du jour suivant la fin de la formation et jusqu'au règlement complet du paiement."
            ],
            [
                'type' => 'normal',
                'text' => "5. La formation débutera uniquement après réception de l'e-mail de validation, lequel devra être envoyé au plus tard trois (3) jours avant la date de début de la formation."
            ],
            [
                'type' => 'title',
                'text' => "6. Modes de paiement acceptés"
            ],
            [
                'type' => 'subtitle',
                'text' => "• Virement bancaire :"
            ],
            [
                'type' => 'subitem',
                'text' => "➢ BANQUE : BRED Madagasikara"
            ],
            [
                'type' => 'subitem',
                'text' => "➢ RIB : 00008 00024 05003023618 71"
            ],
            [
                'type' => 'subitem',
                'text' => "➢ NOM : GASY TECH"
            ],
            [
                'type' => 'subtitle',
                'text' => "• Paiement par Orange Money au numéro 032 05 504 93 (Les frais de retrait seront à la charge du client et ajoutés au montant total à régler)."
            ],
            [
                'type' => 'title',
                'text' => "7. Annulation et paiement en cas de non-participation :"
            ],
            [
                'type' => 'subtitle',
                'text' => "• En cas d'annulation du contrat de la part du client, le paiement complet devra être effectué après la date de formation prévue, même si la formation n'a pas eu lieu."
            ],
            [
                'type' => 'subtitle',
                'text' => "• Aucune formation ne pourra être remboursée en cas d'annulation à moins d'une situation exceptionnelle validée par Gasy Tech."
            ],
            [
                'type' => 'normal',
                'text' => "8. La formation sera assurée par un formateur qualifié et se déroulera à ".$client.", situé à ".$adresse."."
            ]
        ];
        // =========================
        // PDF
        // =========================

        $pdf = Pdf::loadView('proforma.pdf', [

            'date_proforma' => $date_proforma,
            'date1' => $date1,

            'client' => $client,
            'adresse' => $adresse,
            'designation' => $designation,
            'ref' => $ref,
            'duree' => $duree,

            'montant_unitaire' => $montant_unitaire,
            'indemnite' => $indemnite,
            'tva' => $tva,
            'montant_service' => $montant_service,
            'montant_indemnite' => $montant_indemnite,
            'montant_total_HT' => $montant_total_HT,
            'tva_total' => $tva_total,
            'total' => $total,

            'conditions' => $conditions

        ]);
        
        $pdf->setPaper('A4', 'portrait');
        $filename = 'proforma_gasy_tech_' . Carbon::now()->format('Y-m-d_His') . '.pdf';

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
