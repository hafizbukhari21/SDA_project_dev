<?php 

namespace App\Repository\Data;
use App\Models\timesheet_submit;
use App\Repository\GeneralRepository;

class Timesheet_submitRepository extends GeneralRepository{
    public function __construct(){
        $this->objectName = new timesheet_submit();
    }
}