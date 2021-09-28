<?php

use App\Http\Controllers\MovementController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SupplierController;
use Illuminate\Support\Facades\Route;

Route::get('/supplier/create', [SupplierController::class, 'create']);
Route::get('/supplier/', [SupplierController::class, 'list']);
Route::get('/supplier/update', [SupplierController::class, 'update']);
Route::get('/supplier/delete', [SupplierController::class, 'delete']);

Route::get('/product/create', [ProductController::class, 'create']);
Route::get('/product/', [ProductController::class, 'list']);
Route::get('/product/update', [ProductController::class, 'update']);
Route::get('/product/delete', [ProductController::class, 'delete']);

Route::get('/movement/create', [MovementController::class, 'create']);
Route::get('/movement/', [MovementController::class, 'list']);
Route::get('/movement/update', [MovementController::class, 'update']);
Route::get('/movement/delete', [MovementController::class, 'delete']);
