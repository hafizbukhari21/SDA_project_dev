<?php

namespace App\Repository;
use App\Interfaces\GeneralInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\User;
use GuzzleHttp\Psr7\Request;

class UserRepository {
   
    public User $user;
    public function __construct(User $user){
        $this->user = $user;
    }

    public function get($id){
    }
    public function getAll(){
        return $this->user->all();
    }
    public function insert($request){
       return User::create([
            "name"=> $request->name,
            "email"=> $request->email,
            "password"=>$request->password,
            "role"=>$request->role
       ]);
    }
    
    public function getEmail($email){
        return User::where("email",$email)->get();
    }

    public function getAllUserAndProject(){
        return $this->getAll()->load('project');
    }
    


    
}