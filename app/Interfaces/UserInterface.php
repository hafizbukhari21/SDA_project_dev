<?php
namespace App\Interfaces;

interface UserInterface{
    public function getAllUser();
    public function getUser($user_id);
    public function deleteUser($user_id);
    public function updateUser($user_id);
}

