<?php 

namespace App\Repository\Data;
use App\Repository\GeneralRepository;
use App\Models\project;
use Illuminate\Http\Request;


class ProjectRepository extends GeneralRepository{

  

    public function __construct(){
        $this->objectName = new project();
    }

    public function myProject(Request $req){
        return $this->objectName->where("pic_id",$req->User()->id)->get(); 
    }

    public function getProjectDetail($project_id){
        return $this->objectName->get()->load("projects_timeline")
            ->where("id","=",1);
    }

    public function cekProjectOwnerShip(Request $req,$project_id){
        $project = $this->objectName
                    ->where([
                        "pic_id"=>$req->User()->id,
                        "id"=>$project_id
                    ])->first();

        if($project == null) return null;
        else return $project;

    }





}