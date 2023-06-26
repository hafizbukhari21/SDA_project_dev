<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Repository\Data\ProjectRepository;
use App\Repository\GeneralRepository;
use App\Repository\UserRepository;
use Illuminate\Http\Request;

class userController extends Controller
{
    private ProjectRepository $projectRepository;
    private UserRepository $userRepository;

    public function __construct(ProjectRepository $projectRepository, UserRepository $userRepository){

        $this->projectRepository = $projectRepository;
        $this->userRepository = $userRepository;
    }
    public function getAllUser(){
      #  return $this->projectRepository->generalRepository->getAll();

      return $this->userRepository->getAll();
    }

    public function returnUserAndProjectList(){
        return $this->userRepository->getAllUserAndProject();
    }



    //Ingat Untuk Controller ini csrf nya mati masih dari postman
    //Ntar jangan lupa pas viewnya dah jadi csrf tokenya hidupin lagi
    public function registerUser(Request $req){
        $req->validate([
            'name' => 'required',
            'password'  => 'required',
            'role' => 'required',
            'email' => 'required',
        ]);
         return $this->userRepository->insert($req);
    }


}
