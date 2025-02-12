<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

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
});

// Route pour accéder à la gestion des utilisateurs
Route::get('/utilisateur', [UserController::class, 'index'])->middleware('auth')->name('users.index');

// CRUD complet des utilisateurs
Route::resource('users', UserController::class)->middleware('auth');

Route::get('/logout-and-register', [UserController::class, 'logoutAndRegister'])
    ->middleware('auth')
    ->name('users.logoutAndRegister');
    
require __DIR__.'/auth.php';
