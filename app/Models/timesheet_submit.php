<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class timesheet_submit extends Model
{
    use HasFactory, SoftDeletes;

    public $table = "timeSheet_submit";
    protected $fillable = [
        "timeSheet_id",
        "idUser",
        "status_submit",
        "message",
        "submitDate",
        "approvalDate",
        "attemp",
        "title",
    ];

    public function user(){
        return $this->belongsTo(User::class,"idUser","id");
    }

    public function timesheet(){
        return $this->belongsTo(timesheet::class,"timeSheet_id","id");
    }

    public function timesheetactivity(){
        return $this->hasMany(timesheetactivity::class,"ref_timeSheetSubmit","id");
    }

    
    public static function boot(){
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

    
    protected $dates = ['deleted_at'];

    
}
