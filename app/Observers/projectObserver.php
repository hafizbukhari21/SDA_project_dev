<?php

namespace App\Observers;

use App\Models\project;
use App\Utils\Logging;

class projectObserver
{
    /**
     * Handle the project "created" event.
     */
    public function created(project $project): void
    {
        Logging::logInfo(" Created project  = ".$project->project_name. " | uuid = ".$project->uuid );
    }

    /**
     * Handle the project "updated" event.
     */
    public function updated(project $project): void
    {
        Logging::logWarn(" Updated project  = ".$project->project_name. " | uuid = ".$project->uuid." | detail = ".$project->where("uuid",$project->uuid)->get()->first());

    }

    /**
     * Handle the project "deleted" event.
     */
    public function deleted(project $project): void
    {
        Logging::logWarn(" Deleted project  = ".$project->project_name. " | uuid = ".$project->uuid );

    }

    /**
     * Handle the project "restored" event.
     */
    public function restored(project $project): void
    {
        //
    }

    /**
     * Handle the project "force deleted" event.
     */
    public function forceDeleted(project $project): void
    {
        //
    }
}
