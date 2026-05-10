1)Facture
- ajout des dossiers Helpers(pour les fonction utiles) et Services(pour les classes notamment PDFService pour la creation de pdf)
- modification de store() dans FactureController
- modificatin de create.blade pour la generation de facture: selection de formation et date_debut et durée sont selectionnés automatiquement
- gestion de quelques erreurs si champ vide
NB: faire composer install pour mettre à jour les packages composer utilisé (setasign/fpdf, modification de autoload)
    si probleme sur les fonctions, faire composer dump-autoload

2) Proforma
- creation de ProformaController et create.blade pour la generation de proforma
- modification de app.blade pour la redirection, et web.php pour que laravel connait la route

3)Formation
- ajout champ ref_formation (entrainant petite modification dans FormationController, migration et Modele de formation)(utile pour le proforma)
- modification de create.balde d'ajout de formation