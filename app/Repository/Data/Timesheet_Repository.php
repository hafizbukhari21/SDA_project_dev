<?php 
namespace App\Repository\Data;
use App\Models\timesheet;
use App\Repository\GeneralRepository;
use Illuminate\Database\Eloquent\Builder;


class Timesheet_Repository extends GeneralRepository{
    private $g_myId;
    private $userId;
    public function __construct(){
        $this->objectName = new timesheet();
    }

    public function insert($idUser){
      return $this->objectName->create(["idUser"=>$idUser]);
    }

    public function myOfficerTimesheet($myId){
        // return $this->objectName->get()->load(["user"=>function($usr){
        //   $usr->where("myHeadId",$this->g_myId);
        // }]);
        return $this->objectName->whereHas("user",function (Builder $usr) use($myId){
          $usr->where("myHeadId",$myId);
        })->get()->load(["user","timesheetactivity"]);
    }

    public function UnApproveActivity($userId){
      $this->userId=$userId;
      return $this->objectName->get()->load(
        [
          "user"=>function($usr){
            $usr->where("id",$this->userId);
          },
          "timesheetactivity"=>function($timesheetAct){
            $timesheetAct->whereIn("status",['new'])->WhereNull("ref_timeSheetSubmit");
          }
        ]
        
      )->where("user","<>","")->first();
    }
}