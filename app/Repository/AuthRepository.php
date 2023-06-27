<?php 

namespace App\Repository;

use Illuminate\Http\Request;

class AuthRepository extends UserRepository {

    
    public function LoginJwt(Request $req){
        if(!$token = auth()->attempt($req->only('email','password')) ){
            return response(null, 401);
        }

        
        return response()->json(compact('token'));
    }

    public function LoginWeb(Request $req){

    }
}

