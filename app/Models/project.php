<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class project extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "projects";
    protected $dates = ['deleted_at'];
    protected $fillable = [
        "project_name",
        "pic_id", 
        "category_id", 
        "user_creator_id",
        "status",
        "time",
        "urgensi",
        "idProjectJalin",
        "pic_am",
        "status_progress",
        "uuid"
    ];
   
 
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
