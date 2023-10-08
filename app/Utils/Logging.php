<?php 

namespace App\Utils;
use Illuminate\Support\Facades\Log;


class Logging{
    public static function logInfo($message){
        LOG::info(  "user :".session()->get("sessionKey")["name"]." | "
                ."Role :".session()->get("sessionKey")["role"]." ". $message);

    }
    public static function logWarn($message){
        LOG::warning(  "user :".session()->get("sessionKey")["name"]." | "
                ."Role :".session()->get("sessionKey")["role"]." ". $message);

    }
}