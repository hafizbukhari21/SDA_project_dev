<?php 

namespace App\Repository\Data;
use App\Models\timesheet_submit;
use App\Repository\GeneralRepository;
use Carbon\Carbon;

class Timesheet_submitRepository extends GeneralRepository{

    public Timesheet_activityRepository $timesheet_act_repo;

    private Timesheet_Repository $timesheet_repo;
    
    public function __construct(){
        $this->timesheet_act_repo = new  Timesheet_activityRepository();
        $this->timesheet_repo = new Timesheet_Repository();
        $this->objectName = new timesheet_submit();
    }

    public function requestApproval(){
    

        $timsesheetId=$this->timesheet_repo->get("idUser",session()->get("sessionKey")["id"])->first()->id;
        $submitApproval = $this->objectName->create([
            "timeSheet_id"=>$timsesheetId,
            "idUser"=>session()->get("sessionKey")["id"],
            "status_submit"=>"new",
            "attemp"=>1,
            "submitDate"=>Carbon::now(),
            "message"=>""
        ]);

        if ($submitApproval){
            $this->timesheet_act_repo->Set_ref_submit($submitApproval->id);
        }

        return $this->objectName->where("id",$submitApproval->id)->get();
        
        
    }
}