<?php

namespace App\Observers;

use App\Models\project_timeline;
use App\Utils\Logging;


class projectTimelineObserver
{
    /**
     * Handle the project_timeline "created" event.
     */
    public function created(project_timeline $project_timeline): void
    {

    }

    /**
     * Handle the project_timeline "updated" event.
     */
    public function updated(project_timeline $project_timeline): void
    {
        Logging::logWarn(" Updated project timeline Task  = ".$project_timeline->task_name. " | id = ".$project_timeline->id." | detail = ".$project_timeline->where("id",$project_timeline->id)->get()->first());
    }

    /**
     * Handle the project_timeline "deleted" event.
     */
    public function deleted(project_timeline $project_timeline): void
    {
        Logging::logWarn(" Deleted project timeline = ".$project_timeline->task_name. " | id = ".$project_timeline->id );
    }

    /**
     * Handle the project_timeline "restored" event.
     */
    public function restored(project_timeline $project_timeline): void
    {
        //
    }

    /**
     * Handle the project_timeline "force deleted" event.
     */
    public function forceDeleted(project_timeline $project_timeline): void
    {
        //
    }
}
