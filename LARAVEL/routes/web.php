<?php

use App\Http\Controllers\SuplierController;
use Illuminate\Support\Facades\Route;

Route::get('/suplier/create', [SuplierController::class, 'create']);

Route::get('/suplier/', [SuplierController::class, 'list']);

Route::get('/suplier/update', [SuplierController::class, 'update']);

Route::get('/suplier/delete', [SuplierController::class, 'delete']);
