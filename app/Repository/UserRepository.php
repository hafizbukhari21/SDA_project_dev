<?php

namespace App\Repository;
use App\Interfaces\GeneralInterface;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\User;


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
    public function insert(){

    }
    

    public function getAllUserAndProject(){
        return $this->getAll()->load('project');
    }
    


    
}