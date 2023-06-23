<?php

namespace App\Repository;
use App\Interfaces\GeneralInterface;
use App\Models;
use Illuminate\Database\Eloquent\Model;

class GeneralRepository implements GeneralInterface{

    protected Model $objectName;
    public function __construct(Model $objectName){
        $this->objectName = $objectName;
    }
    public function get($id){
       # return $this->objectName->    
    }

    public function getAll(){
        return $this->objectName->all();
    }
    public function insert(){

    }

    
    public function delete($id){

    }
    public function update($id){

    }
}