<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormationsController;
use App\Http\Controllers\FacturesController;
use App\Http\Controllers\ProformaController;
use App\Http\Controllers\FicheController;
use App\Http\Controllers\ListeController;
use App\Http\Controllers\FormateursController;
use App\Http\Controllers\SpecialitesController;
use App\Http\Controllers\ProfilController;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Auth\PasswordResetController;

Route::get('/', function () {
    return view('welcome');
});
//Composition d'une route 
//Route::protocole HTTP('URL', CONTROLLEUR::class, 'nom de la fontion appeler dans le controlleur')
Route::get('/login', function () {
    return view('welcome');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout');
//resource miantso ny protocole http rehetra toy n get post delete update etc 
Route::resource('formations', FormationsController::class)->middleware('auth');
Route::resource('factures', FacturesController::class)->middleware('auth');
Route::resource('proforma', ProformaController::class)->middleware('auth');
Route::resource('fiche', FicheController::class)->middleware('auth');
Route::resource('liste', ListeController::class)->middleware('auth');
Route::resource('formateurs', FormateursController::class)->middleware('auth');
Route::resource('specialites', SpecialitesController::class)->middleware('auth');

Route::get('/profil', [ProfilController::class, 'edit'])->name('profil.edit');
Route::put('/profil', [ProfilController::class, 'update'])->name('profil.update');

//pour suppression de specialité
Route::delete('/specialites-suppression-multiple', 
    [SpecialitesController::class, 'destroyMultiple'])
    ->name('specialites.destroyMultiple')
    ->middleware('auth');

//pour mdp oublier 
//affiche le formulaire mdp oublier
Route::get('/mot-de-passe-oublie', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
//envoie du lien de reinitialisation de mdp route appeler quan l'utilisateur clique sur envoyer 
Route::post('/mot-de-passe-oublie', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
//affiche la page de nouveau mdp 
Route::get('/reinitialiser-mot-de-passe/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
//Enregistrement du nouveau mdp
Route::post('/reinitialiser-mot-de-passe', [PasswordResetController::class, 'reset'])->name('password.update');