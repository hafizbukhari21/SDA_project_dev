<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Repository\Data\ProjectRepository;
use App\Utils\Logging;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class web_projectController extends Controller
{
    public ProjectRepository $projectRepo;
    public function __construct(ProjectRepository $projectRepository){
        $this->projectRepo = $projectRepository;
    }

    public function getTotalProject(){
        $totalProject =  $this->projectRepo->getTotalProject();
        $totalProjectOpen = $this->projectRepo->getTotalProjectOpen();
        $totalProjectClosed = $totalProject-$totalProjectOpen;

        return compact("totalProject","totalProjectOpen","totalProjectClosed");
    }


    public function getMyProject(Request $req, $idProject){
        // if($this->projectRepo->cekProjectOwnerShip_web($req,$idProject)==null){
        //     return response(null,401);
        // }
        return $this->projectRepo->getProjectDetail($idProject);
    }  
    

    public function setStatusUpdate(Request $req){
        return $this->projectRepo->setStatusUpdate($req);
    }
    public function  returnGetAllProject(){
    
        return $this->projectRepo->getProjectWith_PicAndCreator();
    }

    public function returnProjectId(){
        return $this->projectRepo->getProjectList();
    }

    public function setProject(Request $req){
        Logging::logInfo("Created Project.project_name = ".$req->project_name );

        if (session()->get("sessionKey")["role"]=="Officer") $req->merge(["user_creator_id" => session()->get("sessionKey")["id"]]);//Role Officer
        if ($this->projectRepo->get("idProjectJalin",$req->idProjectJalin)->first()) return response(["message"=>"ID QAMS Sudah digunakan"],412);//Cek idQAMS udah dipake belum

        $this->validateRequest($req);

        $project =  $this->projectRepo->insert($req);
        $statusUUid = $this->projectRepo->setProjectUID($project->id);
        return $project;
    }

    public function validateRequest(Request $request){
        $request->validate([
            'project_name' => 'required',
            'idProjectJalin' => 'required',
            'pic_am'=>'required',
            'user_creator_id'=>'required',
            'category_id'=>'required',
            'time'=>'required',
            'urgensi'=>'required',
        ]);
    }
    


    public function deleteProject (Request $req){
        //Reset idProjectjalin or id qams first when project deleted
        $project = $this->projectRepo->get("id",$req->id)->first();
        $project->idProjectJalin = "";
        $project->save();

        Logging::logWarn("Deleted Project.project_name = ".$project->project_name );


        return $this->projectRepo->delete($req);
    }

    public function setUpdateProject(Request $req){
        if (session()->get("sessionKey")["role"]=="Officer") $req->merge(["user_creator_id" => session()->get("sessionKey")["id"]]);//Role Officer 
        return $this->projectRepo->updateById($req);
    }

    public function searchProjectLikeName(Request $req){
        return $this->projectRepo->searchProjectLikeName($req);
    }

    public function loadTimelinePage($id){
        $payload = $this->projectRepo->get("id",$id)->first();
        return view("Pages.general.project.timeline",compact("payload"));

    }


    public function getAllProjectDashboard(){
        return $this->projectRepo->getAllProjectPaginate();
    }

    

    

    

}
