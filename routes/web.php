<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CompteController;
use App\Http\Controllers\RevenuController;

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
    Route::get('/revenus/create', [RevenuController::class, 'create']);
    Route::post('/revenus', [RevenuController::class, 'store']);
    Route::get('/revenus/{id}', [RevenuController::class, 'show']);
    Route::get('/revenus/update/{id}', [RevenuController::class, 'edit']);
    Route::put('/revenus/{id}', [RevenuController::class, 'update']);
    Route::delete('/revenus/{id}', [RevenuController::class, 'destroy'])->name('revenus.destroy');

});

require __DIR__.'/auth.php';
