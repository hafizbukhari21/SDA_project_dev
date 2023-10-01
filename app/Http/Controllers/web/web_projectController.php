<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Repository\Data\ProjectRepository;
use Illuminate\Http\Request;

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
        if (session()->get("sessionKey")["role"]=="Officer") $req->merge(["user_creator_id" => session()->get("sessionKey")["id"]]);//Role Officer
        $project =  $this->projectRepo->insert($req);
        $statusUUid = $this->projectRepo->setProjectUID($project->id);
        return $project;
    }

    public function deleteProject (Request $req){
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
