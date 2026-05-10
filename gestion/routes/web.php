<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\FormationsController;
use App\Http\Controllers\FacturesController;
use App\Http\Controllers\ProformaController;
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


Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login')->with('success', 'Déconnexion réussie');
})-> name('logout');

Route::resource('formations', FormationsController::class)->middleware('auth');
Route::resource('factures', FacturesController::class)->middleware('auth');
Route::resource('proforma', ProformaController::class)->middleware('auth');