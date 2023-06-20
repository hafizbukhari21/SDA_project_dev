<?php

namespace App\Repository;

use App\Interfaces\UserInterface;
use App\Models\User;

class UserRepository implements UserInterface{

    public function getAllUser(){
        return User::all();
    }
    public function getUser($user_id){}
    public function deleteUser($user_id){}
    public function updateUser($user_id){}
}