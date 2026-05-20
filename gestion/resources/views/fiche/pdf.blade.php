<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <style>

        body{
            font-family: DejaVu Sans, sans-serif;
            margin: 35px;
            color:#000;
            font-size: 12px;
            line-height: 1.7;
        }

        .title{
            text-align: center;
            color:#f0640a;
            font-size: 26px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .separator{
            border-bottom: 3px solid #f0640a;
            margin-bottom: 20px;
        }

        .intro{
            text-align: justify;
            margin-bottom: 25px;
        }

        .section-title{
            font-size: 17px;
            font-weight: bold;
            color:#003366;
            margin-top: 25px;
            margin-bottom: 10px;
        }

        .item{
            margin-left: 18px;
            margin-bottom: 6px;
            text-align: justify;
        }

        .conclusion{
            margin-top: 15px;
            text-align: justify;
        }

    </style>

</head>

<body>

    <!-- TITRE -->

    <div class="title">
        FORMATION <br>
        {{ $designation }}
    </div>

    <div class="separator"></div>

    <!-- INTRODUCTION -->

    <div class="intro">
        {{ $description }}
    </div>

    <!-- SECTION 1 

    <div class="section-title">
        1. Contenu de la Formation et Déroulement
    </div>
-->
    <!-- SECTION 2 -->

    <div class="section-title">
        2. Outils et Supports Utilisés
    </div>
    <?php foreach ($outils as $outil): 
        if (trim($outil) !== ''): ?>
        <div class="item">
            • {{ $outil }}
        </div>
        <?php endif; 
    endforeach;?>

    <!-- SECTION 3 -->

    <div class="section-title">
        3. Bénéfices pour les Participants
    </div>

    <?php foreach ($benefices as $benefice): 
        if (trim($benefice) !== ''): ?>
        <div class="item">
            • {{ $benefice }}
        </div>
        <?php endif; 
    endforeach;?>

    <!-- SECTION 4 -->

    <div class="section-title">
        4. Public Cible
    </div>

    <?php foreach ($public as $public): 
        if (trim($public) !== ''): ?>
        <div class="item">
            • {{ $public }}
        </div>
        <?php endif; 
    endforeach;?>

    <!-- SECTION 5 -->

    <div class="section-title">
        5. Prérequis
    </div>

    <?php foreach ($prerequis as $prerequis): 
        if (trim($prerequis) !== ''): ?>
        <div class="item">
            • {{ $prerequis }}
        </div>
        <?php endif; 
    endforeach;?>

    <!-- SECTION 6 -->

    <div class="section-title">
        6. Objectifs de la Formation
    </div>

    <?php foreach ($objectifs as $objectif): 
        if (trim($objectif) !== ''): ?>
        <div class="item">
            • {{ $objectif }}
        </div>
        <?php endif; 
    endforeach;?>

    <!-- CONCLUSION -->

    <div class="section-title">
        7. Conclusion
    </div>
    <?php foreach ($conclusion as $conclusion): 
        if (trim($conclusion) !== ''): ?>
        <div class="item">
            {{ $conclusion }}
        </div>
        <?php endif; 
    endforeach;?>

</body>
</html>