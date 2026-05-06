<?php

use App\Http\Controllers\FacturesController;
use App\Http\Controllers\FormationsController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('dashboard');
});

Route::get('/dashboard', [FormationsController::class, 'index'])->name('dashboard');

Route::resource('formations', FormationsController::class);

Route::resource('factures', FacturesController::class);