<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class group_timeline extends Model
{
    use HasFactory, SoftDeletes;

    public $table="group_timeline";
    protected $fillable =[
        "Group",
        "idProject",
        "order"
    ];

    public function projects(){
        return $this->hasMany(project_timeline::class,"idGroup","id");
    }

    

    
}
