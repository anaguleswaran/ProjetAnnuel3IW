<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\RevenuController;
use App\Http\Controllers\DepenseController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/comptes', [CompteController::class, 'index'])->name('compte');
    Route::get('/comptes/create', [CompteController::class, 'create']);
    Route::post('/comptes', [CompteController::class, 'addCompte']);
    Route::get('/comptes/{id}', [CompteController::class, 'show']);
    Route::get('/comptes/update/{id}', [CompteController::class, 'edit']);
    Route::put('/comptes/{id}', [CompteController::class, 'update']);
    Route::delete('/comptes/{id}', [CompteController::class, 'destroy']);

    Route::get('/revenus', [RevenuController::class, 'index'])->name('revenus');
    Route::get('/revenus/create', [RevenuController::class, 'create'])->name('revenus.create');
    Route::post('/revenus', [RevenuController::class, 'store'])->name('revenus.store');
    Route::get('/revenus/{id}', [RevenuController::class, 'show'])->name('revenus.show');
    Route::get('/revenus/update/{id}', [RevenuController::class, 'edit'])->name('revenus.edit');
    Route::put('/revenus/{id}', [RevenuController::class, 'update'])->name('revenus.update');
    Route::delete('/revenus/{id}', [RevenuController::class, 'destroy'])->name('revenus.destroy');

    
    Route::get('/depenses', [DepenseController::class, 'index'])->name('depenses.index');
    Route::get('/depenses/create', [DepenseController::class, 'create'])->name('depenses.create');
    Route::post('/depenses', [DepenseController::class, 'store'])->name('depenses.store');
    Route::get('/depenses/{id}', [DepenseController::class, 'show'])->name('depenses.show');
    Route::get('/depenses/update/{id}', [DepenseController::class, 'edit'])->name('depenses.edit');
    Route::put('/depenses/{id}', [DepenseController::class, 'update'])->name('depenses.update');
    Route::delete('/depenses/{id}', [DepenseController::class, 'destroy'])->name('depenses.destroy');
});

require __DIR__.'/auth.php';
