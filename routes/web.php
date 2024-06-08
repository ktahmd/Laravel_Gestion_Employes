<?php

use App\Http\Controllers\EmployesController;
use App\Http\Controllers\HoraireTravailsController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\EmployeController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::view('/', 'welcome');
Route::view('/welcome', 'welcome');
Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    

Route::post('/register', [RegisterController::class, 'store'])->name('register.submit');





// Route pour afficher la liste des employés
Route::get('/employes', [EmployesController::class, 'index'])->name('employes.index');

// Route pour afficher le formulaire de création d'un nouvel employé
Route::get('/employes/create', [EmployesController::class, 'create'])->name('employes.create');

// Route pour enregistrer un nouvel employé
Route::post('/employes', [EmployesController::class, 'store'])->name('employes.store');

// Route pour afficher les détails d'un employé
Route::get('/employes/{id}', [EmployesController::class, 'show'])->name('employes.show');

// Route pour afficher le formulaire de modification d'un employé
Route::get('/employes/{id}/edit', [EmployesController::class, 'edit'])->name('employes.edit');

// Route pour mettre à jour un employé existant
Route::put('/employes/{id}', [EmployesController::class, 'update'])->name('employes.update');

// Route pour supprimer un employé
Route::delete('/employes/{id}', [EmployesController::class, 'destroy'])->name('employes.destroy');


Route::get('/horaires', [HoraireTravailsController::class, 'index'])->name('HoraireTravails.index');
Route::get('/horaires/create', [HoraireTravailsController::class, 'create'])->name('HoraireTravails.create');
Route::post('/horaires', [HoraireTravailsController::class, 'store'])->name('HoraireTravails.store');
Route::get('/horaires/{id}', [HoraireTravailsController::class, 'show'])->name('HoraireTravails.show');
Route::get('/horaires/{id}/edit', [HoraireTravailsController::class, 'edit'])->name('HoraireTravails.edit');
Route::put('/horaires/{id}', [HoraireTravailsController::class, 'update'])->name('HoraireTravails.update');
Route::delete('/horaires/{id}', [HoraireTravailsController::class, 'destroy'])->name('HoraireTravails.destroy');




//test routes
Route::view('/massage', 'messages.index');
Route::view('/per', 'performance.index');

require __DIR__.'/auth.php';
