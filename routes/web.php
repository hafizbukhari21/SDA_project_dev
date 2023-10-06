<?php

use App\Http\Controllers\auth\authController;
use App\Http\Controllers\mailerController;
use App\Http\Controllers\projectController;
use App\Http\Controllers\userController;
use App\Http\Controllers\web\authWebController;
use App\Http\Controllers\web\categoryProjectController;
use App\Http\Controllers\web\notificationController;
use App\Http\Controllers\web\web_projectController;
use App\Http\Controllers\web\web_SuperUser_ManageResource;
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

// Route::view('/auth/register', 'Pages.auth.register');


// Route::get("/user/getAllUser",[userController::class, "getAllUser"]);

// Route::get("/user/getAllUserDetail",[userController::class, "returnUserAndProjectList"]);

// Route::get("/project/getAll",[projectController::class,"getAllProject"]);

// Route::view("/forgotPass","Mail.forgetPassword");



//fixing controller
Route::group(['middleware'=>'SessionControlWeb'],function(){
    Route::group(['middleware'=>'SessionControlWeb_SuperUser'],function(){
        Route::prefix("superUser")->group(function(){
            Route::prefix("user")->group(function(){
                Route::view("management","Pages.role_superUser.userManagement")->name("superuser.user.management");
                Route::get("getHead",[userController::class,"returnAllHead"])->name("superuser.get.head");
                Route::post("create",[userController::class,"registerUser"])->name("superuser.user.create");
                Route::get("all",[userController::class,"getAllUser"])->name("superuser.user.all");
                Route::post("update",[userController::class,"updateUser"])->name("superuser.user.update");
                Route::post("detail",[authController::class,"getUserByid"])->name("superuser.user.detail");
                Route::post("delete/inactive",[userController::class,"deleteInactiveUser"])->name("superuser.user.deleteInactive");
            });
            Route::prefix("manage")->group(function(){
                Route::view("project","Pages.role_superUser.createProjectList")->name("superuser.project.view");
                Route::post("project/category/insert",[web_SuperUser_ManageResource::class,"createProjectCategory"])->name("superuser.create.project.category");
                Route::get("project/category",[web_SuperUser_ManageResource::class,"getAllProjectCategory"])->name("superuser.get.project.category");

            });
        });
    });


    Route::group(['middleware'=>'EmailVerified'],function(){
        Route::prefix('user')->group(function () {
            // Route::post("register",[userController::class,"registerUser"])->name("registerUser");
            Route::get("head",[userController::class,"returnMyOfficer"])->name("user.head");//ajax Route
        });
        Route::prefix('project')->group(function(){
            Route::view("create","Pages.general.project.create")->name("project.create");
            Route::post("update",[web_projectController::class,"setUpdateProject"])->name("project.update");
            Route::get("category",[categoryProjectController::class,"returnCategoryProject_all"])->name("project.category.all");//ajax Route
            Route::get("myProject/{idProject}",[web_projectController::class,"getMyProject"])->name("project.myProject");//ajax Route
            Route::post("myProject",[web_projectController::class, "setProject"])->name("project.myProject.create");
            Route::get("delete",[web_projectController::class, "deleteProject"])->name("project.myProject.delete");//ajax route disable csrf
            Route::get("getAll",[web_projectController::class,"returnGetAllProject"])->name("project.picAndCreator.myProject");//ajax Route
            Route::get("idList",[web_projectController::class,"returnProjectId"])->name("project.idList");
            Route::get('detail/{id}', [web_projectController::class,"loadTimelinePage"])->name("project.timeline");
            Route::post("search/name",[web_projectController::class,"searchProjectLikeName"])->name("project.search.name");//ajax Route
            Route::post("update_status_progress",[web_projectController::class,"setStatusUpdate"])->name("project.status_progress");
            Route::get('dashboard/detail', [web_projectController::class,"getAllProjectDashboard"])->name("project.dashboard.detail");

            
    
            Route::get("totalProject",[web_projectController::class,"getTotalProject"])->name("project.total");
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
            Route::get("/submission/timesheet",[web_timesheetController::class,"submissionShow"])->name("submission.timesheet");
            Route::get("/submission/timesheet/get",[web_timesheetController::class,"geMySubmitTimesheet"])->name("submission.timesheet.get");
            Route::post("/submission/timesheet/activity/delete",[web_timesheetController::class,"RemoveActivityFromSubmit"])->name("submission.timesheet.delete");
            Route::post("/submission/timesheet/sumbitted/delete",[web_timesheetController::class,"RemoveActivitySubmit"])->name("submission.timesheet.delete.submittedForm");
            Route::post("/submission/timesheet/resubmitted",[web_timesheetController::class,"officerResubmitTimehseet"])->name("resubmit.timesheet");

            Route::post("deleted",[web_timesheetController::class,"deleteTimesheet"])->name("delete.timesheet");
            Route::get("approval/detail/{uuid}",[web_timesheetController::class,"approvalListTimesheetDetailOfficer"])->name("detail.get.myOfficer");

    
            Route::group(["middleware"=>"SessionControlWeb_Head"],function(){
                // Route::get('head/')
                Route::get("head/approval/myOfficer/get",[web_timesheetController::class,"getMyOfficer"])->name("get.myofficer.timesheet");
                Route::get("head/approval/myOfficer/get/list/timesheetSubmit/{idOfficer}",[web_timesheetController::class,"getMyOfficer_timesheetSubmit"])->name("get.myofficer.timesheet_submit");
                Route::view("head/approval","Pages.role_head.timesheet.approval")->name("show.timesheet.approval");
                Route::post("head/approval/apv",[web_timesheetController::class,"headApproveTimesheet"])->name("apv.timesheet");
                Route::post("head/approval/rev",[web_timesheetController::class,"headRevisiSubmti"])->name("rev.timesheet");
                Route::post("head/approval/message/submit",[web_timesheetController::class,"updateMessageSubmit"])->name("apv.timesheet.message.updage");
                
            });
    });
    
        
    Route::prefix("notifBar")->group(function(){
        Route::get("",[notificationController::class,"SetNotifBar"])->name("notifBar.get");
        Route::post("detail",[notificationController::class,"GetNotifDetail"])->name("notifBar.get.detail");
        Route::post("read",[notificationController::class,"setHasBeenRead"])->name("notifbar.read");
    });
    Route::view('dashboard', 'Pages.general.dashboard')->name("dashboard");

    });


    Route::view('emailNotVerified','Pages.general.verifEmail');


});

Route::group(["prefix"=>"auth"],function(){
    Route::post("login",[authWebController::class,"loginWeb"])->name("loginWeb");
    Route::get("logout",[authWebController::class,"logoutWeb"])->name("logout");
    Route::post("forget_password",[authWebController::class,"forgotPassword"]);
    Route::get("forget_password/{hash}",[authWebController::class,"receivedForget"]);
    Route::post("forget_password/reset/password",[authWebController::class,"doResetPassword"])->name("reset.password");
});


Route::get("mail",[mailerController::class,"index"]);









//test view

 





