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

    public function getMyProject(Request $req, $idProject){
        // if($this->projectRepo->cekProjectOwnerShip_web($req,$idProject)==null){
        //     return response(null,401);
        // }
        return $this->projectRepo->getProjectDetail($idProject);
    }   

    public function  returnGetAllProject(){
    
        return $this->projectRepo->getProjectWith_PicAndCreator();
    }

    public function returnProjectId(){
        return $this->projectRepo->getProjectList();
    }

    public function setProject(Request $req){
        if (session()->get("sessionKey")["role"]=="Officer") $req->merge(["user_creator_id" => session()->get("sessionKey")["id"]]);//Role Officer
        return $this->projectRepo->insert($req);
    }

    public function deleteProject (Request $req){
        return $this->projectRepo->delete($req);
    }

    public function setUpdateProject(Request $req){
        if (session()->get("sessionKey")["role"]=="Officer") $req->merge(["user_creator_id" => session()->get("sessionKey")["id"]]);//Role Officer 
        return $this->projectRepo->updateProject($req);
    }

    public function searchProjectLikeName(Request $req){
        return $this->projectRepo->searchProjectLikeName($req);
    }

    public function loadTimelinePage($id){
        $payload = $this->projectRepo->get("id",$id)->first();
        return view("Pages.general.project.timeline",compact("payload"));

    }

    

    


    

}
