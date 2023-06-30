<?php

use App\Http\Controllers\auth\authController;
use App\Http\Controllers\projectController;
use App\Http\Controllers\userController;
use App\Http\Controllers\web\authWebController;
use App\Http\Controllers\web\categoryProjectController;
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

Route::view('/auth/register', 'Pages.auth.register');


Route::get("/user/getAllUser",[userController::class, "getAllUser"]);

Route::get("/user/getAllUserDetail",[userController::class, "returnUserAndProjectList"]);

Route::get("/project/getAll",[projectController::class,"getAllProject"]);



//fixing controller
Route::group(['middleware'=>'SessionControlWeb'],function(){
    Route::prefix('user')->group(function () {
        // Route::post("register",[userController::class,"registerUser"])->name("registerUser");
        Route::get("head",[userController::class,"returnAllHead"])->name("user.head");
    });
    Route::prefix('project')->group(function(){
        Route::view("create","Pages.general.project.create")->name("project.create");
        Route::get("category",[categoryProjectController::class,"returnCategoryProject_all"])->name("project.category.all");
    });
    Route::view('dashboard', 'Pages.general.dashboard')->name("dashboard");
    
});

Route::group(["prefix"=>"auth"],function(){
    Route::post("login",[authWebController::class,"loginWeb"])->name("loginWeb");
    Route::get("logout",[authWebController::class,"logoutWeb"])->name("logout");
});









//test view

// Route::view('tes/dashboard', 'Pages.general.dashboard');





