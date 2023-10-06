<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Repository\Data\Category_projectRepository;
use Illuminate\Http\Request;

class web_SuperUser_ManageResource extends Controller
{
    public Category_projectRepository $cagoryProjectRepo;
    public function __construct(Category_projectRepository $category_projectRepository){
        $this->cagoryProjectRepo = $category_projectRepository;
    }


    public function createProjectCategory(Request $request){
        return $this->cagoryProjectRepo->insert($request);
    }

    public function getAllProjectCategory(){
        return $this->cagoryProjectRepo->getAll();
    }
}
