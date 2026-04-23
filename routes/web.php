<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ClienteController;

/*
|--------------------------------------------------------------------------
| Rutas públicas
|--------------------------------------------------------------------------
*/

Route::get('/', function () {
    return view('welcome');
});

/*
|--------------------------------------------------------------------------
| Dashboard
|--------------------------------------------------------------------------
*/

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/*
|--------------------------------------------------------------------------
| Profile
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

/*
|--------------------------------------------------------------------------
| Prueba DB
|--------------------------------------------------------------------------
*/

Route::get('/prueba', function () {
    return DB::table('clientes')->get();
});

/*
|--------------------------------------------------------------------------
| Clientes (CRUD COMPLETO)
|--------------------------------------------------------------------------
*/

// LISTAR + BUSCAR
Route::get('/clientes', [ClienteController::class, 'index']);

// FORMULARIO
Route::get('/clientes/create', [ClienteController::class, 'create']);

// GUARDAR
Route::post('/clientes', [ClienteController::class, 'store']);

// VER DETALLE
Route::get('/clientes/{id}', [ClienteController::class, 'show']);

// EDITAR
Route::get('/clientes/{id}/edit', [ClienteController::class, 'edit']);

// ACTUALIZAR
Route::put('/clientes/{id}', [ClienteController::class, 'update']);

// CAMBIAR ESTADO
Route::put('/dispositivos/{id}/estado', [ClienteController::class, 'updateEstado']);

// 🗑️ ELIMINAR
Route::delete('/clientes/{id}', [ClienteController::class, 'destroy']);

require __DIR__.'/auth.php';