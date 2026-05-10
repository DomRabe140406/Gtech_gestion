<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\PDFService;
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
        $date_proforma = Carbon::now()->format('d/m/Y');
        $client = $request->input('nom') ?: 'Client inconnu';
        $adresse = $request->input('adresse') ?: 'Adresse inconnue';
        $duree = (double)DB::table('formations')
            ->where('id', $request->input('designation'))
            ->value('nb_jours');
        $designation = DB::table('formations')
            ->where('id', $request->input('designation'))
            ->value('nom_formation');
        $ref = DB::table('formations')
            ->where('id', $request->input('designation'))
            ->value('ref_formation');
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

        $pdf = new PDFService();
        $pdf->AddPage();
        // =====================
        // EN TETE
        // =====================
        $pdf->Ln(70);
        $pdf->Image(public_path('img/Logo.png'),85,70,30);
        $pdf->SetFont('Arial','I',10);
        $pdf->SetTextColor(128,128,128);
        $pdf->Cell(0,5,'"Ny Fahaizana no ampinga enti-miady"',0,1,'C');
        $pdf->Ln(15);
        $pdf->SetFont('Arial','B',20);
        $pdf->SetTextColor(240,100,10);
        $pdf->SetDrawColor(240,100,10);
        $pdf->Cell(0,0,' ',0,1,'C');
        $pdf->MultiCell(0,8,"FACTURE PROFORMA
                        ",1,'C');
        $pdf->Ln(1);
        $pdf->SetTextColor(0,0,0);
        $pdf->SetDrawColor(0,0,0);
        $pdf->SetFont('Arial','',9);
        $pdf->Cell(0,5,'Numero : PRO-F'.$date1,0,1,'C');
        $pdf->Cell(0,5,'Date : '.$date_proforma,0,1,'C');
        $pdf->Ln(10);
        $pdf->SetFont('Arial','B',19);
        $pdf->SetTextColor(240,100,10);
        $pdf->Cell(0,0,'Formation '.$designation,0,1,'C');
        $pdf->Ln(20);

        // =====================
        // BLOC ENTREPRISE
        // =====================
        $x = $pdf->GetX();
        $y = $pdf->GetY();

        $pdf->Rect($x-3,$y,95,65);
        $pdf->Rect($x+97,$y,95,65);

        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(100,10,'Gasy Tech',0,0);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(0,10,'Destinataire :',0,1);
        $pdf->Cell(17,0,'Adresse : ',0,0);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(83,0,'Anjanahary, Antananarivo',0,0);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(11,0,'Nom : ',0,0);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(0,0,$client,0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(13,10,'Email : ',0,0);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(87,10,'contact@gasy-tech.com',0,0);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(17,10,'Adresse : ',0,0);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(0,10,$adresse,0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(20,0,'Telephone : ',0,0);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(0,0,'034 68 994 76',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(9,10,'NIF : ',0,0);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(0,10,'6005717692',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(12,0,'STAT : ',0,0);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(0,0,'74908 11 2021 0 07713',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(10,10,'RCS : ',0,0);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(0,10,'2024 A 01833',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(17,0,'Site web : ',0,0);
        $pdf->SetFont('Arial','U',10);
        $pdf->SetTextColor(0,100,255);
        $pdf->Cell(0,0,'www.gasy-tech.com',0,1);
        $pdf->Ln(75);

        // =====================
        // TITRE TABLEAU
        // =====================
        $pdf->SetTextColor(0,0,0);
        $pdf->SetFont('Arial','B',12);
        $pdf->Cell(0,6,'DETAILS DE LA FORMATION',0,1);
        $pdf->Ln(2);

        // =====================
        // TABLEAU
        // =====================
        $test = true;
        $pdf->SetWidths([40, 60, 20, 30, 30]);

        $pdf->SetFont('Arial','B',11);
        // En-tête
        $pdf->Row(["Ref.", "Description", "Duree", "Prix (Ar)", "Total (Ar)"],$test);

        $pdf->SetFont('Arial','',10);
        //
        $pdf->Row([$ref, $designation, $duree." jour(s)", formatNumber($montant_unitaire), formatNumber($montant_service)],$test);
        $pdf->Row(["REPAS/TRANSPORT", "Indemnite de repas et transport", $duree." jour(s)", formatNumber($indemnite), formatNumber($montant_indemnite)],$test);

        /* =====================
        // TOTAL
        GetStringWidth(): calcul la longueur exacte d'un texte
        // =====================*/
        $pdf->Ln(15);
        $x = $pdf->GetX();
        $y = $pdf->GetY();

        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(0,0,'TOTAL GENERAL',0,1);
        $pdf->Ln(7);
        $pdf->SetFont('Arial','',10);
        $pdf->Cell(30,0,'Montant total HT : '.formatNumber($montant_total_HT).' Ar',0,1);
        //$pdf->Cell(0,0,'825 000 Ar',0,1);
        $pdf->Cell(15,10,'TVA ('.$tva.'%) : '.formatNumber($tva_total).' Ar',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->SetFillColor(255,255,0);
        $pdf->Cell(35,5,'Montant total TTC : ',0,0,'',true);
        $text = formatNumber($total).' Ar';
        $w = $pdf->GetStringWidth($text) + 2; // + marge interne(padding)
        $pdf->Cell($w,5,$text,0,1,'',true);
        $pdf->Ln(10);

        // =====================
        // CONDITIONS
        // =====================
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(0,0,'CONDITIONS',0,1);
        $pdf->Ln(3);
        $pdf->SetFont('Arial','',10);
        $conditions = [
            "1. Cette facture proforma ne constitue pas une facture définitive.",
            "2. Si le nombre de participants inscrits dépasse vingt-cinq (25) personnes, un supplément de cent mille (100 000) Ariary par jour sera facturé afin de couvrir les frais additionnels. De plus, un formateur supplémentaire sera mobilisé par nos soins afin de garantir un encadrement pédagogique optimal.",
            "3. 100% du montant total doit être réglé au plus tard 60 jours après la fin de la formation.",
            "4. Si le paiement n'est pas effectué dans les 60 jours suivant la fin de la formation, une pénalité de 40 000 Ar par jour de retard sera appliquée, à compter du jour suivant la fin de la formation et jusqu'au règlement complet du paiement.",
            "5. La formation débutera uniquement après réception de l'e-mail de validation, lequel devra être envoyé au plus tard trois (3) jours avant la date de début de la formation.",
            "6. Modes de paiement acceptés",
            "   • Virement bancaire :",
            "       ➢ BANQUE : BRED Madagasikara",
            "       ➢ RIB : 00008 00024 05003023618 71",
            "       ➢ NOM : GASY TECH",
            "   • Paiement par Orange Money au numéro 032 05 504 93 (Les frais de retrait seront à la charge du client et ajoutés au montant total à régler).",
            "7. Annulation et paiement en cas de non-participation :",
            "   • En cas d'annulation du contrat de la part du client, le paiement complet devra être effectué après la date de formation prévue, même si la formation n'a pas eu lieu.",
            "   • Aucune formation ne pourra être remboursée en cas d'annulation à moins d'une situation exceptionnelle validée par Gasy Tech.",
            "8. La formation sera assurée par un formateur qualifié et se déroulera à ".$client.", situé à ".$adresse."."
        ];
        foreach ($conditions as $condition) {
            // Vérifier si on approche du bas de page
            if ($pdf->GetY() > 260) {
                $pdf->AddPage();
            }
            $pdf->Cell(6,7,'',0,0);
            $pdf->MultiCell(0, 7, $condition, 0);
            $pdf->Ln(2);
        }

        // =====================
        // SIGNATURE
        // =====================
        $pdf->Ln(40);
        $pdf->Cell(310,5,'Signature',0,1,'C');
        $pdf->Ln(20);
        $pdf->Cell(0,5,'RAMAHEFARITOLOTRA Rafaly Antoni',0,1,'R');

        //$pdf->Output();

        $filename = 'proforma_gasy_tech_' . Carbon::now()->format('Y-m-d_His') . '.pdf';
        if($request->has('btn_apercu')) {
            return response($pdf->Output('S'), 200)
                ->header('Content-Type', 'application/pdf');
        }else if($request->has('btn_telecharge')){
            return response($pdf->Output('S'), 200)
                ->header('Content-Type', 'application/pdf')
                ->header('Content-Disposition', 'attachment; filename="'.$filename.'"');
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
