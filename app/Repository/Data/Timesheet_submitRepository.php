<?php 

namespace App\Repository\Data;
use App\Models\timesheet_submit;
use App\Repository\GeneralRepository;
use App\Utils\DatatableFormater;
use Carbon\Carbon;
use Illuminate\Http\Request;


class Timesheet_submitRepository extends GeneralRepository{

    public Timesheet_activityRepository $timesheet_act_repo;

    private Timesheet_Repository $timesheet_repo;
    
    public function __construct(){
        $this->timesheet_act_repo = new  Timesheet_activityRepository();
        $this->timesheet_repo = new Timesheet_Repository();
        $this->objectName = new timesheet_submit();
    }


    public function GetMyOfficerTimesheet(Request $request, $idOfficer){
        $query= $this->objectName->where("idUser",$idOfficer);

        return DatatableFormater::format($request, $query,[
            "title",
            "message",
            "status_submit",
            "submitDate",
            "approvalDate",
            "attemp",
            "submitDate"
           
        ]);

       
    }

    public  function  updateTitleSubmit($id){
        $timsesheetId=$this->timesheet_repo->get("idUser",session()->get("sessionKey")["id"])->first()->id;//get session value should be from controller
        $timesheetActvityTime = $this->timesheet_act_repo->getFirstandLastDateNew($timsesheetId,[
            ["status","=","new"],
            ["ref_timeSheetSubmit","=",$id]
        ]);
        $timseheetSubmitApproval=$this->objectName->find($id);

        if($timesheetActvityTime)  $timseheetSubmitApproval->title =  "Pengajuan Tanggal ".$timesheetActvityTime[0]." s.d. ".$timesheetActvityTime[1];
        else   $timseheetSubmitApproval->title =  "Pengajuan Tanggal NA s.d NA";


        $timseheetSubmitApproval->save();

        return $timseheetSubmitApproval->title;

    }


    public function requestApproval(){
    
        $timsesheetId=$this->timesheet_repo->get("idUser",session()->get("sessionKey")["id"])->first()->id;//get session value should be from controller
        $timesheet_act_new_without_ref=$this->timesheet_act_repo->getFirstandLastDateNew($timsesheetId,[
            ["status","=","new"],
            ["ref_timeSheetSubmit","=",null]
        ]);
        $submitApproval = $this->objectName->create([
            "timeSheet_id"=>$timsesheetId,
            "idUser"=>session()->get("sessionKey")["id"],//get session value should be from controller
            "status_submit"=>"new",
            "attemp"=>1,
            "submitDate"=>Carbon::now(),
            "message"=>"",
            "title"=>"Pengajuan Tanggal ".$timesheet_act_new_without_ref[0]." s.d. ".$timesheet_act_new_without_ref[1]
        ]);

        if ($submitApproval){
            $this->timesheet_act_repo->Set_ref_submit($submitApproval->id,$timsesheetId);
        }

        return $this->objectName->where("id",$submitApproval->id)->get();
        
        
    }

    public function approvalListTimesheetDetailOfficer($uuid){
        return $this->getByUUid($uuid)->load(["timesheetactivity","user"])->first();
    }

   
}