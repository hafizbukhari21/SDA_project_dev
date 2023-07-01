<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Repository\AuthRepository;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class authWebController extends Controller
{

    public AuthRepository $authRepo;
    protected $guard;

    public function __construct(AuthRepository $authRepository){
        $this->authRepo = $authRepository;
        $this->guard = Auth::setDefaultDriver("web");
    }
    

    public function loginWeb(Request $req){

        $token = $this->authRepo->LoginJwt($req);
        if($token==null) return  "Gagal Login";


        $req->session()->put("sessionKey",$req->User());

        return redirect("dashboard");

    }

    public function logoutWeb(Request $request){
        auth()->logout();
        $request->session()->forget('sessionKey');
        return redirect("");
    }



}