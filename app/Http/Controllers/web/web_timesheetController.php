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
        $this->timeSheet_act_repo->insert($request);
    }

    public function getMyTimesheet($idTimesheet){
        return $this->timeSheet_act_repo->get("timesheet_id",$idTimesheet);
    }
}
