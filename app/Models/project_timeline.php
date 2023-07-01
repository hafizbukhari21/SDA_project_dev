<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class project_timeline extends Model
{
    use HasFactory,SoftDeletes;
    protected $dates = ['deleted_at'];

    public $table = "projects_timeline";
    protected $fillable = [
        "task_name",
        "project_id",
        "from",
        "to"
    ];

    public function project(){
        return $this->belongsTo(project::class,"id");
    }
}