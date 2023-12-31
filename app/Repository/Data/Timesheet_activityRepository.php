<?php 
namespace App\Repository\Data;
use App\Models\timesheetactivity;
use App\Repository\GeneralRepository;
use App\Utils\DatatableFormater;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Timesheet_activityRepository extends GeneralRepository{
    private Timesheet_submitRepository $timesheetSubmitRepo;
    public function __construct(){
        $this->objectName = new timesheetactivity();
    }

    public function UpdateTimesheet (Request $request){
        $timesheet = $this->objectName->where(["uuid"=>$request->uuid])->get()->first();
        $timesheet->title = $request->title;
        $timesheet->detail_activity = $request->detail_activity;
        $timesheet->activity_date=$request->activity_date;
        $timesheet->from = $request->from;
        $timesheet->finish = $request->finish;

        return $timesheet->save();
    }

    public function RemoveActivityFromSubmit_filterWithUUIDSubmitForm($id){
        return $this->objectName->where(["ref_timeSheetSubmit"=>$id])
            ->update([
                'ref_timeSheetSubmit'=>null,
                'status'=>'new'
            ]);
    
    }
    


    public function IsDuplicateActivity($idUser, $activityDate){
        
        $timesheet = $this->objectName->whereHas("timeSheet_id",function (Builder $q) use($idUser){
            $q->where("idUser",$idUser);
        })->where("activity_date",$activityDate)->get()->first();

        return $timesheet?true:false;
    }
    
    public function Set_ref_submit($timesheet_submit,$timesheet_id){
    
       return $this->objectName
            ->where("status","new")
            ->where("ref_timeSheetSubmit",null)
            ->where("timeSheet_id",$timesheet_id)
            ->update(["ref_timeSheetSubmit"=>$timesheet_submit]);
    }


    

    public function RemoveActivityFromSubmit($uuid){
        $ref_timeSheetSubmit = null;
        $activity = $this->objectName->where(["uuid"=>$uuid])->first();
        $activity->status= "new";

        $ref_timeSheetSubmit= $activity->ref_timeSheetSubmit ;

        $activity->ref_timeSheetSubmit = null;

        if ( $activity->save()) return $ref_timeSheetSubmit;
        return false;

    }

    //Untuk Judul Timehseet_submit Table
    public function getFirstandLastDateNew($timesheet_id,$where){
        $payload= $this->objectName
            ->where($where)
            ->where("timeSheet_id",$timesheet_id)
            ->orderBy("activity_date")->get();

        if(isset($payload[0]))
            return [
                $payload[0]->activity_date,
                $payload[count($payload)-1]->activity_date
            ];
        
        else return false; 

    }


    public function GetTimesheetActPagination(Request $request,$idTimesheet){
        $query = $this->objectName->
        where("timeSheet_id",$idTimesheet)
        ->where(function($q) use ($request){
            $q->orWhere("title","like","%".$request->input('search.value')."%")
            ->orWhere("detail_activity","like","%".$request->input('search.value')."%")
            ->orWhere("activity_date","like","%".$request->input('search.value')."%");
        });
        //Request, Base Query, Urutan Column datatable
        return DatatableFormater::format($request,$query,[
            "title",
            "title",
            "status",
            "activity_date",
            "from",
            "finish",
            "finish",
            "finish"
        ]);
    }


    public function approveTimesheetActivity($ref_timeSheetSubmit){
        return $this->objectName
                    ->where(["ref_timeSheetSubmit"=>$ref_timeSheetSubmit])
                    ->update(["status"=>"apv"]);
    }

    public function revTimesheetActivity($ref_timeSheetSubmit){
        return $this->objectName
                    ->where(["ref_timeSheetSubmit"=>$ref_timeSheetSubmit])
                    ->update(["status"=>"rev"]);
    }

    public function reNewTimesheetActivity($ref_timeSheetSubmit){
        return $this->objectName
                    ->where(["ref_timeSheetSubmit"=>$ref_timeSheetSubmit])
                    ->update(["status"=>"new"]);
    }




   
    

}