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

5)Dashboard
- cercle doughnut pour affiché le pourcentage des formations en inscription,en cours et termine avec total

6)Liste
- par ordre alphabetique avec pagination (par 10)
- fonction de recherche
- ajout de la colonne statut avec couleur respectif

7)Connexion
- icone œil/œil barré
____________________________________________________________________________

NB: pour ajouter un admin
Dans le terminal de mon projet:
php artisan tinker
use App\Models\User;

User::create([
    'name' => 'Admin',
    'email' => 'admin@gmail.com',
    'password' => bcrypt('motdepasse123')
]);
exit

________________________________________________________________________________

CREATION PROJET LARAVEL
- composer create-project laravel/laravel mon_projet(1)  ou  laravel new mon_projet(2)
- cd mon_projet
- php artisan serve : lancer le serveur
- accéder à http://127.0.0.1:8000


NB:(1)pas de décision à prendre mais laravel s'installe avec sa configuration par defaut
   (2)Les choix pour débuter:
      -Starter Kit: None
      -Framework Front-end: Blade
      - Dark Mode: Yes/No
      - Testing Framework: Pest
      - Database: MySQL
      - Migration initiale: Yes (pour que laravel crée immédiatement users,password_reset_tokens et sessions)
      - Installation des dépendances Node.js: Yes(pour exécuter auto npm install et npm run build) / No (si je le ferai plus tard manuellement)

CONFIGURATION BDD
- Dans php my admin, créer une nouvelle bdd
- modifier le fichier .env : DB_DATABASE=ma_base
- tester la connexion: php artisan migrate

CREER LES MIGRATIONS (la base de données)
php artisan make:migration create_formations_table
modifier le fichier par mes contenus
php artisan migrate

CREER LES MODELES
php artisan make:model Formation
modifier par mes contenus

CREER LES CONTROLEURS
php artsain make:controller FormationController  ou  php artisan make:controller FormationController --resource (pour permettre les fonctions par defaut)

DEFINIR LES ROUTES
ex: Route::resource('formations', FormationController::class);
Route::get('/formations', ...);
Route::post('/formations', ...);

CREER LES VUES BLADE (html)