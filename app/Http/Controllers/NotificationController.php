<?php

namespace App\Http\Controllers;

use App\Notification;
use Illuminate\Http\Request;
use test\Mockery\ReturnTypeObjectTypeHint;

class NotificationController extends Controller
{
    public function afficherNotifications(){
        $mesNotifi = Notification::where('user_id','=',auth()->user()->id_user)->get();
        return view('notifications',compact('mesNotifi'));
    }

    public function changerEtatNotification($id){
        $notif = Notification::where('id_notification','=',$id)->first();
        if ($notif->etat == 0){
            $notif->etat = 1;
        }
        else{
            $notif->etat = 0;
        }
        $notif->save();
        return back();
    }

    public function deleteNotification($id){
        $notif = Notification::where('id_notification','=',$id)->first();
        $notif->delete();
        return back();
    }
}
