<?php

namespace App\Interfaces;

use Illuminate\Http\Request;

interface GeneralInterface{
    public function get($id);
    public function getAll();
    public function insert(Request $req);
    public function delete($id);
    public function update($id);

}

