<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Annonce extends Model
{
    protected $fillable = ['id_annonce','titre','wilaya','adresse','mail','tel','description','lat','lng','superficie','etat','user_id'];
    protected $table = 'annonces' ;
    public $timestamps = true ;
    protected $primaryKey = 'id_annonce';

    public static function getTypeBien($id){
        $trouv = Appartement::where('id_appartement',$id)->first();
        if ($trouv !== null){
            $type = 'appartement';
            return $type ;
        }
        else{
            $trouv = Maison::where('id_maison',$id)->first();
            if ($trouv !== null){
                $type = 'maison';
                return $type ;
            }
            else{
                $trouv = Studio::where('id_studio',$id)->first();
                if ($trouv !== null){
                    $type = 'studio';
                    return $type ;
                }
                else{
                    $trouv = Terrain::where('id_terrain',$id)->first();
                    if ($trouv !== null){
                        $type = 'terrain';
                        return $type ;
                    }
                    else{
                        $trouv = Garage::where('id_garage',$id)->first();
                        if ($trouv !== null){
                            $type = 'garage';
                            return $type ;
                        }
                    }
                }
            }
        }
    }
    public static function getTypeBienObject($id){
        $trouv = Appartement::where('id_appartement',$id)->first();
        if ($trouv !== null){
            return $trouv ;
        }
        else{
            $trouv = Maison::where('id_maison',$id)->first();
            if ($trouv !== null){
                return $trouv ;
            }
            else{
                $trouv = Studio::where('id_studio',$id)->first();
                if ($trouv !== null){
                    return $trouv ;
                }
                else{
                    $trouv = Terrain::where('id_terrain',$id)->first();
                    if ($trouv !== null){
                        return $trouv ;
                    }
                    else{
                        $trouv = Garage::where('id_garage',$id)->first();
                        if ($trouv !== null){
                            return $trouv ;
                        }
                    }
                }
            }
        }
    }
    public static function getTypeAction($id){
        $trouv = Vente::where('id_vente',$id)->first();
        if ($trouv !== null){
            $type = 'vente';
            return $type ;
        }else{
            $trouv = Location::where('id_location',$id)->first();
            if ($trouv != null){
                $type = 'location';
                return $type ;
            }else{
                $trouv = Colocation::where('id_colocation',$id)->first();
                if ($trouv != null){
                    $type = 'colocation';
                    return $type ;
                }
            }
        }
    }
    public static function getTypeActionObject($id){
        $trouv = Vente::where('id_vente',$id)->first();
        if ($trouv !== null){
            return $trouv ;
        }else{
            $trouv = Location::where('id_location',$id)->first();
            if ($trouv != null){
                return $trouv ;
            }else{
                $trouv = Colocation::where('id_colocation',$id)->first();
                if ($trouv != null){
                    return $trouv ;
                }
            }
        }

    }
    public static function getAnnonceImages($id){
        $tabImage = AnnonceImage::where('annonce_id',$id)->get();
        return $tabImage ;
    }

}
