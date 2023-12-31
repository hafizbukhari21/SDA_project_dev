<?php

namespace App\Repository;
use App\Interfaces\GeneralInterface;
use App\Mail\forgot_password;
use App\Mail\Mailer;
use App\Models\forget_password;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\User;
use GuzzleHttp\Psr7\Request;
use App\Repository\Data\Timesheet_Repository;
use Carbon\Carbon;
use Exception;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request as RequestHttp;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;
use PhpParser\Node\Stmt\Catch_;


class UserRepository {
   
    public User $user;
    public forget_password $forget_password;
    public Timesheet_Repository $timesheetRepo;
    public function __construct(User $user, Timesheet_Repository $timesheet_Repository, forget_password $forget_password){
        $this->user = $user;
        $this->timesheetRepo = $timesheet_Repository;
        $this->forget_password = $forget_password;
    }

    public function get(RequestHttp $request){
        return $this->user->find($request->id);
    }
    public function getAll(){
        return $this->user->where("isDeleted","0")->get();
    }

    public function getAllHead(){
        return $this->user->where("role","Head")->get();
    }

    //Only For Login as Head
    public function getAllMyOfficer(){
        return $this->user->where("myHeadId",session()->get("sessionKey")["id"])->get();
    }
    public function insert($request){

        $timesheetRepo = null;
        if($request->role !="Officer") $request->merge(["myHeadId" => null]);
        $payload = User::create($request->all()) ;

        $timesheetRepo = $this->timesheetRepo->insert($payload->id);
        $userUUid = $this->setUserUID($payload->id);
        return [
            "user"=>$payload,
            "timesheet"=>$timesheetRepo,
            "userUuid"=>$userUUid
        ];
    }

    public function update(RequestHttp $req){
        $user = $this->user->find($req->id);
        $user->name = $req->name;
        $user->email = $req->email;
        $user->role = $req->role;
        if($req->role == "Officer") $user->myHeadId = $req->myHeadId;
        else $user->myHeadId = null;

        return $user->save();


    }

    public function deleteInactiveUser(RequestHttp $req){
        $user = $this->user->find($req->id);
        $user->email = null;
        $user->isDeleted = true;
        if($user->save()) 
            Log::info("user [".session()->get("sessionKey")["name"].
            "] Deleted Inactive User : [".$user->name." | ".$user->uuid."]On ".Carbon::now());

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

    public function setUserUID($userid){
        $user = $this->user->find($userid);
        $user->uuid = Str::orderedUuid();
        return $user->save();
    }

    public function getUserUIDbyId($userid){
        return $this->user->find($userid)->uuid;
        
    }

    public function requestForgotPassword(RequestHttp $req, &$return){
        $currentTime = Carbon::now();
        $email = $req->email;

        

        $user = $this->user->where("email",$email)->get()->first();

        if(!$user->email) return response(["message"=>$user],412);

        //Check if ever forget password
        $forget_pass_data = $this->forget_password->whereHas("user",
        function( Builder $user) use($email){
            $user->where("email",$email);
        })->first();

        
        //If Forgetpassword doesnt exist for specifict user
        if(!$forget_pass_data){
            $forgetPassNew = new forget_password();
            $forgetPassNew->idUser = $user->id;
            $forgetPassNew->hash = hash("md5", $user->uuid);
            $forgetPassNew->expiredTime = $currentTime->addMinutes(20)->toDateTimeString();
            $return = $forgetPassNew->save();
        }
        //if Exist just updatate
        else{
           $forget_pass_data->expiredTime = $currentTime->addMinutes(20)->toDateTimeString();
           $forget_pass_data->hash = hash("md5", Str::Uuid());
           $return = $forget_pass_data->save();
        }

        $userData = $this->user->where("email",$email)->get()->load("forget_password")->first();

        try{
            if($return) {
                Mail::to($user->email)->send(new forgot_password($userData));
                return response(["message"=>"success"],200);
            }
            return response(["message"=>"something Wrong"],200);

        }catch(Exception $e){
            return response(["message"=>$e],500);
        }

    }   


    public function processForgetPasswod($hash){
        $forget_password= $this->forget_password->where("hash",$hash)->first();
        $currentDateTime = Carbon::now()->toDateTimeString();
        
        if(!$forget_password) return "Not Found";
        else if($forget_password->expiredTime<$currentDateTime) return "expired";
        else return view("Pages.auth.forgetPasswordForm");
    }

    public function doResetPassword(RequestHttp $request){
        $forgetPassword = $this->forget_password->where("hash",$request->hash)->first();
        $user = $this->user->where("id",$forgetPassword->idUser)->first();
        $user->password = $request->password;
        return $user->save();

    }

    public function checkDeletedUser($email){
        $user =$this->user->where("email",$email)->get()->first();
        return $user?false:true;//if user has been deleted return false
    }


    public function getUpdatePassword($idUser,RequestHttp $request){
        

        $user = $this->user->find($idUser);
        $user->password = $request->newPassword;
        $res=$user->save();
        if($res>0){
            Log::info("user id User =".$idUser." Update Password");
            return $res;
        }

        return null;
    }


    


    
}