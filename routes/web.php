<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AccountsController;
Route::get('/', function () {
    return view('welcome');
});
//Route::post('/accounts/store', [AccountsController::class, 'store']);