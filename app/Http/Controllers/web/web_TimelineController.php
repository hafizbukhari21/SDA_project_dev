<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Repository\Data\Group_timelineRepository;
use App\Repository\Data\Notification_ReadRepository;
use App\Repository\Data\Project_timelineRepository;
use App\Repository\Data\ProjectRepository;
use App\Repository\Data\NotificationRepository;
use Illuminate\Http\Request;


class web_TimelineController extends Controller
{
    public Project_timelineRepository $timelineRepo;
    public Group_timelineRepository $group_timeline_repo;
    public ProjectRepository $projectRepo;
    public NotificationRepository $notifRepo;

    public Notification_ReadRepository $notifRepoRead;

    public function __construct(Project_timelineRepository $project_timelineRepository, Group_timelineRepository $group_timelineRepository, ProjectRepository $projectRepository, NotificationRepository $notificationRepository, Notification_ReadRepository $notification_ReadRepository ){
        $this->timelineRepo = $project_timelineRepository;
        $this->group_timeline_repo = $group_timelineRepository;
        $this->projectRepo = $projectRepository;
        $this->notifRepo = $notificationRepository;
        $this->notifRepoRead = $notification_ReadRepository;
    }

    public function updateTimeline(Request $req){
        $this->deleteNotifEveryUpdateTimeline($req);
        return $this->timelineRepo->updateById($req);
    }

 

    public function updateTImeLineFull (Request $req){
        $this->deleteNotifEveryUpdateTimeline($req);
        if ($req->to < $req->from) return response(["message"=>"To harus lebih kecil dari from"],422);

        $this->timelineRepo->updateById($req);
        return response(["data"=>$req->all()]);

    }

    private function deleteNotifEveryUpdateTimeline(Request $request){
        //GetTimeline Id di notifRepo first
        $notifRepo = $this->notifRepo->get("timelineId",$request->id)->first();
        //Search Notif Read which to deleted
        $notif_read = $this->notifRepoRead->deleteWhere("id_notif",$notifRepo->id);
        
        return compact("notif_read");
    }

    public function deleteTimeLine(Request $req){
        return $this->timelineRepo->delete($req);
    }

    public function createTimeLine(Request $req){
        $req->validate([
            'task_name' => 'required',
            'idGroup' => 'required',
            'from' => 'required',
            'to' => 'required',
        ]);

        if ($req->to < $req->from) return response(["message"=>"To harus lebih kecil dari from"],422);

        $timeline =  $this->timelineRepo->insert($req);
        $notifFlag = $this->notifRepo->CreateNotifAsTimeline($timeline->id);
    
        return [
            "timeline"=>$timeline,
            "notif"=>$notifFlag
        ];
    }

    public function getTimelineDetail($idTimeline){
        return $this->timelineRepo->get("id",$idTimeline)->first();
    }
    


    //Group 
    public function insertGroup(Request $request){
        $request->validate([
            'Group' => 'required',
            'order' => 'required',
        ]);

        $group = $this->group_timeline_repo->checkDuplicateGroup($request);

        if($group) return response(["message"=>"duplicate group name"],422);

        return $this->group_timeline_repo->insert($request);
    }

    public function deleteGroup(Request $request){
        return $this->group_timeline_repo->delete($request);
    }

    public function getGroupTimeline($idGroup){
        return $this->group_timeline_repo->GetGroupTimeline_FilterGroup($idGroup);
    }

    public function updateGroupOrder(Request $req){
        return $this->group_timeline_repo->updateOrder($req);
    }

    public function updateGroupName(Request $req){
        return $this->group_timeline_repo->updateGroupName($req);
    }

    public function DataExcelNeeded($idProject){
        return [
            "dateInterval"=>$this->timelineRepo->getDateInterval($idProject),
            "GroupWithTimeline"=>$this->group_timeline_repo->GetGroupTimeline_FilterGroup($idProject),
            "TimelineSorted"=>$this->timelineRepo->TimelineSorted($idProject),
            "projectAttr"=>$this->projectRepo->get("id",$idProject)->first()
        ];
    }



    //Testing Repository

    public function GetActivitySchedular(){
        return $this->timelineRepo->GetActivitySchedular();
    }
}
