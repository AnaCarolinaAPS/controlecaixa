<?php

use App\Http\Controllers\CargaController;
use App\Http\Controllers\ClienteController;
use App\Http\Controllers\InvoiceController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\SubcategoriaController;
use App\Http\Controllers\DespesaController;
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

// Pacotes CRUD
Route::prefix('/invoices')->group(function () {
    // Route::get('/', [InvoiceController::class, 'index'])->name('pacotes.index');
    Route::post('/', [InvoiceController::class, 'store'])->name('invoices.store');
    Route::get('/{invoices}', [InvoiceController::class, 'show'])->name('invoices.show');
    Route::put('/{invoices}', [InvoiceController::class, 'update'])->name('invoices.update');
    Route::delete('/{invoices}', [InvoiceController::class, 'destroy'])->name('invoices.destroy');
});

// Pacotes CRUD
Route::prefix('/categorias')->group(function () {
    Route::get('/', [CategoriaController::class, 'index'])->name('categorias.index');
    Route::post('/', [CategoriaController::class, 'store'])->name('categorias.store');
    Route::get('/{categoria}', [CategoriaController::class, 'show'])->name('categorias.show');
    Route::put('/{categoria}', [CategoriaController::class, 'update'])->name('categorias.update');
    Route::delete('/{categoria}', [CategoriaController::class, 'destroy'])->name('categorias.destroy');
});

// Pacotes CRUD
Route::prefix('/subcategorias')->group(function () {
    Route::get('/', [SubcategoriaController::class, 'index'])->name('subcategorias.index');
    Route::post('/', [SubcategoriaController::class, 'store'])->name('subcategorias.store');
    Route::get('/{subcategoria}', [SubcategoriaController::class, 'show'])->name('subcategorias.show');
    Route::put('/{subcategoria}', [SubcategoriaController::class, 'update'])->name('subcategorias.update');
    Route::delete('/{subcategoria}', [SubcategoriaController::class, 'destroy'])->name('subcategorias.destroy');
});

// Pacotes CRUD
Route::prefix('/despesas')->group(function () {
    Route::get('/', [DespesaController::class, 'index'])->name('despesas.index');
    Route::post('/', [DespesaController::class, 'store'])->name('despesas.store');
    Route::get('/{despesa}', [DespesaController::class, 'show'])->name('despesas.show');
    Route::put('/{despesa}', [DespesaController::class, 'update'])->name('despesas.update');
    Route::delete('/{despesa}', [DespesaController::class, 'destroy'])->name('despesas.destroy');
});

require __DIR__.'/auth.php';
