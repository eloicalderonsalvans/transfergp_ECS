<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PilotController;

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

    // --- NUESTRAS RUTAS DE GESTIÓN (CRUDs) ---
    // Las ponemos dentro del middleware 'auth' para que solo usuarios logueados accedan
    
    // CRUD de Pilotos (Incluye el formulario con lista de equipos)
    Route::resource('pilot', PilotController::class);

});

require __DIR__.'/auth.php';
