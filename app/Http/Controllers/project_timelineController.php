<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repository\Data\Project_timelineRepository;
use App\Repository\Data\ProjectRepository;
use Illuminate\Http\Request;

class project_timelineController extends Controller
{
    public Project_timelineRepository $project_timelineRepository;
    public ProjectRepository $projectRepository;
    public function __construct(Project_timelineRepository $project_timelineRepository, ProjectRepository $projectRepository){
        $this->project_timelineRepository = $project_timelineRepository;
        $this->projectRepository = $projectRepository;
    }


    public function setTimelineProject(Request $req){
        return $this->project_timelineRepository->insert($req);
    }

   
}
