<?php 
namespace App\Repository\Data;
use App\Models\timesheet;
use App\Repository\GeneralRepository;

class Timesheet_Repository extends GeneralRepository{
    public function __construct(){
        $this->objectName = new timesheet();
    }

    public function insert($idUser){
      return $this->objectName->create(["idUser"=>$idUser]);
    }

}