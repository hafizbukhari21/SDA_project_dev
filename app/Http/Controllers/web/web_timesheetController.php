<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Repository\Data\Timesheet_activityRepository;
use App\Repository\Data\Timesheet_Repository;
use App\Repository\Data\Timesheet_submitRepository;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

class web_timesheetController extends Controller
{
    public UserRepository $userRepo;
    public Timesheet_Repository $timesheetRepo;
    public Timesheet_activityRepository $timeSheet_act_repo;
    public Timesheet_submitRepository $timesheet_submit;
    public function __construct(
        UserRepository $userRepository, 
        Timesheet_Repository $timesheet_Repository, 
        Timesheet_activityRepository $timesheet_activityRepository,
        Timesheet_submitRepository $timesheet_submitRepository
    ){
        $this->userRepo = $userRepository;
        $this->timesheetRepo = $timesheet_Repository;
        $this->timeSheet_act_repo = $timesheet_activityRepository;
        $this->timesheet_submit = $timesheet_submitRepository;
    }
    
    public function index(){
        $payload = $this->userRepo->getUserAndTimesheet(session()->get("sessionKey")["id"])->first();
        return view("Pages.role_officer.timesheet.index",["payload"=>$payload]);
    }

    

    public function addActivity(Request $request){
        iF($this->CheckMyTimeSheet($request->timeSheet_id)){
           return $this->timeSheet_act_repo->insert($request);
        }
        return response(["message"=>"Forbidden"],403);
    }

    public function updateActivity(Request $request){
        return $this->timeSheet_act_repo->UpdateTimesheet($request);
    }

    public function getMyTimesheet($idTimesheet,Request $request){
        iF($this->CheckMyTimeSheet($idTimesheet)){
            //return $this->timeSheet_act_repo->get("timesheet_id",$idTimesheet);
            return $this->timeSheet_act_repo->GetTimesheetActPagination($request,$idTimesheet);
        }
        return response(["message"=>"Forbidden"],403);
    }

    public function getMyTimeSheetActivity($idActivity){
        return $this->timeSheet_act_repo->get("id",$idActivity)->first();
    }

    public function getMyOfficer(Request $request){
        return $this->timesheetRepo->myOfficerTimesheet(session()->get("sessionKey")["id"]);
    }

    //select activity yang belum approve [new,rev]
    public function getUnApproveActivity(){
       return  $this->timesheetRepo->UnApproveActivity(session()->get("sessionKey")["id"]);
    }

    
    //Validation
    private function CheckMyTimeSheet($id){
        $check = $this->timesheetRepo->get("id",$id)->first();
        if($check->idUser == session()->get("sessionKey")["id"]){
            return true;
        }
        return false;
    }
    
}
