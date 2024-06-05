<?php

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

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

    

Route::post('/register', [RegisterController::class, 'store'])->name('register.submit');



//test routes
Route::view('/dash', 'dash');


// Route pour afficher la liste des employés
Route::get('/employes', [EmployeController::class, 'index'])->name('employes.index');

// Route pour afficher le formulaire de création d'un nouvel employé
Route::get('/employes/create', [EmployeController::class, 'create'])->name('employes.create');

// Route pour enregistrer un nouvel employé
Route::post('/employes', [EmployeController::class, 'store'])->name('employes.store');

// Route pour afficher les détails d'un employé
Route::get('/employes/{id}', [EmployeController::class, 'show'])->name('employes.show');

// Route pour afficher le formulaire de modification d'un employé
Route::get('/employes/{id}/edit', [EmployeController::class, 'edit'])->name('employes.edit');

// Route pour mettre à jour un employé existant
Route::put('/employes/{id}', [EmployeController::class, 'update'])->name('employes.update');

// Route pour supprimer un employé
Route::delete('/employes/{id}', [EmployeController::class, 'destroy'])->name('employes.destroy');


require __DIR__.'/auth.php';
