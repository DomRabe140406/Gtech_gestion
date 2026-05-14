<!DOCTYPE html>
<html lang="fr">

<head>
<meta charset="UTF-8">

<style>

    body{
        font-family: DejaVu Sans, sans-serif;
        font-size:12px;
        margin:25px;
        color:#000;
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

    .orange{
        color:#f0640a;
    }

    .gray{
        color:gray;
    }

    .box{
        border:1px solid black;
        padding:12px;
    }

    table{
        width:100%;
        border-collapse: collapse;
    }

    .table th,
    .table td{
        border:1px solid black;
        padding:7px;
    }

    .table th{
        font-weight:bold;
        text-align:center;
    }

    .conditions{
        margin-top:50px;
        line-height:1.5;
        font-size:13px;
    }

    .signature{
        margin-top:60px;
    }

</style>

</head>

<body>

    <!-- LOGO -->
    <div class="center">
        <img
            src="{{ public_path('img/Logo.png') }}"
            width="120"
        >
    </div>

    <div class="center gray" style="margin-top:10px;">
        "Ny Fahaizana no ampinga enti-miady"
    </div>

    <!-- TITRE -->
    <div
        class="center"
        style="
            margin-top:20px;
            border:2px solid #f0640a;
            padding:15px;
        "
    >
        <div
            class="bold orange"
            style="font-size:24px;"
        >
            FACTURE PROFORMA
        </div>
    </div>

    <div class="center" style="margin-top:10px;">
        <span class="bold">Numéro :</span>
        PRO-F{{ $date1 }}
        <br>
        <span class="bold">Date :</span>
        {{ $date_proforma }}
    </div>

    <div
        class="center orange bold"
        style="
            margin-top:25px;
            font-size:24px;
        "
    >
        Formation {{ $designation }}
    </div>

    <!-- BLOCS -->
    <table style="margin-top:35px;
            font-size:13px;
            ">

        <tr>

            <!-- ENTREPRISE -->
            <td
                class="box"
                style="
                    width:48%;
                    vertical-align:top;
                "
            >

                <div class="bold" style="font-size:15px;">
                    Gasy Tech
                </div>
                <span class="bold">Adresse :</span>
                Anjanahary, Antananarivo
                <br>
                <span class="bold">Email :</span>
                contact@gasy-tech.com
                <br>
                <span class="bold">Telephone :</span>
                034 68 994 76
                <br>
                <span class="bold">NIF :</span>
                6005717692
                <br>
                <span class="bold">STAT :</span>
                74908 11 2021 0 07713
                <br>
                <span class="bold">RCS :</span>
                2024 A 01833
                <br>
                <span class="bold">
                    Site web :
                </span>
                <span style="color:blue;
                    text-decoration:underline;">
                    www.gasy-tech.com
                </span>

            </td>

            <td style="width:2%;"></td>

            <!-- CLIENT -->
            <td
                class="box"
                style="
                    width:48%;
                    vertical-align:top;
                "
            >

                <div class="bold">
                    Destinataire :
                </div>
                <span class="bold">
                    Nom :
                </span>
                {{ $client }}
                <br>
                <span class="bold">
                    Adresse :
                </span>
                {{ $adresse }}
            </td>
        </tr>

    </table>
    <br><br>

    <!-- TABLEAU -->
    <div
        class="bold"
        style="
            margin-top:30px;
            margin-bottom:10px;
            font-size:14px;
        "
    >
        DÉTAILS DE LA FORMATION
    </div>

    <table class="table">

        <thead>
            <tr>
                <th>Ref.</th>
                <th>Déscription</th>
                <th>Durée</th>
                <th>Prix (Ar)</th>
                <th>Total (Ar)</th>
            </tr>
        </thead>

        <tbody>
            <tr>
                <td>
                    {{ $ref }}
                </td>
                <td>
                    Formation: {{ $designation }}
                </td>
                <td>
                    {{ $duree }} jour(s)
                </td>
                <td>
                    {{ formatNumber($montant_unitaire) }}
                </td>
                <td>
                    {{ formatNumber($montant_service) }}
                </td>
            </tr>

            <tr>
                <td>
                    REPAS/TRANSPORT
                </td>
                <td>
                    Indemnite de repas et transport
                </td>
                <td>
                    {{ $duree }} jour(s)
                </td>
                <td>
                    {{ formatNumber($indemnite) }}
                </td>
                <td>
                    {{ formatNumber($montant_indemnite) }}
                </td>
            </tr>

        </tbody>

    </table>

    <!-- TOTAL -->
    <div style="margin-top:25px;">
        <div class="bold">
            TOTAL GÉNÉRAL
        </div>
        <br>
        Montant total HT :
        {{ formatNumber($montant_total_HT) }} Ar
        <br>
        TVA ({{ $tva }}%) :
        {{ formatNumber($tva_total) }} Ar
        <br>
        <span
            class="bold"
            style="
                background:yellow;
            "
        >
            Montant total TTC :
            {{ formatNumber($total) }} Ar
        </span>
    </div>
    <br><br><br>
    <!-- CONDITIONS -->
    <div class="conditions">

        <div class="bold" style="font-size:13px;">
            CONDITIONS
        </div>

        @foreach($conditions as $condition)
                @if($condition['type'] == 'subitem')
                    <div style="margin:0px 0px 0px 80px;">
                        {{ $condition['text'] }}
                    </div>
                @elseif($condition['type'] == 'subtitle')
                    <div style="margin:0px 0px 0px 50px;">
                        {{ $condition['text'] }}
                    </div>
                @else
                <div style="margin:10px 0px 0px 30px;">
                    {{ $condition['text'] }}
                </div>
                    @endif
        @endforeach

    </div>

    <!-- SIGNATURE -->
    <div class="signature right">

        Signature

        <br><br><br><br><br>

        RAMAHEFARITOLOTRA Rafaly Antoni

    </div>

</body>
</html>