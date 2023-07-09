<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class timesheetactivity extends Model
{
    use HasFactory, SoftDeletes;

    public $table ="timesheetactivity";

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

}
