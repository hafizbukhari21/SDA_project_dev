<?php
namespace App\Repository\Data;

use App\Models\notification;
use App\Repository\GeneralRepository;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Dflydev\DotAccessData\Data;
use Illuminate\Support\Str;


class NotificationRepository extends GeneralRepository{
    public function __construct(){
        $this->objectName = new  notification();
    }

    public function CreateNotifAsTimeline($idTimeline){
        $notifTimeline = $this->objectName;
        $notifTimeline->uuid = Str::orderedUuid();
        $notifTimeline->group = "timeline";
        $notifTimeline->timelineId=$idTimeline;

        return $notifTimeline->save();

    }

    public function SetNotifBar(){
        $notifTimelines = $this->objectName->get()->load(["timeline","timesheet_submit"]);
        $carbon = CarbonImmutable::now();
        $carbonPrev2Day = $carbon->add(-2,"day");
        $carbonNext2Day = $carbon->add(2,"day");

        //cek kalo notif kosong
        if(!$notifTimelines) return [];

        // $notifTimelines = $notifTimelines->where("timeline.to",);

        return $notifTimelines;
    }

}