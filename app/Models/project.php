<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;

    public $table = "projects";
    protected $fillable = [
        "project_name",
        "pic_id", 
        "category_id", 
        "user_creator_id",
        "status",
        "time",
        "urgensi"
    ];
   
    public function pic_id(){
        return $this->belongsTo(User::class,"pic_id","id");
    }
    public function user_creator(){
        return $this->belongsTo(User::class,"user_creator_id","id");
    }
    public function category_project(){
        return $this->belongsTo(category_project::class,"category_id","id");
    }

    public function projects_timeline(){
        #param object,fk,pk
        return $this->hasMany(project_timeline::class,'project_id',"id");
    }
}
