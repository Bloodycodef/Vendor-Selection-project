<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\VendorController;
use App\Http\Controllers\Api\ItemController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\VendorItemController;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| AUTH
|--------------------------------------------------------------------------
*/

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:api')->group(function () {

    Route::get('/me', [AuthController::class, 'me']);
    Route::post('/logout', [AuthController::class, 'logout']);
    /*
    |--------------------------------------------------------------------------
    | VENDOR
    |--------------------------------------------------------------------------
    */
    Route::get('/vendors', [VendorController::class, 'getVendor']);
    Route::post('/vendors', [VendorController::class, 'addVendor']);
    Route::get('/vendors/{id}', [VendorController::class, 'showVendorById']);
    Route::put('/vendors/{id}', [VendorController::class, 'updateVendor']);
    Route::delete('/vendors/{id}', [VendorController::class, 'deleteVendor']);
    /*
    |--------------------------------------------------------------------------
    | ITEM
    |--------------------------------------------------------------------------
    */
    Route::get('/items', [ItemController::class, 'index']);
    Route::post('/items', [ItemController::class, 'store']);
    Route::get('/items/{id}', [ItemController::class, 'show']);
    Route::put('/items/{id}', [ItemController::class, 'update']);
    Route::delete('/items/{id}', [ItemController::class, 'destroy']);
    /*
    |--------------------------------------------------------------------------
    | ITEM
    |--------------------------------------------------------------------------
    */
    Route::get('/orders', [OrderController::class, 'index']);
    Route::post('/orders', [OrderController::class, 'store']);
    Route::get('/orders/{id}', [OrderController::class, 'show']);
    Route::put('/orders/{id}', [OrderController::class, 'update']);
    Route::delete('/orders/{id}', [OrderController::class, 'destroy']);
    /*
    |--------------------------------------------------------------------------
    | ITEM
    |--------------------------------------------------------------------------
    */
    Route::get('/vendor-items', [VendorItemController::class, 'index']);
    Route::post('/vendor-items', [VendorItemController::class, 'store']);
    Route::get('/vendor-items/{id}', [VendorItemController::class, 'show']);
    Route::put('/vendor-items/{id}', [VendorItemController::class, 'update']);
    Route::delete('/vendor-items/{id}', [VendorItemController::class, 'destroy']);
});
