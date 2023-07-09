<?php

namespace App\Repository;
use App\Interfaces\GeneralInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use App\Repository\Data\Timesheet_Repository;

class UserRepository {
   
    public User $user;
    public Timesheet_Repository $timesheetRepo;
    public function __construct(User $user, Timesheet_Repository $timesheet_Repository){
        $this->user = $user;
        $this->timesheetRepo = $timesheet_Repository;
    }

    public function get($id){
    }
    public function getAll(){
        return $this->user->all();
    }

    public function getAllHead(){
        return $this->user->where("role","Head")->get();
    }
    public function insert($request){

        $payload = User::create($request->all()) ;
        $timesheetRepo = $this->timesheetRepo->insert($payload->id);
        return [
            "user"=>$payload,
            "timesheet"=>$timesheetRepo
        ];
    }
    
    public function getEmail($email){
        return User::where("email",$email)->get();
    }

    public function getAllUserAndProject(){
        return $this->getAll()->load('project');
    }

    public function getUserAndTimesheet($idUser){
        return $this->user->where("id","=",$idUser)->get()->load("timesheet","myHead");
    }

    
    


    
}