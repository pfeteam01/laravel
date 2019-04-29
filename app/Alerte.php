<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Alerte extends Model
{
    protected $fillable = ['id_alerte','wilaya','mail','surface_min','surface_max','etat_alerte','lp_min','lp_max','user_id'];
    protected $table = 'alertes' ;
    public $timestamps = true ;
    protected $primaryKey = 'id_alerte';

    public static function getSesBiens($id){
        $resultat = collect([]);
        $res = BienAlerte::where('alerte_id','=',$id)->get();
        if ($res != null){
            foreach ($res as $re) {
                $resultat->push($re->nom_type_bien);
            }
        }
        return $resultat ;
    }
    public static function getSesActions($id){
        $resultat = collect([]);
        $res = ActionAlerte::where('alerte_id','=',$id)->get();
        if ($res != null){
            foreach ($res as $re) {
                $resultat->push($re->nom_type_action);
            }
        }
        return $resultat ;
    }
    public static function getSesChambres($id){
        $resultat = collect([]);
        $res = ChambreAlerte::where('alerte_id','=',$id)->get();
        if ($res != null){
            foreach ($res as $re) {
                $resultat->push($re->nb_chambres);
            }
        }
        return $resultat ;
    }
}
