<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;

Route::get('/', function () {
    return redirect()->route('welcome');
});

Route::get('/qr-menu', function () {
    return view('welcome');
})->name('welcome');

Route::get('/categories', function () {
    return view('category');
})->name('categories');

Route::get('/category/{key}', function () {
    return view('category_products');
});

// Admin login routes (no middleware)
Route::prefix('admin')->name('admin.')->group(function () {
    Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
    Route::post('/login', [AuthController::class, 'login'])->name('login.post');
    Route::post('/logout', [AuthController::class, 'logout'])->name('logout');
});

// Admin panel routes (with middleware)
Route::prefix('admin')->name('admin.')->middleware('admin.auth')->group(function () {
    Route::get('/', [AdminController::class, 'index'])->name('dashboard');
    Route::get('/products', [AdminController::class, 'products'])->name('products');
    Route::get('/categories', [AdminController::class, 'categories'])->name('categories');

    // Product routes
    Route::get('/products/create', [AdminController::class, 'createProduct'])->name('products.create');
    Route::post('/products', [AdminController::class, 'storeProduct'])->name('products.store');
    Route::get('/products/{category}/{id}/edit', [AdminController::class, 'editProduct'])->name('products.edit');
    Route::put('/products/{category}/{id}', [AdminController::class, 'updateProduct'])->name('products.update');
    Route::delete('/products/{category}/{id}', [AdminController::class, 'deleteProduct'])->name('products.delete');

    // Category routes
    Route::get('/categories/create', [AdminController::class, 'createCategory'])->name('categories.create');
    Route::post('/categories', [AdminController::class, 'storeCategory'])->name('categories.store');
    Route::get('/categories/{key}/edit', [AdminController::class, 'editCategory'])->name('categories.edit');
    Route::put('/categories/{key}', [AdminController::class, 'updateCategory'])->name('categories.update');
    Route::delete('/categories/{key}', [AdminController::class, 'deleteCategory'])->name('categories.delete');
});
