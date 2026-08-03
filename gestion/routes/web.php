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

Route::get('/login', function () {
    return view('welcome');
})->name('login');

Route::post('/login', [AuthController::class, 'login']);

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware('auth')
    ->name('dashboard');

Route::get('/logout', [AuthController::class, 'logout'])
    ->name('logout');

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

Route::get('/mot-de-passe-oublie', [PasswordResetController::class, 'showLinkRequestForm'])->name('password.request');
Route::post('/mot-de-passe-oublie', [PasswordResetController::class, 'sendResetLinkEmail'])->name('password.email');
Route::get('/reinitialiser-mot-de-passe/{token}', [PasswordResetController::class, 'showResetForm'])->name('password.reset');
Route::post('/reinitialiser-mot-de-passe', [PasswordResetController::class, 'reset'])->name('password.update');