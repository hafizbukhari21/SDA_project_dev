<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class sendTaskTimelineEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-task-timeline-email';

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
        
    }
}
