<?php 
namespace App\Repository\Data;
use App\Models\timesheet;
use App\Repository\GeneralRepository;

class Timesheet_Repository extends GeneralRepository{
    private $g_myId;
    public function __construct(){
        $this->objectName = new timesheet();
    }

    public function insert($idUser){
      return $this->objectName->create(["idUser"=>$idUser]);
    }


    public function myOfficerTimesheet($myId){
        $this->g_myId = $myId;
        return $this->objectName->get()->load(["user"=>function($usr){
          $usr->where("myHeadId",$this->g_myId);
        }])->where("user","<>","");
    }
}