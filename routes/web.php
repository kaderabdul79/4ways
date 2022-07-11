<?php

use App\Http\Controllers\Product\ProductController;
use Illuminate\Support\Facades\Route;


Route::get('/', [ProductController::class,'index']);
