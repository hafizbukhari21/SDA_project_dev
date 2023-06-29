<?php 

namespace App\Repository;

use Illuminate\Http\Request;

class AuthRepository extends UserRepository {

    
    public function LoginJwt(Request $req){
        if(!$token = auth()->attempt($req->only('email','password')) ){
            return null;
        }

        
        return $token;
    }

    public function LoginWeb(){
     
    }
}

