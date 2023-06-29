<?php 

namespace App\Repository\Data;
use App\Repository\GeneralRepository;
use App\Models\project;
use Illuminate\Http\Request;


class ProjectRepository extends GeneralRepository{


    public function __construct(){
        $this->objectName = new project();
    }

    public function myProject(Request $req){
        return $this->objectName->where("pic_id",$req->User()->id)->get(); 
    }





}