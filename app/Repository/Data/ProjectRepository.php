<?php 

namespace App\Repository\Data;
use App\Repository\GeneralRepository;
use App\Models\project;
use App\Utils\variableChecker;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ProjectRepository extends GeneralRepository{

  use variableChecker;

    public function __construct(){
        $this->objectName = new project();
    }

    public function myProject(Request $req){
        return $this->objectName->where("pic_id",$req->User()->id)->get(); 
    }

    public function setProjectUID($projectId){
        $project = $this->objectName->find($projectId);
        $project->uuid = Str::orderedUuid();
        return $project->save();
    }

    public function getProjectDetail($project_id){
        //return $this->objectName->where("id","=",$project_id)->get()->load("projects_timeline","pic_id","category_project")->first();

        $projects = $this->objectName->where("id","=",$project_id)->get()->load("user_creator");
        foreach($projects as $project){
           $project->load(["projects_timeline"=>function($pt){
            $pt->whereHas("group",function(Builder $q){
                $q->whereNull("deleted_at");//Ngakalin soft delete jadi kalo deleted_at nya null berarti kan datanya masih ada 
            });
            $pt->orderby("from","asc");
           }]);

           $project->load("category_project");
           foreach($project->projects_timeline as $timeline){
            $timeline->load("group");
           }

        }
        return $projects->first();
    }

    public function getProjectWith_PicAndCreator(){
        if (session()->get("sessionKey")["role"]=="Head") 
            return $this->objectName
                ->whereHas("user_creator", function($userCreatorId){
                    $userCreatorId->myHeadId = session()->get("sessionKey")["id"];
                })
                ->get()->load("user_creator","category_project");

        return $this->objectName->where("user_creator_id",session()->get("sessionKey")["id"])->get()->load("user_creator","category_project");//get session value should be from controller
    }



    public function getProjectList(){
        $payloads=$this->objectName->get();
        $response = array();
        foreach($payloads as $payload){
            $response[] = array (
                "id"=>$payload->id,
                "project_name"=>$payload->project_name
            );
        }

        return $response;
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

    public function searchProjectLikeName(Request $req){
        if($this->checkVariable_isValid($req->project_name)) return $this->objectName->where("project_name","like","%".$req->project_name."%")->get();
        else return [];

    }

   
    public function cekProjectOwnerShip_Web(Request $req,$project_id){
        
        $project = $this->objectName
                    ->where([
                        "user_creator_id"=>session()->get("sessionKey")["id"],//get session value should be from controller
                        "id"=>$project_id
                    ])->first();

        if($project == null) return null;
        else return $project;
    }


    public function updateProject(Request $req){
        $project =  $this->objectName->find($req->id);
        $project->project_name = $req->project_name;
        $project->user_creator_id = $req->user_creator_id;
        $project->category_id = $req->category_id;
        $project->status = $req->status;
        $project->time = $req->time;
        $project->pic_am = $req->pic_am;
        $project->urgensi = $req->urgensi;
        if($project->save()){
            return $project;
        }

        return null;


    }

    

    






}