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

    public function returnAllUser(){
        return $this->authRepository->getAll();
    }


    public function returnLoginApi(Request $req){
        // $req->validate([
        //     "email"=>"required",
        //     "password"=>"required",
        // ]);
        return $this->authRepository->LoginJwt($req);
    }


}
