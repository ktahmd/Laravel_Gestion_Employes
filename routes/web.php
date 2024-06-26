<?php

use App\Http\Controllers\EmployesController;
use App\Http\Controllers\EvaliationsController;
use App\Http\Controllers\HoraireTravailsController;
use App\Http\Controllers\CongesController;
use App\Http\Controllers\cvcontroller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;



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

Route::post('/register', [RegisterController::class, 'store'])->name('register.submit');



// route for any emoployes
Route::group(['middleware' => ['auth']], function (){
    Route::view('profile', 'profile')->name('profile');
    Route::get('/horaires/{id}', [HoraireTravailsController::class, 'show'])->name('HoraireTravails.show');

    Route::get('/cv/employe/{id}', [cvController::class, 'show'])->name('cv.showme');
    Route::put('/cv/employe/{id}/set', [cvController::class, 'set'])->name('cv.setme');

    Route::get('/evaliations', [EvaliationsController::class, 'index'])->name('evaliations.index');
    Route::put('/evaliations/{id}/set', [EvaliationsController::class, 'set'])->name('evaliations.set');
});
Route::group(['middleware' => ['auth','role']], function (){
    Route::get('/employes', [EmployesController::class, 'index'])->name('employes.index');
    Route::post('/employes/store', [EmployesController::class, 'store'])->name('employes.store');
    Route::get('/employes/{id}', [EmployesController::class, 'show'])->name('employes.show');
    Route::get('/employes/{id}/edit', [EmployesController::class, 'edit'])->name('employes.edit');
    Route::put('/employes/{id}/update', [EmployesController::class, 'update'])->name('employes.update');
    Route::delete('/employes/{id}/destory', [EmployesController::class, 'destroy'])->name('employes.destroy');

    Route::get('/horaires', [HoraireTravailsController::class, 'index'])->name('HoraireTravails.index');
    Route::post('/horaires/store', [HoraireTravailsController::class, 'store'])->name('HoraireTravails.store');
    Route::get('/horaires/{id}/edit', [HoraireTravailsController::class, 'edit'])->name('HoraireTravails.edit');
    Route::put('/horaires/{id}/update', [HoraireTravailsController::class, 'update'])->name('HoraireTravails.update');
    Route::delete('/horaires/{id}/destroy', [HoraireTravailsController::class, 'destroy'])->name('HoraireTravails.destroy');

    Route::get('/conges', [CongesController::class, 'index'])->name('conges.index');
    Route::post('/conges/store', [CongesController::class, 'store'])->name('conges.store');
    Route::get('/conges/{id}', [CongesController::class, 'show'])->name('conges.show');
    Route::get('/conges/{id}/edit', [CongesController::class, 'edit'])->name('conges.edit');
    Route::put('/conges/{id}/update', [CongesController::class, 'update'])->name('conges.update');
    Route::delete('/conges/{id}/destory', [CongesController::class, 'destroy'])->name('conges.destroy');
    
    Route::get('/cv/{id}', [cvController::class, 'show'])->name('cv.show');
    Route::put('/cv/{id}/set', [cvController::class, 'set'])->name('cv.set');
}); 
Route::group(['middleware' => ['auth','dir']], function (){
    Route::get('/employeinfo', [EmployesController::class, 'index']);
});


//test routes
Route::view('/massage', 'messages.index');

require __DIR__.'/auth.php';
