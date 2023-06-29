<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Interfaces\UserInterface;
use App\Repository\AuthRepository;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

class authController extends Controller
{
    public AuthRepository $authRepository;

    public function __construct(AuthRepository $authRepository){
        $this->authRepository = $authRepository;
    }

    //API & WEB
    public function returnAllUser(){
        return $this->authRepository->getAll();
    }

    //API
    public function returnLoginApi(Request $req){
        $req->validate([
            "email"=>"required",
            "password"=>"required",
        ]);
       if(!$response= $this->authRepository->LoginJwt($req)) 
            return response(null, 401);
       else 
            return response()->json(compact("response"));
       
    }
    //API
    public function returnLogoutApi(){
        auth()->logout();
    }

    //API
    public function returnUserDetail(Request $req){
      return $req->User();
    }




}
