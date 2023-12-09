<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/
use App\Http\Controllers\ProductController;
use App\Http\Controllers\OrderController;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\TodoController;
use App\Http\Controllers\CartController;

Route::get('/getproducts', [ProductController::class, 'index']);
Route::post('/products', [ProductController::class, 'store']);
Route::get('/getproducts/{id}', [ProductController::class, 'show']);
Route::post('/update-product', [ProductController::class, 'update']);
Route::post('/delete-product', [ProductController::class, 'destroy']);

Route::get('/users/order-history', [OrderController::class, 'orderHistory']);



Route::controller(AuthController::class)->group(function () {
    Route::post('login', 'login');
    Route::post('register', 'register');
    Route::post('logout', 'logout');
    Route::post('refresh', 'refresh');

});


Route::prefix('cart')->group(function () {
    Route::post('add', [CartController::class, 'addToCart']);
    Route::post('remove', [CartController::class, 'removeFromCart']);
    Route::get('view', [CartController::class, 'viewCart']);
});