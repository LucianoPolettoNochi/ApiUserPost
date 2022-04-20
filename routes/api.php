<?php

use App\Http\Controllers\ApiController;
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


Route::get('user', [ApiController::class, 'getAllUsers']);
Route::get('user/{id}', [ApiController::class, 'getUser']);
Route::post('user', [ApiController::class, 'createUser']);

Route::post('post', [ApiController::class, 'createPost']);
Route::put('post/{id}', [ApiController::class, 'updatePost']);
Route::delete('post/{id}', [ApiController::class, 'deletePost']);
