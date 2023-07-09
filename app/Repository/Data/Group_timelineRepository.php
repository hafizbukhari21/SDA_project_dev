<?php 

namespace App\Repository\Data;
use App\Models\group_timeline;
use App\Repository\GeneralRepository;


class Group_timelineRepository extends GeneralRepository{
    public function __construct(){
        $this->objectName = new group_timeline();
    }
}