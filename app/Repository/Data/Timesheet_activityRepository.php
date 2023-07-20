<?php 
namespace App\Repository\Data;
use App\Models\timesheetactivity;
use App\Repository\GeneralRepository;
use Illuminate\Http\Request;

class Timesheet_activityRepository extends GeneralRepository{
    public function __construct(){
        $this->objectName = new timesheetactivity();
    }

    public function UpdateTimesheet (Request $request){
        $timesheet = $this->objectName->find($request->id);
        $timesheet->title = $request->title;
        $timesheet->detail_activity = $request->detail_activity;
        $timesheet->activity_date=$request->activity_date;
        $timesheet->from = $request->from;
        $timesheet->finish = $request->finish;

        return $timesheet->save();
    }

   
    

}