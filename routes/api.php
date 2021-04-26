<?php

use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
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

Route::apiResource('clients', ClientController::class)->names('clients');

Route::apiResource('products', ProductController::class)->names('products');

Route::apiResource('orders', OrderController::class)->names('orders');
Route::post('orders/{id}/sendmail', [OrderController::class, 'sendmail'])->name('orders.sendmail');
Route::match(['get', 'post'], 'orders/{id}/report', [OrderController::class, 'report'])->name('orders.report');
