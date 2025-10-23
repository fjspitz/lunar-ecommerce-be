<?php

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::prefix('products')->group(function () {
    Route::get('/', [ProductController::class, 'index'])->name('product.index');
    Route::get('/new', [ProductController::class, 'new'])->name('product.new');
    Route::post('/save', [ProductController::class, 'create'])->name('product.create');
});

Route::prefix('collections')->group(function () {
    Route::get('/', function () {
        return view('collections.index');
    })->name('collection.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
