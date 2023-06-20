<?php

namespace App\Http\Controllers\auth;

use App\Http\Controllers\Controller;
use App\Interfaces\UserInterface;
use Illuminate\Http\Request;

class authController extends Controller
{
    public UserInterface $userRepository;

    public function __construct(UserInterface $userRepository){
        $this->userRepository = $userRepository;
    }

    public function returnAllUser(){
        return $this->userRepository->getAllUser();
    }

}
