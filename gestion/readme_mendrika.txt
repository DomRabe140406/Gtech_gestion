1)Facture
- ajout des dossiers Helpers(pour les fonction utiles) 
- modification de store() dans FactureController
- modificatin de create.blade pour la generation de facture: selection de formation et date_debut et durée sont selectionnés automatiquement
- creation de pdf.blade.php pour la mise en forme du facture généré
- gestion de quelques erreurs si champ vide
NB: faire composer install pour mettre à jour les packages composer utilisé (dompdf, modification de autoload)
    si probleme sur les fonctions, faire composer dump-autoload

2) Proforma
- creation de ProformaController(qui appel pdf.blade) et create.blade(formulaire) pour la generation de proforma
- creation de pdf.blade.php pour la mise en forme du proforma généré
- modification de app.blade pour la redirection, et web.php pour que laravel connait la route

3)Formation
- ajout champ ref_formation (entrainant petite modification dans FormationController, migration et Modele de formation)(utile pour le proforma)
- modification de create.blade d'ajout de formation

4) Fiche de formation (pas encore au point)
- creation de FicheController(qui appel pdf.blade) et create.blade(formulaire) pour la generation de la fiche
- creation de pdf.blade.php pour la mise en forme du fiche généré 
- modification de app.blade pour la redirection, et web.php pour que laravel connait la route