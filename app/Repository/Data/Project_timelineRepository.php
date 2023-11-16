<?php 

namespace App\Repository\Data;
use App\Models\project_timeline;
use App\Models\User;
use App\Repository\GeneralRepository;
use Carbon\Carbon;
use Illuminate\Http\Request;

class Project_timelineRepository extends GeneralRepository{

    public function __construct(){
        $this->objectName = new project_timeline();
    }

   
    public function getDateInterval($idProject){
        $payload = $this->TimelineSorted($idProject);
        $payload_to = $this->TimelineSorted_to($idProject);
        $totalData=count($payload);
        return [
            "start"=>$payload[0]["from"],
            "finish"=>$payload_to[$totalData-1]["to"]
        ];
    }

    public function TimelineSorted($idProject){
        return $this->objectName->where(["project_id"=>$idProject])->orderby("from")->get();
    }
    public function TimelineSorted_to($idProject){
        return $this->objectName->where(["project_id"=>$idProject])->orderby("to")->get();

    }

    //for Mailer 
    public function GetActivitySchedular() {
        $currentDate = Carbon::now()->format("Y-m-d");
        
        return $this->objectName->where("to",$currentDate)
            ->whereHas("project.user_creator")
            ->get()->load(["project","project.user_creator","project.user_creator.myHead"])
            ->map(function ($payload){
                $myheadData = User::find($payload->project->user_creator->myHeadId);
                return [
                    "emailOfficer"=> $payload->project->user_creator->email,
                    "emailhead"=>$myheadData->email,
                    "taskName"=>$payload->task_name,
                    "projectName"=>$payload->project->project_name,
                    "deadline"=>$payload->to,
                    "officerName"=>$payload->project->user_creator->name,
                    "headName"=>$myheadData->name
                ];
            });

       

        
        
        
    }
}