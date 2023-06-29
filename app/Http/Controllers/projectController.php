<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repository\Data\ProjectRepository;
use Illuminate\Http\Request;

class projectController extends Controller
{
    public ProjectRepository $projectRepository;
    public function __construct(ProjectRepository $projectRepository){
        $this->projectRepository = $projectRepository;
    }
 
    public function setMyProject(Request $req){
        return $this->projectRepository->insert($req);
        
    }

    public function returnMyProject_all(Request $req){
        $payload = $this->projectRepository->myProject($req);
        return response()->json(compact("payload"));

    }

    public function returnMyProject(Request $req,$idProject){
        //project Ownership Check
        
        if($this->projectRepository->cekProjectOwnerShip($req,$idProject)==null){
            return response(null,401);
        }
        return $this->projectRepository->getProjectDetail($idProject);

    }

    

    
}
