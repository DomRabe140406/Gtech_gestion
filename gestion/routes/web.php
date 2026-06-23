<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormationsController;
use App\Http\Controllers\FacturesController;
use App\Http\Controllers\ProformaController;
use App\Http\Controllers\FicheController;
use App\Http\Controllers\ListeController;
use Illuminate\Support\Facades\Auth;

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