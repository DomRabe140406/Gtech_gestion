<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">

    <style>

        body{
            font-family: DejaVu Sans, sans-serif;
            margin: 35px;
            color:#000;
        }

        .title{
            text-align: center;
            color:rgb(163, 24, 24);
            font-size: 26px;
            margin-bottom: 10px;
        }

        .separator{
            border-bottom: 3px solid rgb(163, 24, 24);
            margin-bottom: 20px;
        }

        .intro{
            font-size:15px;
            text-align: justify;
        }

        .section-title{
            font-size: 20px;
            font-weight: bold;
            color:rgb(163, 24, 24);
            margin-top:10px;
        }

        .grand-titre{
            font-size: 17px;
            margin-left:50px;
        }

        .item{
            font-size:15px;
            margin-left: 60px;
            text-align: justify;
        }

        .conclusion{
            font-size:15px;
            text-align: justify;
        }

    </style>

</head>

<body>

    <!-- TITRE -->

    <div class="title">
        FORMATION <br>
        <strong>{{ $designation }}</strong>
    </div>

    <div class="separator"></div>

    <!-- INTRODUCTION -->

    <div class="intro">
        {{ $description }}
    </div>

    <!-- SECTION 1 -->

    <div class="section-title">
        1. Contenu de la Formation et Déroulement
    </div>
    <?php foreach ($titres as $index => $titre):
        if (trim($titre) !== ''): ?>
            <div class="grand-titre">
                <strong>{{ $titre }}</strong>
            </div>
            <?php foreach ($sousContenus[$index] ?? [] as $sous):
                if(trim($sous) !== ''): ?>
                    <div class="item">
                        • {{ $sous }}
                    </div>
                <?php endif;
            endforeach;?>
        <?php endif;
    endforeach;?>

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
        <div class="conclusion">
            {{ $conclusion }}
        </div>
        <?php endif; 
    endforeach;?>

</body>
</html>