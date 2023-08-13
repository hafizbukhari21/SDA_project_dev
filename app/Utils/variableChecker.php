<?php  

namespace App\Utils;

trait variableChecker{
    public function checkVariable_isValid($string){
        return !$string=="" || !$string==null ;
    }
}