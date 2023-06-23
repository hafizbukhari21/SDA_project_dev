<?php 

namespace App\Repository\Data;
use App\Repository\GeneralRepository;
use App\Models\project;

class ProjectRepository{

    public GeneralRepository $generalRepository;
    public function __construct(){
        $this->generalRepository = new GeneralRepository(new project());
    }
}