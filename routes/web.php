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

    Route::get('/compte/{compteId}/revenus', [RevenuController::class, 'index'])->name('revenus.index');
    Route::get('/compte/{compteId}/revenus/create', [RevenuController::class, 'create'])->name('revenus.create');
    Route::post('/compte/{compteId}/revenus', [RevenuController::class, 'store'])->name('revenus.store');
    Route::get('/compte/revenus/{id}', [RevenuController::class, 'show'])->name('revenus.show');
    Route::get('/compte/revenus/update/{id}', [RevenuController::class, 'edit'])->name('revenus.edit');
    Route::put('/compte/revenus/{id}', [RevenuController::class, 'update'])->name('revenus.update');
    Route::delete('/compte/revenus/{id}', [RevenuController::class, 'destroy'])->name('revenus.destroy');

    
    Route::get('/compte/{compteId}/depenses', [DepenseController::class, 'index'])->name('depenses.index');
    Route::get('/compte/{compteId}/depenses/create', [DepenseController::class, 'create'])->name('depenses.create');
    Route::post('/compte/{compteId}/depenses', [DepenseController::class, 'store'])->name('depenses.store');
    Route::get('/compte/depenses/{id}', [DepenseController::class, 'show'])->name('depenses.show');
    Route::get('/compte/depenses/update/{id}', [DepenseController::class, 'edit'])->name('depenses.edit');
    Route::put('/compte/depenses/{id}', [DepenseController::class, 'update'])->name('depenses.update');
    Route::delete('/compte/depenses/{id}', [DepenseController::class, 'destroy'])->name('depenses.destroy');
});

require __DIR__.'/auth.php';
