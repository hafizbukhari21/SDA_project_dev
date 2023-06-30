<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Repository\Data\Category_projectRepository;
use Illuminate\Http\Request;

class categoryProjectController extends Controller
{
    public Category_projectRepository $cateRepo;
    public function __construct(Category_projectRepository $caterory_projectRepository){
        $this->cateRepo = $caterory_projectRepository;
    }

    public function returnCategoryProject_all(){
        return $this->cateRepo->getAll();
    }
}
