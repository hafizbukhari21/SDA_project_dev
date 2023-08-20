<?php
namespace App\Repository\Data;

use App\Models\notification;
use App\Repository\GeneralRepository;
use App\Repository\UserRepository;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Str;


class NotificationRepository extends GeneralRepository{
    private UserRepository $useRepo;
    public function __construct(UserRepository $userRepository){
        $this->objectName = new  notification();
        $this->useRepo = $userRepository;
    }

    public function CreateNotifAsTimeline($idTimeline){
        $notifTimeline = $this->objectName;
        $notifTimeline->uuid = Str::orderedUuid();
        $notifTimeline->group = "timeline";
        $notifTimeline->timelineId=$idTimeline;

        return $notifTimeline->save();

    }

    public function SetNotifBar($userId){
        $carbon = CarbonImmutable::now();
        $carbonPrev2Day = $carbon->add(-2,"day")->format("Y-m-d");
        $carbonNext2Day = $carbon->add(2,"day")->format("Y-m-d");
        $userUid = $this->useRepo->getUserUIDbyId($userId);
        $notifBar = $this->objectName->whereHas("timeline",function($timeline) use($carbonPrev2Day,$carbonNext2Day){
            $timeline->whereBetween("to",[$carbonPrev2Day,$carbonNext2Day]);
        })->get()->load("timeline.project", "timesheet_submit");

        
        //cek kalo notif kosong
        if(!$notifBar) return compact(["userUid",""]);
       
        return compact(["notifBar","userUid"]);
    }

}