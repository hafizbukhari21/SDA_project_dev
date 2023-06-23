<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Interfaces\UserInterface;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

class authController extends Controller
{
    public UserRepository $userRepository;

    public function __construct(UserRepository $userRepository){
        $this->userRepository = $userRepository;
    }

    public function returnAllUser(){
        return $this->userRepository->getAll();
    }


}
