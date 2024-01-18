<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\Auth;
use App\Http\Controllers\Api\V1\Auth\Users\UserController;
use App\Http\Controllers\ParkingContoller;
use App\Http\Controllers\VehicleController;
use App\Http\Controllers\ZoneController;
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
Route::prefix('auth')->group(function () {
    //login and register
    Route::post('/register', Auth\RegisterController::class);
    Route::post('/login', Auth\LoginController::class);
    
    Route::middleware(['auth:sanctum'])->group(function () {
    
        //for the user view and update profile
        Route::resource('/users', UserController::class)->only(['show', 'update']);
        Route::post('/users/{user}/password', [UserController::class,'changePassword']);
        
        //for the vehicles
        Route::apiResource('/vehicles',VehicleController::class);
        
        //for Zones
        Route::get('/zones',ZoneController::class);

        //parkings
        Route::get('/parkings/{parking}',[ParkingContoller::class,'show']);
        Route::post('/parkings/start',[ParkingContoller::class,'store']);
        Route::post('/parkings/{parking}/stop',[ParkingContoller::class,'update']);
    });
});