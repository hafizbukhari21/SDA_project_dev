<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Repository\AuthRepository;
use App\Repository\UserRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;
use Carbon\Carbon;


class authWebController extends Controller
{

    public AuthRepository $authRepo;
    public UserRepository $userRepo;
    protected $guard;

    public function __construct(AuthRepository $authRepository, UserRepository $userRepository){
        $this->authRepo = $authRepository;
        $this->userRepo = $userRepository;
        $this->guard = Auth::setDefaultDriver("web");
    }
    

    public function loginWeb(Request $req){

        $checkUserDeleted = $this->userRepo->checkDeletedUser($req->email);

        if($checkUserDeleted) return response([
            "message"=>"User Not Found Or Already Deleted"
        ],400);

        $token = $this->authRepo->LoginJwt($req);
        if($token==null)  return response([
            "message"=>"User Not Found Or Already Deleted"
        ],400);


        Log::info("user ".$req->email." Login in ".Carbon::now());

        $req->session()->put("sessionKey",$req->User());
        return redirect("dashboard");

    }

    public function logoutWeb(Request $request){
        auth()->logout();
        $request->session()->forget('sessionKey');
        return redirect("");
    }

    public function forgotPassword(Request $req){
        $return = null;

        return [
            "status" => $this->authRepo->requestForgotPassword($req,$return),
            "value" => $return
        ];
        
    }

    public function receivedForget($hash){
        return $this->authRepo->processForgetPasswod($hash);

    }

    public function doResetPassword (Request $request){
        return $this->authRepo->doResetPassword($request);
    }


       //Update Password

       public function getUpdatePassword(Request $request){
        $request->validate([
            'newPassword' => 'required',
        ]);
        $idUser = session()->get("sessionKey")["id"];
        return $this->authRepo->getUpdatePassword($idUser,$request);

    }

    

    




}
