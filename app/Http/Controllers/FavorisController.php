<?php

namespace App\Http\Controllers;

use App\Annonce;
use App\AnnonceImage;
use App\Appartement;
use App\Colocation;
use App\Favoris;
use App\Garage;
use App\Location;
use App\Maison;
use App\Studio;
use App\Terrain;
use App\Vente;
use Illuminate\Http\Request;

class FavorisController extends Controller
{
    public function addFavoris(Request $request){
        $favoris = Favoris::where('annonce_id','=',$request->id_annonce)->where('user_id','=',auth()->user()->id_user)->first();
        if ($favoris != null){
            $favoris->delete();
            return response()->json([
                'status' => 0 ,
                'titreBouton' => 'Ajouter à mes favoris',
            ]);
        }else{
            $favoris = new Favoris();
            $favoris->annonce_id = $request->id_annonce ;
            $favoris->user_id = auth()->user()->id_user ;
            $favoris->save();
            return response()->json([
                'status' => 1 ,
                'titreBouton' => 'Retirer de mes favoris',
            ]);
        }
    }

    private function getTypeBien($id){
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
    private function getTypeBienObject($id){
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
    private function getTypeAction($id){
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
    private function getTypeActionObject($id){
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
    private function getAnnonceImages($id){
        $tabImage = AnnonceImage::where('annonce_id',$id)->get();
        return $tabImage ;
    }

    public function afficherMesFavoris(){
        $id = auth()->user()->id_user ;
        $tabAnnonce = collect([]);
        $tabTypeBien = collect([]);
        $tabTypeAction = collect([]);
        $tabTypeBienOj = collect([]);
        $tabTypeActionObj = collect([]);
        $tabImage = collect([]);
        $mesFav = Favoris::where('user_id','=',$id)->get();
        foreach ($mesFav as $m){
            $id_annonce = $m->annonce_id ;
            $annonce = Annonce::where('id_annonce','=',$id_annonce)->where('etat','=',1)->first();
            if ($annonce != null){
                $typeBien = $this->getTypeBien($id_annonce);
                $typeBienObj = $this->getTypeBienObject($id_annonce);
                $typeAction = $this->getTypeAction($id_annonce);
                $typeActionObj = $this->getTypeActionObject($id_annonce);
                $image = $this->getAnnonceImages($id_annonce);

                $tabAnnonce->push($annonce);
                $tabTypeBien->push($typeBien);
                $tabTypeBienOj->push($typeBienObj);
                $tabTypeAction->push($typeAction);
                $tabTypeActionObj->push($typeActionObj);
                $tabImage->push($image);
            }
        }
        return view('favoris',compact('tabAnnonce','tabTypeBien','tabTypeBienOj','tabTypeAction','tabTypeActionObj','tabImage'));
    }
}
