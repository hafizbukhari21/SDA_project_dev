<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class timesheet extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "timesheet";
    protected $fillable = [
        "idUser"
    ];
    protected $dates = ['deleted_at'];

    
}
