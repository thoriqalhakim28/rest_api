<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CollectionController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::get('getAllUsers', [UserController::class, 'getUsers']);
Route::get('getAllUsersToo', [UserController::class, 'getUsers'])->middleware('auth:sanctum');

Route::get('getAllCollections', [CollectionController::class, 'getCollections']);

Route::middleware('auth:sanctum')->group( function () {
    Route::resource('collections', CollectionController::class);
});
