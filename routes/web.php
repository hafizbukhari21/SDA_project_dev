<?php

use App\Http\Controllers\auth\authController;
use App\Http\Controllers\projectController;
use App\Http\Controllers\userController;
use App\Http\Controllers\web\authWebController;
use Illuminate\Support\Facades\Route;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('Pages.auth.login');
});
Route::view('/dashboard', 'Pages.general.dashboard');
Route::view('/auth/register', 'Pages.auth.register');


Route::get("/user/getAllUser",[userController::class, "getAllUser"]);

Route::get("/user/getAllUserDetail",[userController::class, "returnUserAndProjectList"]);

Route::get("/project/getAll",[projectController::class,"getAllProject"]);



//fixing controller
Route::post("/user/register",[userController::class,"registerUser"]);

Route::group(["prefix"=>"project"],function(){
    Route::post("login",[authWebController::class,"loginWeb"]);
});





