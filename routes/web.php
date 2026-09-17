<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\RevenuController;
use App\Http\Controllers\DepenseController;
use App\Http\Controllers\ExceptionController;

Route::get('/', function () {
    return view('welcome');
});
Route::get('/dashboard', [CompteController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/comptes', [CompteController::class, 'index'])->name('compte');
    Route::get('/comptes/create', [CompteController::class, 'create'])->name('comptes.create');
    Route::post('/comptes', [CompteController::class, 'addCompte'])->name('comptes.store');
    Route::get('/comptes/{id}', [CompteController::class, 'show'])->name('comptes.show');
    Route::get('/comptes/update/{id}', [CompteController::class, 'edit'])->name('comptes.edit');
    Route::put('/comptes/{id}', [CompteController::class, 'update'])->name('comptes.update');
    Route::delete('/comptes/{id}', [CompteController::class, 'destroy'])->name('comptes.destroy');

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

    
    // Exceptions liées aux dépenses
    Route::get('/compte/depenses/{depenseId}/exceptions', [ExceptionController::class, 'indexDepense'])->name('exceptions.depense.index');
    Route::get('/compte/depenses/{depenseId}/exceptions/create', [ExceptionController::class, 'createDepense'])->name('exceptions.depense.create');
    Route::post('/compte/depenses/{depenseId}/exceptions', [ExceptionController::class, 'storeDepense'])->name('exceptions.depense.store');
    // Exceptions liées aux revenus
    Route::get('/compte/revenus/{revenuId}/exceptions', [ExceptionController::class, 'indexRevenu'])->name('exceptions.revenu.index');
    Route::get('/compte/revenus/{revenuId}/exceptions/create', [ExceptionController::class, 'createRevenu'])->name('exceptions.revenu.create');
    Route::post('/compte/revenus/{revenuId}/exceptions', [ExceptionController::class, 'storeRevenu'])->name('exceptions.revenu.store');
    // Exceptions
    Route::get('/compte/exceptions/{id}', [ExceptionController::class, 'show'])->name('exceptions.show');
    Route::get('/compte/exceptions/{id}/edit', [ExceptionController::class, 'edit'])->name('exceptions.edit');
    Route::put('/compte/exceptions/{id}', [ExceptionController::class, 'update'])->name('exceptions.update');
    Route::delete('/compte/exceptions/{id}', [ExceptionController::class, 'destroy'])->name('exceptions.destroy');

    });

require __DIR__.'/auth.php';
