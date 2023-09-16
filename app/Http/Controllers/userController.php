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

    public function returnUserAndProjectList(Request $req){
        return $this->userRepository->getAllUserAndProject();
    }

    //Ingat Untuk Controller ini csrf nya mati masih dari postman
    //Ntar jangan lupa pas viewnya dah jadi csrf tokenya hidupin lagi
    //Belum ada fitur Validasi untuk modul ini
    public function registerUser(Request $req){
        $req->validate([
            'name' => 'required',
            'role' => 'required',
            'email' => 'required',
        ]);

        
        $cekEmail=$this->userRepository->getEmail($req->email);
        if(sizeof($cekEmail) >0 ) return "Email Sudah terdaftar";
        if($req->role != "Officer")unset($req["Role"]); 

        $req->merge(["password" => $req->role]);//set password defalut sesual role 
        

        return $this->userRepository->insert($req);
        
    }

    public function returnAllHead(){
        return $this->userRepository->getAllHead();
    }

    public function returnMyOfficer(){
        return $this->userRepository->getAllMyOfficer();
    }

    

  


}
