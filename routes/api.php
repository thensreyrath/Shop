<?php

use App\Http\Controllers\ApiController;
use App\Http\Controllers\frontend\HomeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Laravel\Passport\Passport;

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

Route::post('/login',       [ApiController::class, 'userLogin']);

Route::middleware('auth:sanctum')->group( function () {
    Route::get('/product',       [ApiController::class, 'listProduct']);
    Route::get('/product/{slug}', [ApiController::class, 'productDetail']);

    Route::post('/add-news',       [ApiController::class, 'addNews']);
    Route::get('/list-news',       [ApiController::class, 'listNews']);
    Route::get('/update-news/{id}',       [ApiController::class, 'update']);
});

   





