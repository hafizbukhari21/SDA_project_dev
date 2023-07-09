<?php

use App\Http\Controllers\auth\authController;
use App\Http\Controllers\mailerController;
use App\Http\Controllers\projectController;
use App\Http\Controllers\userController;
use App\Http\Controllers\web\authWebController;
use App\Http\Controllers\web\categoryProjectController;
use App\Http\Controllers\web\web_projectController;
use App\Http\Controllers\web\web_TimelineController;
use App\Http\Controllers\web\web_timesheetController;
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
        Route::get("head",[userController::class,"returnAllHead"])->name("user.head");//ajax Route
    });
    Route::prefix('project')->group(function(){
        Route::view("create","Pages.general.project.create")->name("project.create");
        Route::get("category",[categoryProjectController::class,"returnCategoryProject_all"])->name("project.category.all");//ajax Route
        Route::get("myProject/{idProject}",[web_projectController::class,"getMyProject"])->name("project.myProject");//ajax Route
        Route::post("myProject",[web_projectController::class, "setProject"])->name("project.myProject");
        Route::get("delete",[web_projectController::class, "deleteProject"])->name("project.myProject.delete");//ajax route disable csrf
        Route::get("getAll",[web_projectController::class,"returnGetAllProject"])->name("project.picAndCreator.myProject");//ajax Route
        Route::view('detail/{id}', "Pages.general.project.timeline")->name("project.timeline");


    });
    Route::prefix('timeline')->group(function(){
        Route::post("create",[web_TimelineController::class,"createTimeLine"])->name("create.timeline");
        Route::post("update",[web_TimelineController::class,"updateTImeLine"])->name("update.timeline");
        Route::post("delete",[web_TimelineController::class,"deleteTimeLine"])->name("delete.timeline");
    });

    Route::prefix('timesheet')->group(function(){
        Route::get("",[web_timesheetController::class,"index"])->name("show.timesheet");
        Route::post("/create",[web_timesheetController::class,"addActivity"])->name("create.timesheet");
    });

    Route::view('dashboard', 'Pages.general.dashboard')->name("dashboard");
    
});



Route::group(["prefix"=>"auth"],function(){
    Route::post("login",[authWebController::class,"loginWeb"])->name("loginWeb");
    Route::get("logout",[authWebController::class,"logoutWeb"])->name("logout");
});


Route::get("mail",[mailerController::class,"index"]);









//test view

 





