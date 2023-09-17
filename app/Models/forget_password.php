<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class forget_password extends Model
{
    use HasFactory;
    public $table="forget_password";
    protected $fillable =[
        "idUser",
        "hash",
        "expiredTime"
    ];

    protected function user(){
        return $this->belongsTo(User::class,"idUser","id");
    }
    
}
