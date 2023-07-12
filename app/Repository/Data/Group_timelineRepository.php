<?php 

namespace App\Repository\Data;
use App\Models\group_timeline;
use App\Repository\GeneralRepository;


class Group_timelineRepository extends GeneralRepository{
    private $idProjectGlobal;
    public function __construct(){
        $this->objectName = new group_timeline();
    }


    public function GetGroupTimeline_FilterGroup($idProject){
        $this->idProjectGlobal = $idProject;
        return $this->objectName->get()->load(["projects"=>function($project){
            $project->where("project_id",$this->idProjectGlobal);
        }]);
        
    }
}