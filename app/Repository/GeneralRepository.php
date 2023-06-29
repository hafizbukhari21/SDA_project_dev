<?php

namespace App\Repository;
use App\Interfaces\GeneralInterface;
use App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class GeneralRepository implements GeneralInterface{

    protected Model $objectName;
    
    public function get($id){
       # return $this->objectName->    
    }

    public function getAll(){
        return $this->objectName->all();
    }

    public function insert(Request $req){
         return $this->objectName->create($req->all());
    }
    public function delete($id){

    }
    public function update($id){

    }

}