<?php

use App\Http\Controllers\InventoryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [InventoryController::class, 'index'])->name('dashboard');
    Route::post('/item/add', [InventoryController::class, 'addItem'])->name('item.add');
    Route::post('/item/stock-in', [InventoryController::class, 'stockIn'])->name('item.stock-in');
    Route::post('/item/stock-out', [InventoryController::class, 'stockOut'])->name('item.stock-out');
    Route::delete('/item/{id}', [InventoryController::class, 'delete'])->name('item.delete');
//    Route::get('/item/{id}/edit', [InventoryController::class, 'edit'])->name('item.edit');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
