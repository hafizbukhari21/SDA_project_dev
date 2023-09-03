<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repository\Data\NotificationRepository;

class notificationController extends Controller
{
    public NotificationRepository $notifRepo;

    public function __construct(NotificationRepository $notificationRepository){
        $this->notifRepo = $notificationRepository;
    }

    public function SetNotifBar(){
        return $this->notifRepo->SetNotifBar(session()->get("sessionKey")["id"]);
    }

    public function GetNotifDetail(Request $req){
        return $this->notifRepo->GetNotifDetail($req->uuid);
    }

    public function setHasBeenRead(Request $req){
        return $this->notifRepo->setAsRead(session()->get("sessionKey")["id"],$req->notif_id);
    }
}
