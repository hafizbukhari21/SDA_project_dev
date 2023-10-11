<?php

namespace App\Providers;

use App\Console\Commands\sendTaskTimelineEmail;
use App\Repository\Data\Project_timelineRepository;
use App\Services\SendNotifActivityTimelineProject;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Support\ServiceProvider;
use \Illuminate\Support\Facades\URL;
use Illuminate\Contracts\Foundation\Application;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //

        $this->app->bind(SendNotifActivityTimelineProject::class,function (Application $app){
            return new SendNotifActivityTimelineProject($app->make(Project_timelineRepository::class));
        });

    

        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        if ($this->app->environment('production')) {
            URL::forceScheme('https');
        }

        
    }
}
