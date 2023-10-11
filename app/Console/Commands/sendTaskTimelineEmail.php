<?php

namespace App\Console\Commands;

use App\Repository\Data\Project_timelineRepository;
use App\Services\SendNotifActivityTimelineProject;
use Illuminate\Console\Command;

class sendTaskTimelineEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-task-timeline-email';

    public SendNotifActivityTimelineProject $SendNotif;

    public function __construct(SendNotifActivityTimelineProject $sendNotifActivityTimelineProject){

        parent::__construct($sendNotifActivityTimelineProject);
        $this->SendNotif = $sendNotifActivityTimelineProject;
    }

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send Email to PIC and Head Per project timeline';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->SendNotif->SendEmailTo();
    }
}
