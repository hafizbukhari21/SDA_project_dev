<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project_timeline extends Model
{
    use HasFactory;

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
