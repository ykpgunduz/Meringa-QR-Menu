<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/categories', function () {
    return view('category');
})->name('categories');

Route::get('/category/{key}', function () {
    return view('category_products');
});
