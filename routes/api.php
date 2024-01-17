<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth;
use App\Http\Controllers\Api\V1\Auth\Users\UserController;
use App\Http\Controllers\VehicleController;
use App\Http\Resources\UserResource;
use App\Models\User;

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

//login and register
Route::post('auth/register', Auth\RegisterController::class);
Route::post('auth/login', Auth\LoginController::class);

//for the user view and update profile
Route::resource('auth/users', UserController::class)->only(['show', 'update']);
Route::post('auth/users/{user}/password', [UserController::class,'changePassword']);

//for the vehicles
Route::apiResource('auth/vehicles',VehicleController::class);