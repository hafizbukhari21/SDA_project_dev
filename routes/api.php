<?php

use App\Http\Controllers\auth\authController;
use App\Http\Controllers\project_timelineController;
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

//fixed Route
Route::group(['middleware'=>'SessionControl'],function(){
    Route::get("/user/getAllUserDetail",[userController::class, "returnUserAndProjectList"]);
    Route::group(["prefix"=>"project"],function(){
        Route::get("myProject",[projectController::class,"returnMyProject_all"]);
        Route::get("myproject/detail/{idProject}",[projectController::class,"returnMyProject"]);
        Route::post("myProject",[projectController::class,"setMyProject"]);

        Route::group(["prefix"=>"timeline"],function(){
            Route::post("",[project_timelineController::class,"setTimelineProject"]);
        });
    });
    
});


Route::post("/user/register",[userController::class,"registerUser"]);

Route::group(["prefix"=>"auth"],function(){
    Route::get("detail",[authController::class,"returnUserDetail"]);//Get User Detail JWT auth
    Route::post("login",[authController::class,"returnLoginApi"]);
    Route::post("logout",[authController::class,"returnLogoutApi"]);//wajib attach bearer tokenya
});




