<?php

use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProductController::class,'index']);
Route::post('/products', [ProductController::class,'store'])->name('product.store');

Route::get('/products', [ProductController::class, 'getAllProduct'])->name('product.getAllProduct');
Route::delete('/products/{id}', [ProductController::class, 'destroy'])->name('product.destroy');
Route::get('/products/{id}', [ProductController::class, 'edit'])->name('product.edit');
