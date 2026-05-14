<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <style>

        body{
            font-family: DejaVu Sans, sans-serif;
            font-size: 12px;
            margin: 20px;
            color:#000;
        }

        table{
            width:100%;
            border-collapse: collapse;
        }

        .no-border td{
            border:none;
        }

        .center{
            text-align:center;
        }

        .right{
            text-align:right;
        }

        .bold{
            font-weight:bold;
        }

        .underline{
            text-decoration: underline;
        }

        .blue{
            color:rgb(2, 82, 202);
        }

        .small-space{
            height:10px;
        }
/*
        .facture-table th,
        .facture-table td{
            border:3px solid black;
            padding:8px;
            vertical-align:middle;
        }

        .facture-table th{
            font-weight:bold;
            text-align:center;
        }*/

        .bank-box{
            border:1px solid black;
            padding:12px;
            margin-top:30px;
            height:100px;
        }

        .signature{
            margin-top:40px;
        }

        .signature td{
            border:none;
        }

        .mt-20{
            margin-top:20px;
        }

    </style>
</head>

<body>

    <!-- EN TETE -->

    <table class="no-border">
        <tr>
            <td style="width:30%;">
                Entreprise:
            </td>
            <td style="
                text-align:center;">
                GASY TECH
            </td>
            <td style="width:35%;
                text-align:center;">
                Antananarivo le <span class="underline">{{ $date_facture }}</span>
            </td>
        </tr>
        <tr>
            <td style="width:10%;">
                Adresse:
            </td>
            <td style="
                width:40%;
                text-align:center;">
                Anjanahary Antananarivo, Madagascar
            </td>
        </tr>
        <tr>
            <td style="width:30%;">
                NIF/STAT:
            </td>
            <td style="
                text-align:center;">
                6005717692/74908 112021 0 07713
            </td>
        </tr>
        <tr>
            <td class="underline" style="width:30%;">
                RCS:
            </td>
            <td style="
                text-align:center;">
                2024 A 01833
            </td>
            <td style="width:35%;
                text-align:center;">
                Doit            
            </td>
        </tr>
        <tr>
            <td class="underline" style="width:30%;">
                Email:
            </td>
            <td class="blue underline" style="
                text-align:center;">
                contact@gasy-tech.com
            </td>
            <td style="width:35%;
                text-align:center;">
                <span class="bold">{{ $client }}</span><br>
                {{$adresse}}
            </td>
        </tr>
    </table>

    <!-- BOX BLEU -->
    <table
        style="
            border:3px solid #5bcdf3;
            margin:20px 0px 20px 120px;
            width:60%;
        "
    >
        <tr>
            <td style="border:none;
                padding:10px 0px 5px 10px;">

                <span class="bold">
                    Date de formation achevée :
                </span>

                {{ $date_debut_affiche }}
                au
                {{ $date_fin_affiche }}

            </td>
        </tr>

        <tr>
            <td style="border:none;
                    padding:0px 0px 5px 10px;">

                <span class="bold">
                    N° Proforma GT :
                </span>

                PRO-F{{ $date1 }}

            </td>
        </tr>

        <tr>
            <td style="border:none;
                    padding:0px 0px 5px 10px;">

                <span class="bold">
                    N° de BC :
                </span>

                DREECI/IOE-03.03.N0250011

            </td>
        </tr>

    </table>

    <!-- TABLEAU -->
    <table>
        <thead style="border:2px solid black;">
            <tr>
                <th style="width:45%;
                    border:2px solid black;
                ">
                    Désignation
                </th>

                <th style="width:18%;
                        border:2px solid black;
                ">
                    Quantité
                    <br>
                    (Nb Jour Travaillé)
                </th>

                <th style="width:18%;
                        border:2px solid black;
                ">
                    Montant en ariary
                </th>

                <th style="width:19%;
                        border:2px solid black;
                ">
                    Montant Total (TTC)
                </th>

            </tr>
        </thead>

        <tbody>

            <tr>

                <td style="border-right:2px solid black;
                    border-left:2px solid black;
                    text-align:center;">
                    {{ $designation }}
                </td>

                <td class="center">
                    {{ $duree }}
                </td>

                <td class="right" style="border-right:2px solid black;
                    border-left:2px solid black;">
                    {{ formatNumber($montant_unitaire) }}
                </td>

                <td class="right" style="border-right:2px solid black;">
                    {{ formatNumber($montant_service) }}
                </td>

            </tr>

            <tr>

                <td style="border-right:2px solid black;
                    border-left:2px solid black;
                    text-align:center;">
                    Indemnité de repas et transport
                </td>

                <td class="center">
                    {{ $duree }}
                </td>

                <td class="right" style="border-right:2px solid black;
                    border-left:2px solid black;">
                    {{ formatNumber($indemnite) }}
                </td>

                <td class="right" style="border-right:2px solid black;">
                    {{ formatNumber($montant_indemnite) }}
                </td>

            </tr>

            <tr>

                <td style="border-right:2px solid black;
                    border-left:2px solid black;
                    border-bottom:2px solid black;
                    text-align:center;">
                    TVA
                </td>

                <td class="center" style="border-bottom:2px solid black;">
                    {{ $tva }}%
                </td>

                <td class="right" style="border-right:2px solid black;
                    border-left:2px solid black;">
                    {{ formatNumber($tva_total) }}
                </td>

                <td class="right" style="border-right:2px solid black;">
                    {{ formatNumber($tva_total) }}
                </td>

            </tr>

            <tr>
                <td class="center"></td>
                <td class="center"></td>

                <td class="right bold" style="border:2px solid black;">
                    Total
                </td>

                <td class="right bold" style="border:2px solid black;">
                    {{ formatNumber($total) }}
                </td>
            </tr>
        </tbody>
    </table>

    <!-- MONTANT LETTRES -->
    <div class="mt-20">
        <span class="bold">
            Arrêté à la somme de
        </span>
        "
        {{ ucfirst($lettre) }}
        ariary
        "
    </div>

    <!-- CONDITIONS -->
    <div class="mt-20">
        <div class="bold">
            Conditions de paiement
        </div>
        <div>
            Les modes de paiements acceptés sont le virement bancaire et Orange Money
        </div>
    </div>

    <!-- DETAILS BANCAIRES -->
    <div class="bank-box">
        <div class="bold">
            Détails bancaire
        </div>
        <div>
            ➢ BANQUE : BRED Madagasikara
        </div>
        <div>
            ➢ RIB : 00008 00024 05003023618 71
        </div>
        <div>
            ➢ NOM : GASY TECH
        </div>
        <div>
            <span class="bold">
                Numero Orange money:
            </span>
            032 05 504 93
        </div>
    </div>

    <!-- SIGNATURE -->
    <table class="signature">
        <tr>
            <td style="width:50%;" class="center underline">
                Le Client
            </td>

            <td style="width:50%;" class="center underline">
                Le Fournisseur
            </td>

        </tr>
        <br><br>
        <tr>
            <td style="height:80px;"></td>

            <td class="center">
                RAMAHEFARITOLOTRA Rafaly Antoni
                <br>
                CEO et Gérant de Gasy Tech
            </td>
        </tr>
    </table>

</body>
</html>