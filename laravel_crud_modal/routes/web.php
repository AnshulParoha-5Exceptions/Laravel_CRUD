<?php

use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProductController::class,'index'])
    ->name('products.show');

Route::post('/products/create', [ProductController::class, 'create'])
    ->name('products.create');

Route::get('/products/edit/{p_id}', [ProductController::class, 'edit'])
    ->name('products.edit');

Route::put('/products/update/{p_id}', [ProductController::class, 'update'])
    ->name('products.update');


Route::get('/products/delete/{p_id}',[ProductController::class, 'delete'])
    ->name('products.delete');
