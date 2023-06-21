<?php 

namespace App\Repository\Data;
use App\Repository\GeneralRepository;
use App\Models\project;

class ProjectRepository{

    public GeneralRepository $generalRepository;
    public function __construct(){
        $project = new project();
        $this->generalRepository = new GeneralRepository($project);
    }
}