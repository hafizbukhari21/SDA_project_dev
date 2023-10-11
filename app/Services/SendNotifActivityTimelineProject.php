<?php 

namespace App\Services;

use App\Mail\timelineNotif;
use App\Repository\Data\Project_timelineRepository;
use Exception;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class SendNotifActivityTimelineProject{

    private  Project_timelineRepository $timelineRepo;
    public function __construct(Project_timelineRepository $project_timelineRepository){
        $this->timelineRepo = $project_timelineRepository;
    }

    public function SendEmailTo(){
        Log::info("start - Sending Email");
       try{ 
            $notifSending_s = $this->timelineRepo->GetActivitySchedular();

            foreach($notifSending_s as $notifSending){
                Mail::to($notifSending["emailOfficer"])->send(new timelineNotif(
                    $notifSending["officerName"],$notifSending["projectName"],$notifSending["taskName"],$notifSending["deadline"]));

                Mail::to($notifSending["emailhead"])->send(new timelineNotif(
                    $notifSending["headName"],$notifSending["projectName"],$notifSending["taskName"],$notifSending["deadline"]));

                Log::info("sending to Officer = ".$notifSending["officerName"]." - Email ".$notifSending["emailOfficer"]." | Head = ".$notifSending["headName"]." - Email ".$notifSending["emailhead"]);
            }

       }catch(Exception $e){
            Log::error($e->getMessage());
       }
    }
}