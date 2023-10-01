<?php 

namespace App\Repository\Data;
use App\Repository\GeneralRepository;
use App\Models\project;
use App\Utils\variableChecker;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;


class ProjectRepository extends GeneralRepository{

  use variableChecker;

    public function __construct(){
        $this->objectName = new project();
    }


    public function getTotalProject(){
        return $this->objectName->count();
    }

    public function getTotalProjectOpen(){
        $currentDate = Carbon::now()->format("Y-m-d");

        return $this->objectName->doesntHave("projects_timeline")->orWhere(function($query) use($currentDate){
            $query->whereHas("projects_timeline",function (Builder $q) use($currentDate){
                $q->where("to",">",$currentDate)->orderBy("to","desc");// Project yang punya timeline yang deadlinenya lebih besar dari hari ini
            });
        })->count();
    }

    public function myProject(Request $req){
        return $this->objectName->where("pic_id",$req->User()->id)->get(); 
    }

    public function getAllProjectPaginate(){
        $currentDateTime = Carbon::now()->toDateString();
        return $this->objectName->with(["user_creator","category_project","projects_timeline"=>function($projectTimeline) use($currentDateTime){
            $projectTimeline->where("to","<",$currentDateTime)->first();
        }])->paginate(20);
    }

    public function setProjectUID($projectId){
        $project = $this->objectName->find($projectId);
        $project->uuid = Str::orderedUuid();
        return $project->save();
    }

    public function setStatusUpdate(Request $req){
        $project = $this->objectName->where(['uuid'=> $req->uuid])->first();
        $project->status_progress = $req->status_progerss;
        return  $project->save();
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



}