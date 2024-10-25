<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\BookingController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post('/login',[AuthController::class,'login']);

Route::group(['middleware' => ['auth:api']], function(){
    Route::get('/dashboard',[DashboardController::class,'index']);
    Route::get('/mechanics',[BookingController::class,'getMechanics']);
    Route::get('/bookings',[BookingController::class,'index']);
    Route::post('/booking/create',[BookingController::class,'store']);
    Route::post('/booking/{id}/update',[BookingController::class,'update']);
});
