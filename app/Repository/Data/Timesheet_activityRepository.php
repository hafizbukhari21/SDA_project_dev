<?php 
namespace App\Repository\Data;
use App\Models\timesheetactivity;
use App\Repository\GeneralRepository;

class Timesheet_activityRepository extends GeneralRepository{
    public function __construct(){
        $this->objectName = new timesheetactivity();
    }
}