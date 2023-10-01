<?php

namespace App\Repository;
use App\Interfaces\GeneralInterface;
use App\Models;
use Exception;
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

    public function updateByUuid(Request $request){
        $target =  $this->objectName->where(["uuid"=>$request->uuid]);
        if($request->has("_token"))
            return $target->update($request->except(["_token"]));

        return $target->update($request->all());

    }

    public function updateById(Request $request){
        $target = $this->objectName->where(["id"=>$request->id]);
        if($request->has("_token"))
            return $target->update($request->except(["_token"]));

        return $target->update($request->all());
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