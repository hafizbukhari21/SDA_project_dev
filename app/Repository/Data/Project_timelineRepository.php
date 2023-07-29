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
}