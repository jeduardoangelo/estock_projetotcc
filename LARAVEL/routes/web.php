<?php

use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/supplier/create', [SupplierController::class, 'create']);
Route::get('/supplier/', [SupplierController::class, 'list']);
Route::get('/supplier/update', [SupplierController::class, 'update']);
Route::get('/supplier/delete', [SupplierController::class, 'delete']);

Route::get('/product/create', [ProductController::class, 'create']);
Route::get('/product/', [ProductController::class, 'list']);
Route::get('/product/delete', [ProductController::class, 'delete']);
