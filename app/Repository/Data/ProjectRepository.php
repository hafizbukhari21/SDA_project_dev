<?php 

namespace App\Repository\Data;
use App\Repository\GeneralRepository;
use App\Models\project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProjectRepository extends GeneralRepository{

  

    public function __construct(){
        $this->objectName = new project();
    }

    public function myProject(Request $req){
        return $this->objectName->where("pic_id",$req->User()->id)->get(); 
    }

    public function getProjectDetail($project_id){
        return $this->objectName->where("id","=",$project_id)->get()->load("projects_timeline","pic_id","category_project")->first();
    }

    public function getProjectWith_PicAndCreator(){
        return $this->objectName->where("user_creator_id",session()->get("sessionKey")["id"])->get()->load("pic_id","user_creator","category_project");

    }

    public function cekProjectOwnerShip(Request $req,$project_id){
        
        $project = $this->objectName
                    ->where([
                        "user_creator_id"=>$req->user()->id,
                        "id"=>$project_id
                    ])->first();

        if($project == null) return null;
        else return $project;

    }
    public function cekProjectOwnerShip_Web(Request $req,$project_id){
        
        $project = $this->objectName
                    ->where([
                        "user_creator_id"=>session()->get("sessionKey")["id"],
                        "id"=>$project_id
                    ])->first();

        if($project == null) return null;
        else return $project;
    }






}