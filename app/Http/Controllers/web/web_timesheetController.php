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

   



    //Timesheet Act Repo----------------------------------------------------------------------------------------------------------------------------

    private function validateInput(Request $req){
        $req->validate([
            'title' => 'required',
            'detail_activity' => 'required',
            'activity_date' => 'required',
            'from' => 'required',
            'finish' => 'required',
        ]);
    }

    public function addActivity(Request $request){
        $this->validateInput($request);

        if($this->timeSheet_act_repo->IsDuplicateActivity(session()->get("sessionKey")["id"],$request->activity_date)){
            return response(["message"=>"The date already Recorded"],400);
        }
        else if($this->checkFromBiggerThanFinish($request->from,$request->finish)){
            return response(["message"=>"The From time should be smaller than before time"],400);
        }
        else if($this->CheckMyTimeSheet($request->timeSheet_id)){
            return $this->timeSheet_act_repo->insert($request);
        }
        return response(["message"=>"Forbidden"],403);
    }

    private function checkFromBiggerThanFinish($from,$finish){
        return $from>$finish?true:false;
    }

    public function updateActivity(Request $request){
        $this->validateInput($request);
        if($this->checkFromBiggerThanFinish($request->from,$request->finish)){
            return response(["message"=>"The From time should be smaller than before time"],400);
        }
        return $this->timeSheet_act_repo->UpdateTimesheet($request);
    }

    public function deleteTimesheet(Request $request){
        return $this->timeSheet_act_repo->softDeleteUuid($request->uuid);
    }

    public function getMyTimeSheetActivity($idActivity){
        return $this->timeSheet_act_repo->getByUUid($idActivity)->first();
    }

    public function getMyTimesheet($idTimesheet,Request $request){
        if($this->CheckMyTimeSheet($idTimesheet)){
            //return $this->timeSheet_act_repo->get("timesheet_id",$idTimesheet);
            return $this->timeSheet_act_repo->GetTimesheetActPagination($request,$idTimesheet);
        }
        return response(["message"=>"Forbidden"],403);
    }



    //TImesheet Repo ------------------------------------------------------------------------------------------------------------------------------------

    //select activity yang belum approve [new,rev]
    public function getUnApproveActivity(){
       return  $this->timesheetRepo->UnApproveActivity(session()->get("sessionKey")["id"]);
    }

    public function getMyOfficer(Request $request){
        return $this->timesheetRepo->myOfficerTimesheet(session()->get("sessionKey")["id"]);
    }

     //Validation
     private function CheckMyTimeSheet($id){
        $check = $this->timesheetRepo->get("id",$id)->first();
        if($check->idUser == session()->get("sessionKey")["id"]){
            return true;
        }
        return false;
    }



    //Timesheet Submit ---------------------------------------------------------------------------------------------------------------------------


    public function makeRequest(){
        return $this->timesheet_submit->requestApproval();
    }

    public function getMyOfficer_timesheetSubmit(Request $request, $idOfficer){
    
        // return $this->timesheet_submit->get("idUser",$idOfficer)->load("user");
        return $this->timesheet_submit->GetMyOfficerTimesheet($request,$idOfficer);
    }

    public function RemoveActivityFromSubmit(Request $request){
        
        $timesheetActivtySubmit_ref_number = $this->timeSheet_act_repo->RemoveActivityFromSubmit($request->uuid);
        return $this->timesheet_submit->updateTitleSubmit($timesheetActivtySubmit_ref_number);
    }


    public function RemoveActivitySubmit(Request $request){
        //Remove all ref_submit number in activity
        $timesheetSubmit = $this->timesheet_submit->getByUUid($request->uuid)->first();

        $timesheetActivtySubmit_ref_number = $this->timeSheet_act_repo->RemoveActivityFromSubmit_filterWithUUIDSubmitForm($timesheetSubmit->id);
        $timesheetSubmit = $this->timesheet_submit->softDeleteUuid($request->uuid);

        return compact("timesheetActivtySubmit_ref_number","timesheetSubmit");
    }

    public function geMySubmitTimesheet(Request $request){
        return $this->getMyOfficer_timesheetSubmit($request, session()->get("sessionKey")["id"]);
    }

    public function approvalListTimesheetDetailOfficer(Request $request){
        return $this->timesheet_submit->approvalListTimesheetDetailOfficer($request->uuid);
    }

    //Head Approve Submit
    public function headApproveTimesheet (Request $request){
        //Update All Activity To be Successful
        $timesheetSubmit = $this->timesheet_submit->getByUUid($request->uuid)->first();
        $timesheetActRepo = $this->timeSheet_act_repo->approveTimesheetActivity($timesheetSubmit->id);

        //Update Timesheet Submit
        $timesheetSubmitReturn = $this->timesheet_submit->approveSubmit($request->uuid);

        return ["uuid"=>$request->uuid];

    }
    

    public function submissionShow(){
        return view("Pages.role_officer.timesheet.submission");
    }

    //--------------------------------------------------------------------------------------------------------------------------------------------------


    
   

    


    
    
}
