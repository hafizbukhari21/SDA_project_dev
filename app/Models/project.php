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
}
