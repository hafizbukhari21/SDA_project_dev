<?php 
namespace App\Repository\Data;
use App\Models\timesheetactivity;
use App\Repository\GeneralRepository;
use App\Utils\DatatableFormater;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

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


    public function GetTimesheetActPagination(Request $request,$idTimesheet){
        $query = $this->objectName->
        where("timeSheet_id",$idTimesheet)
        ->where("title","like","%".$request->input('search.value')."%")
        ->orWhere("detail_activity","like","%".$request->input('search.value')."%")
        ->orWhere("activity_date","like","%".$request->input('search.value')."%");
        
        //Request, Base Query, Urutan Column datatable
        return DatatableFormater::format($request,$query,[
            "title",
            "title",
            "status",
            "activity_date",
            "from",
            "finish",
            "finish"
        ]);
    }

   
    

}