<?php 

namespace App\Services;

use App\Repository\Data\Project_timelineRepository;
use Exception;
use Illuminate\Support\Facades\Log;

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
            
        }
       }catch(Exception $e){
            Log::error($e->getMessage());
       }
    }
}