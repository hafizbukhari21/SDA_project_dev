<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class timesheet extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "timeSheet";
    protected $fillable = [
        "idUser"
    ];
    protected $dates = ['deleted_at'];

    //1:1
    public function user(){
        return $this->belongsTo(User::class,"idUser","id");
    }

    public function timesheetactivity(){
        return $this->hasMany(timesheetactivity::class,"timeSheet_id","id");
    }
}
