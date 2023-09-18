<?php 

namespace App\Repository\Data;
use App\Models\group_timeline;
use App\Repository\GeneralRepository;
use App\Utils\variableChecker;
use Illuminate\Http\Request;

class Group_timelineRepository extends GeneralRepository{

    use variableChecker;
    private $idProjectGlobal;
    public function __construct(){
        $this->objectName = new group_timeline();
    }


    public function GetGroupTimeline_FilterGroup($idProject){
        $this->idProjectGlobal = $idProject;
        return $this->objectName->where("idProject","=",$idProject)->orderBy("order")->get()->load(["projects"=>function($project){
            $project->where("project_id",$this->idProjectGlobal)->orderBy("from","asc");
        }]);
        
    }

    
    public function updateOrder(Request $req){
        $group  =$this->objectName->find($req->id);

        if($this->checkVariable_isValid($req->order))$group->order = $req->order;
        else $group->order = 0;
        $group->save();
        return $group; 
    }

    public function updateGroupName(Request $req){
        $group  =$this->objectName->find($req->id);
        if($this->checkVariable_isValid($req->Group))$group->Group = $req->Group;
        $group->save();
        return $group; 
    }


    public function checkDuplicateGroup(Request $req){
        return $this->objectName
                ->where([
                    ["Group","=",$req->Group],
                    ["idProject","=",$req->idProject]
                ])->get()->first();
            
    }
}