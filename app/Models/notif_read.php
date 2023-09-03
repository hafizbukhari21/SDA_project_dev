<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class notif_read extends Model
{
    use HasFactory;
   

    public $table = "notif_read";
    protected $fillable = [
       "uuid",
       "id_notif",
       "id_user",
    ];

    public function notif_read(){
        return $this->belongsTo(notification::class,"id_notif","id");
    }

    public function user(){
        return $this->belongsTo(User::class,"id_user","id");
    }

}
