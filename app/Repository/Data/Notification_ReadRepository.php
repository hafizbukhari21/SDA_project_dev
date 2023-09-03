<?php  

namespace App\Repository\Data;

use App\Models\notif_read;
use App\Repository\GeneralRepository;
use Illuminate\Support\Str;


class Notification_ReadRepository extends GeneralRepository {
    public function __construct(){
        $this->objectName = new notif_read();
    }

    public function setAsRead($userId,$notifId){
        return $this->objectName->create([
            "id_user"=>$userId,
            "id_notif"=>$notifId,
            "uuid"=>Str::uuid()
        ]);
    }
}