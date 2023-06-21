<?php

namespace App\Interfaces;


interface GeneralInterface{
    public function get($id);
    public function getAll();
    public function insert();
    public function delete($id);
    public function update($id);

}

