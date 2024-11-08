<?php

use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReagentController;
use App\Http\Controllers\StockController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//item routes
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', [ItemController::class, 'index'])->name('dashboard');
    Route::post('/item/add', [ItemController::class, 'addItem'])->name('item.add');
    Route::post('/item/stock-in', [ItemController::class, 'stockIn'])->name('item.stock-in');
    Route::post('/item/stock-out', [ItemController::class, 'stockOut'])->name('item.stock-out');
    Route::delete('/item/{id}', [ItemController::class, 'delete'])->name('item.delete');
//    Route::get('/item/{id}/edit', [ItemController::class, 'edit'])->name('item.edit');
});

//Routes for Reagents
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/reagents', [ReagentController::class, 'index'])->name('reagents.index');
    Route::get('/reagents/add', [ReagentController::class, 'create'])->name('reagents.create');
    Route::post('/reagents/add', [ReagentController::class, 'addReagent'])->name('reagents.add');
    Route::delete('/reagents/{id}', [ReagentController::class, 'delete'])->name('reagents.delete');
//    Route::post('/item/stock-in', [ItemController::class, 'stockIn'])->name('item.stock-in');
//    Route::post('/item/stock-out', [ItemController::class, 'stockOut'])->name('item.stock-out');
//    Route::get('/item/{id}/edit', [ItemController::class, 'edit'])->name('item.edit');
});

//Routes for Stock In and Stock Out
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/stock-in', [StockController::class, 'showStockIn'])->name('stock.in');
    Route::get('/stock-out', [StockController::class, 'showStockOut'])->name('stock.out');
});

//Routes for Profile
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
