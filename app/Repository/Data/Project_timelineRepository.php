<?php 

namespace App\Repository\Data;
use App\Models\project_timeline;
use App\Repository\GeneralRepository;


class Project_timelineRepository extends GeneralRepository{

    public function __construct(){
        $this->objectName = new project_timeline();
    }
}