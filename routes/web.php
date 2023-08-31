<?php

use App\Http\Controllers\auth\authController;
use App\Http\Controllers\mailerController;
use App\Http\Controllers\projectController;
use App\Http\Controllers\userController;
use App\Http\Controllers\web\authWebController;
use App\Http\Controllers\web\categoryProjectController;
use App\Http\Controllers\web\notificationController;
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
        Route::post("update",[web_projectController::class,"setUpdateProject"])->name("project.update");
        Route::get("category",[categoryProjectController::class,"returnCategoryProject_all"])->name("project.category.all");//ajax Route
        Route::get("myProject/{idProject}",[web_projectController::class,"getMyProject"])->name("project.myProject");//ajax Route
        Route::post("myProject",[web_projectController::class, "setProject"])->name("project.myProject");
        Route::get("delete",[web_projectController::class, "deleteProject"])->name("project.myProject.delete");//ajax route disable csrf
        Route::get("getAll",[web_projectController::class,"returnGetAllProject"])->name("project.picAndCreator.myProject");//ajax Route
        Route::get("idList",[web_projectController::class,"returnProjectId"])->name("project.idList");
        Route::get('detail/{id}', [web_projectController::class,"loadTimelinePage"])->name("project.timeline");
        Route::post("search/name",[web_projectController::class,"searchProjectLikeName"])->name("project.search.name");//ajax Route
    });
    Route::prefix('timeline')->group(function(){
        Route::post("create",[web_TimelineController::class,"createTimeLine"])->name("create.timeline");
        //For vis Js
        Route::post("update",[web_TimelineController::class,"updateTImeLine"])->name("update.timeline");
        //Full Update Modal
        Route::post("update/full",[web_TimelineController::class,"updateTImeLineFull"])->name("update.full.timeline");
        Route::post("delete",[web_TimelineController::class,"deleteTimeLine"])->name("delete.timeline");
        Route::get("detail/{idTimeline}",[web_TimelineController::class,"getTimelineDetail"])->name("detail.timeline");

        Route::post("group",[web_TimelineController::class,"insertGroup"])->name("group.insert");
        Route::post("group/delete",[web_TimelineController::class,"deleteGroup"])->name("group.delete");
        Route::get("group/{idGroup}",[web_TimelineController::class,"getGroupTimeline"])->name("group.timeline");
        Route::post("group/update/groupName",[web_TimelineController::class,"updateGroupName"])->name("group.update.name");
        Route::post("group/update/order",[web_TimelineController::class,"updateGroupOrder"])->name("group.update.order");

    });
    Route::get("/excelGen/{idProject}",[web_TimelineController::class,"DataExcelNeeded"])->name("excelGen");

    Route::prefix('timesheet')->group(function(){
        Route::get("",[web_timesheetController::class,"index"])->name("show.timesheet");
        Route::post("create",[web_timesheetController::class,"addActivity"])->name("create.timesheet");
        Route::post("update",[web_timesheetController::class,"updateActivity"])->name("update.timesheet");
        Route::get("myTimesheet/{idTimesheet}",[web_timesheetController::class,"getMyTimesheet"])->name("show.myTimesheet");
        Route::get("request",[web_timesheetController::class,"makeRequest"])->name("make.request.timesheet");
        Route::get("unApprrove",[web_timesheetController::class,"getUnApproveActivity"])->name("show.unApprove.myTimesheet");
        Route::get("/{idActivity}",[web_timesheetController::class,"getMyTimeSheetActivity"])->name("get.timesheet.activity");

        Route::group(["middleware"=>"SessionControlWeb_Head"],function(){
            // Route::get('head/')
            Route::get("head/approval/myOfficer/get",[web_timesheetController::class,"getMyOfficer"])->name("get.myofficer.timesheet");
            Route::get("head/approval/myOfficer/get/list/timesheetSubmit/{idOfficer}",[web_timesheetController::class,"getMyOfficer_timesheetSubmit"])->name("get.myofficer.timesheet_submit");
            Route::view("head/approval","Pages.role_head.timesheet.approval")->name("show.timesheet.approval");
            
        });
        

    });

    Route::prefix("notifBar")->group(function(){
        Route::get("",[notificationController::class,"SetNotifBar"])->name("notifBar.get");
        Route::post("detail",[notificationController::class,"GetNotifDetail"])->name("notifBar.get.detail");
    });
    Route::view('dashboard', 'Pages.general.dashboard')->name("dashboard");
    
});

Route::group(["prefix"=>"auth"],function(){
    Route::post("login",[authWebController::class,"loginWeb"])->name("loginWeb");
    Route::get("logout",[authWebController::class,"logoutWeb"])->name("logout");
});


Route::get("mail",[mailerController::class,"index"]);









//test view

 





