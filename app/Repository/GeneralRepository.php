<?php

namespace App\Repository;
use App\Interfaces\GeneralInterface;
use App\Models;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class GeneralRepository implements GeneralInterface{

    protected Model $objectName;
    
    
    public function get($var,$val){
        return $this->objectName->where([$var => $val])->get();    
    }
    public function getByUUid($uuid){
        return $this->objectName->where(["uuid" => $uuid])->get();    
    }

    public function getAll(){
        return $this->objectName->all();
    }

    public function insert(Request $req){
         return $this->objectName->create($req->all());
    }

    //SoftDelete
    public function delete($req){

        $objectDelete = $this->objectName->find($req->id);
        $objectDelete->delete();

        return $objectDelete;
    }

    public function softDeleteUuid ($uuid){
        $objectDelete = $this->objectName->where(["uuid"=>$uuid])->get()->first();
        $objectDelete->delete();

        return $objectDelete;
    }

    //SoftDelete
    public function getTrashSoftDelete(){
        return $this->objectName->onlyTrashed()->get();
    }

    //SoftDelete
    public function restoreSoftDelete($pk,$id){
        return $this->objectName->onlyTrashed()->where($pk,$id)->restore();
    }

    public function update($var,$val,Request $req){
         $var=$this->objectName->where("id",$req->id)->update($req->all());

        return $var->save();
    }

}