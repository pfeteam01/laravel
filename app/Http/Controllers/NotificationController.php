<?php

namespace App\Http\Controllers;

use App\Notification;
use App\NotificationAgence;
use App\NotificationUser;

class NotificationController extends Controller
{
    private function getAuthGuard(){
        $guards = array_keys(config('auth.guards'));
        foreach ($guards as $guard){
            if(auth()->guard($guard)->check() == true)
                return $guard;
        }
    }
    private function getAuthId(){
        $guard = $this->getAuthGuard();
        if ($guard == 'web'){
            $idProp = auth()->guard($guard)->user()->id_user ;
        }
        else{
            $idProp = auth()->guard($guard)->user()->id_agence ;
        }
        return $idProp ;
    }

    private function userNotifications($id){
        $mesnotif = NotificationUser::where('user_id','=',$id)->get();
        return $mesnotif ;
    }
    private function agenceNotifications($id){
        $mesnotif = NotificationAgence::where('agence_id','=',$id)->get();
        return $mesnotif ;
    }
    //mesnotification
    public function afficherNotifications(){
        $guard = $this->getAuthGuard();
        $id = $this->getAuthId();
        if ($guard == 'web'){
            $lesNotifications = $this->userNotifications($id);
        }
        else{
            $lesNotifications = $this->agenceNotifications($id);
        }
        $mesNotifi = collect([]);
        for ($i=0;$i<$lesNotifications->count();$i++){
            $notification = Notification::where('id_notification','=',$lesNotifications->get($i)->id_notification)->first();
            $mesNotifi->push($notification);
        }
        return view('notifications',compact('mesNotifi'));
    }

    ///chageetatnotification/{id}
    public function changerEtatNotification($id){
        $notif = Notification::where('id_notification','=',$id)->firstOrFail();
        if ($notif->etat == 0){
            $notif->etat = 1;
        }
        else{
            $notif->etat = 0;
        }
        $notif->save();
        return back();
    }

    //supprimernotification/{id}
    public function deleteNotification($id){
        $notif = Notification::where('id_notification','=',$id)->firstOrFail();
        $notif->delete();
        $guard = $this->getAuthGuard();
        if ($guard == 'web')
            NotificationUser::where('id_notification','=',$id)->delete();
        else
            NotificationAgence::where('id_notification','=',$id)->delete();
        return back();
    }
}
