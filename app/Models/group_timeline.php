<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class group_timeline extends Model
{
    use HasFactory;

    public $table="group_timeline";
    protected $fillable =[
        "Group"
    ];

    
}
