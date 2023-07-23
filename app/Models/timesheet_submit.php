<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class timesheet_submit extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "timesheet_submit";
    protected $fillable = [
        "timeSheet_id",
        "idUser",
        "idUser_Head_approval",
        "status_submit",
        "message",
        "submitDate"
    ];

    
    protected $dates = ['deleted_at'];

    
}
