<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class category_project extends Model
{
    use HasFactory;
    protected $table = "category_project";
    protected $fillable = ["category_name"];

    public function projects(){
        #param object,fk,pk
        return $this->hasMany(project::class,'category_id',"id");
    }
}
