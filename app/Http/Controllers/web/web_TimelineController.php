<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Repository\Data\Project_timelineRepository;
use Illuminate\Http\Request;

class web_TimelineController extends Controller
{
    public Project_timelineRepository $timelineRepo;

    public function __construct(Project_timelineRepository $project_timelineRepository){
        $this->timelineRepo = $project_timelineRepository;
    }

    public function updateTimeline(Request $req){
        return $this->timelineRepo->UpdateTimeline_from_and_to_only($req);
    }
}
