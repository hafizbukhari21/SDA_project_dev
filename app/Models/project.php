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
        "category", 
        "status",
        "time",
        "urgensi"
    ];
   
    public function user(){
        return $this->belongsTo(User::class,"id");
    }
    public function category_project(){
        return $this->belongsTo(category_project::class,"id");
    }

    public function projects_timeline(){
        #param object,fk,pk
        return $this->hasMany(project_timeline::class,'project_id',"id");
    }
}
