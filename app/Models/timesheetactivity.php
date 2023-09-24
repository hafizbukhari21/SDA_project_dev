<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;


class timesheetactivity extends Model
{
    use HasFactory, SoftDeletes;

    public $table ="timeSheetActivity";

    protected $fillable =[
        "timeSheet_id",
        "title",
        "detail_activity",
        "status",
        "activity_date",
        "from",
        "finish",
        "ref_timeSheetSubmit"
    ];

    protected $dates = ['deleted_at'];

    public function timeSheet_id(){
        return $this->belongsTo(timesheet::class,"timeSheet_id","id");
    }

    public static function boot(){
        parent::boot();
        self::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

}
