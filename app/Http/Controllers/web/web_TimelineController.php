<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Repository\Data\Group_timelineRepository;
use App\Repository\Data\Project_timelineRepository;
use Illuminate\Http\Request;

class web_TimelineController extends Controller
{
    public Project_timelineRepository $timelineRepo;
    public Group_timelineRepository $group_timeline_repo;

    public function __construct(Project_timelineRepository $project_timelineRepository, Group_timelineRepository $group_timelineRepository){
        $this->timelineRepo = $project_timelineRepository;
        $this->group_timeline_repo = $group_timelineRepository;
    }

    public function updateTimeline(Request $req){
        return $this->timelineRepo->UpdateTimeline_from_and_to_only($req);
    }

    public function updateTImeLineFull (Request $req){
        return $this->timelineRepo->updateTImeLineFull($req);
    }

    public function deleteTimeLine(Request $req){
        return $this->timelineRepo->delete($req);
    }

    public function createTimeLine(Request $req){
        return $this->timelineRepo->insert($req);
    }

    public function getTimelineDetail($idTimeline){
        return $this->timelineRepo->get("id",$idTimeline)->first();
    }

    public function getGroupTimeline($idGroup){
        return $this->group_timeline_repo->GetGroupTimeline_FilterGroup($idGroup);
    }
}
