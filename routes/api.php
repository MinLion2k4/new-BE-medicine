<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountsController;
use App\Http\Controllers\TypeProductsController;
use App\Http\Controllers\ProductsController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\OrdersDetailController;
use App\Http\Controllers\WareHouseController;
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
//ACOUNTS//
Route::get('/accounts', [AccountsController::class, 'index']);

Route::get('/accounts/{id}', [AccountsController::class, 'show']);

Route::post('/accounts/create', [AccountsController::class, 'store']);

Route::patch('/accounts/update/{id}',[AccountsController::class, 'update']);

Route::delete('/accounts/delete/{id}',[AccountsController::class, 'delete']);

Route::post('/login', [AccountsController::class, 'login']);
//END ACCOUNTS//
//-------------------------------------------//
//TYPES//
Route::get('/types', [TypeProductsController::class, 'index']);

Route::get('/types/{id}', [TypeProductsController::class, 'show']);

Route::post('/types/create', [TypeProductsController::class, 'store']);

Route::patch('/types/update/{id}',[TypeProductsController::class,'update']);

Route::delete('/types/delete/{id}',[TypeProductsController::class,'delete']);
//END TYPES//
//-------------------------------------------//
//PRODUCTS//
Route::get('/products', [ProductsController::class, 'index']);

Route::get('/products/{id}', [ProductsController::class, 'show']);

Route::post('/products/create', [ProductsController::class, 'store']);

Route::patch('/products/update/{id}',[ProductsController::class,'update']);

Route::patch('/products/update-stock/{id}',[ProductsController::class,'updateStock']);

Route::delete('/products/delete/{id}',[ProductsController::class,'delete']);

Route::get('/search', [ProductsController::class, 'searchByName']);

Route::get('/searchByCategory', [ProductsController::class, 'searchByDisease']);
//END PRODUCTS//

//ORDERS//
Route::get('/orders', [OrderController::class, 'index']);
Route::get('/orders/{id}', [OrderController::class, 'show']);
Route::post('/orders/create', [OrderController::class, 'store']);
Route::patch('/orders/update/{id}',[OrderController::class,'update']);
Route::patch('/orders/update-status/{id}',[OrderController::class,'updateStatus']);

Route::delete('/orders/delete/{id}',[OrderController::class,'destroy']);
//END ORDERS//
//-------------------------------------------//
//ORDERSDETAIL//
Route::get('/orderdetails', [OrdersDetailController::class, 'index']);
Route::get('/orderdetails/{id}', [OrdersDetailController::class, 'show']);
Route::post('/orderdetails/create', [OrdersDetailController::class, 'create']);
Route::patch('/orderdetails/update/{id}',[OrdersDetailController::class,'edit']);
Route::delete('/orderdetails/delete/{id}',[OrdersDetailController::class,'destroy']);
//END ORDERSDETAIL//
//-------------------------------------------//
//WareHouse//
Route::get('/wares', [WareHouseController::class, 'index']);
Route::post('/wares/create', [WareHouseController::class, 'shore']);
