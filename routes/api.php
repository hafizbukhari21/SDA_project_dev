<?php

use App\Http\Controllers\auth\authController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\userController;

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

//
Route::get("/user/getAllUserDetail",[userController::class, "returnUserAndProjectList"]);


//fixed Route
Route::post("/user/register",[userController::class,"registerUser"]);
Route::post("/auth/login",[authController::class,"returnLoginApi"]);