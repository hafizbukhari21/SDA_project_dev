<?php 

namespace App\Repository;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthRepository extends UserRepository {

    
    public function LoginJwt(Request $req){
        if(!$token = auth()->attempt($req->only('email','password')) ){
            return null;
        }

        
        return $token;
    }

    public function LoginWeb(Request $req){
        if(Auth::guard("api"));
    }

  
}

