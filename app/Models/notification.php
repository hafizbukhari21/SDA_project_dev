<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class notification extends Model
{
    use HasFactory,SoftDeletes;

    protected $dates = ['deleted_at'];

    public $table = "notification";
    protected $fillable = [
       "uuid",
       "group",
       "timelineId",
       "timesheetsubmitId",

    ];


    public function timesheet_submit(){
        return $this->belongsTo(timesheet_submit::class,"timesheetsubmitId","id");
    }
    public function timeline(){
        return $this->belongsTo(project_timeline::class,"timelineId","id");
    }

    public function notif_read(){
        return $this->hasOne(notif_read::class,"id_notif","id");
    }


    


}
