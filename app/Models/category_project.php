<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class category_project extends Model
{
    use HasFactory,SoftDeletes;
    protected $table = "category_project";
    protected $fillable = ["category_name"];
    protected $dates = ['deleted_at'];

    public $timestamps = false;

    public function projects(){
        #param object,fk,pk
        return $this->hasMany(project::class,'category_id',"id");
    }
}
