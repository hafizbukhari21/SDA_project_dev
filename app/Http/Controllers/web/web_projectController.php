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
        if($this->projectRepo->cekProjectOwnerShip_web($req,$idProject)==null){
            return response(null,401);
        }
        return $this->projectRepo->getProjectDetail($idProject);
    }   

    public function  returnProjectWith_PicAndCreator(){
    
        $payload = ["payload"=>$this->projectRepo->getProjectWith_PicAndCreator()];
        return $payload;
    }
}
