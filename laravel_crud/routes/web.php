<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;

Route::get('/', [ProductController::class, 'index'])
    ->name('products.show');

Route::post('/products/create', [ProductController::class, 'index'])
    ->name('products.create');

Route::any('/products/edit/{p_id}', [ProductController::class, 'index'])
    ->name('products.edit');

Route::get('/products/delete/{p_id}',[ProductController::class,'delete'])
    ->name('products.delete');

Route::get('/products/search', [SearchController::class, 'search'])
    ->name('products.search');






