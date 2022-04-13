<?php

use App\Http\Controllers\CustomerController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::get('products', [ProductController::class, 'index']);
Route::post('products/create', [ProductController::class, 'create']);
Route::get('products/show/{id}', [ProductController::class, 'show']);
Route::patch('products/update/{id}', [ProductController::class, 'update']);
Route::delete('products/destroy/{id}', [ProductController::class, 'destroy']);

/**
 * Items
 */
Route::get('items', [ItemController::class, 'index']);
Route::post('items/create', [ItemController::class, 'create']);
Route::patch('items/update/{id}', [ItemController::class, 'update']);
Route::delete('items/delete/{id}', [ItemController::class, 'destroy']);

/**
 * Customers
 */
Route::get('customers', [CustomerController::class, 'index']);
Route::post('customers/create', [CustomerController::class, 'create']);
Route::patch('customers/update/{id}', [CustomerController::class, 'update']);
Route::delete('customers/delete/{id}', [CustomerController::class, 'destroy']);

/**
 * Sales
 */
Route::get('sales', [SaleController::class, 'index']);
Route::post('sales/create', [SaleController::class, 'create']);
Route::patch('sales/update/{id}', [SaleController::class, 'update']);
Route::delete('sales/delete/{id}', [SaleController::class, 'destroy']);

