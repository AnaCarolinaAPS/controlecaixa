<?php

use App\Http\Controllers\CargaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

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

// Clientes CRUD
Route::prefix('/clientes')->group(function () {
    Route::get('/', [ClienteController::class, 'index'])->name('clientes.index');
    Route::post('/', [ClienteController::class, 'store'])->name('clientes.store');
    Route::get('/{cliente}', [ClienteController::class, 'show'])->name('clientes.show');
    Route::put('/{cliente}', [ClienteController::class, 'update'])->name('clientes.update');
    Route::delete('/{cliente}', [ClienteController::class, 'destroy'])->name('clientes.destroy');
});

// Cargas CRUD
Route::prefix('/cargas')->group(function () {
    Route::get('/', [CargaController::class, 'index'])->name('cargas.index');
    Route::post('/', [CargaController::class, 'store'])->name('cargas.store');
    Route::get('/{carga}', [CargaController::class, 'show'])->name('cargas.show');
    Route::put('/{carga}', [CargaController::class, 'update'])->name('cargas.update');
    Route::delete('/{carga}', [CargaController::class, 'destroy'])->name('cargas.destroy');
});


require __DIR__.'/auth.php';
