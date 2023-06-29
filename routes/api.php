<?php

use App\Http\Controllers\auth\authController;
use App\Http\Controllers\projectController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });


//
Route::group(['middleware'=>'SessionControl'],function(){
    Route::get("/user/getAllUserDetail",[userController::class, "returnUserAndProjectList"]);
    Route::get("/project/myProject",[projectController::class,"returnMyProject"]);
    
});

Route::post("/project/myProject",[projectController::class,"setMyProject"]);




//fixed Route
Route::post("/user/register",[userController::class,"registerUser"]);
Route::get("/auth/detail",[authController::class,"returnUserDetail"]);//Get User Detail JWT auth
Route::post("/auth/login",[authController::class,"returnLoginApi"]);
Route::post("/auth/logout",[authController::class,"returnLogoutApi"]);//wajib attach bearer tokenya



