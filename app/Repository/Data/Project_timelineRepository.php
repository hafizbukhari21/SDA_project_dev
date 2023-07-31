<?php 

namespace App\Repository\Data;
use App\Models\project_timeline;
use App\Repository\GeneralRepository;
use Illuminate\Http\Request;

class Project_timelineRepository extends GeneralRepository{

    public function __construct(){
        $this->objectName = new project_timeline();
    }

    public function UpdateTimeline_from_and_to_only(Request $req){
        $timeline = $this->objectName->find($req->id);
        $timeline->from = $req->from;
        $timeline->to=$req->to;
        $timeline->save();
        return $timeline;

    }

    public function updateTImeLineFull(Request $req){
        $timeline = $this->objectName->find($req->id);
        $timeline->from = $req->from;
        $timeline->to=$req->to;
        $timeline->notes=$req->notes;
        $timeline->task_name=$req->task_name;
        $timeline->idGroup=$req->idGroup;
        $timeline->save();

        return $timeline;
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
}