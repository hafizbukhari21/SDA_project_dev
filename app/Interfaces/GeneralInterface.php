<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface GeneralInterface{
    public function get($var, $val);
    public function getAll();
    public function insert(Request $req);
    public function delete($id);
    public function update($var,$val,Request $req);

}

