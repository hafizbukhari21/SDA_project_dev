<?php 

namespace App\Repository\Data;
use App\Models\category_project;
use App\Repository\GeneralRepository;

class Category_projectRepository extends GeneralRepository{

    public function __construct(){
        $this->objectName = new category_project();
    }

}