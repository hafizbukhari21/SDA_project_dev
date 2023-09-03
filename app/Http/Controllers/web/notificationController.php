<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Repository\Data\Notification_ReadRepository;
use Illuminate\Http\Request;
use App\Repository\Data\NotificationRepository;

class notificationController extends Controller
{
    public NotificationRepository $notifRepo;
    public Notification_ReadRepository $notifReadRepo;

    public function __construct(NotificationRepository $notificationRepository, Notification_ReadRepository $notification_ReadRepository){
        $this->notifRepo = $notificationRepository;
        $this->notifReadRepo= $notification_ReadRepository;
    }

    public function SetNotifBar(){
        return $this->notifRepo->SetNotifBar(session()->get("sessionKey")["id"]);
    }

    public function GetNotifDetail(Request $req){
        return $this->notifRepo->GetNotifDetail($req->uuid);
    }

    public function setHasBeenRead(Request $req){
        $notif = $this->notifRepo->getByUUid($req->uuid)->first();
        return $this->notifReadRepo->setAsRead(session()->get("sessionKey")["id"],$notif->id);
    }
}
