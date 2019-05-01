<?php

namespace App\Http\Controllers;

use App\ActionAlerte;
use App\Alerte;
<<<<<<< HEAD
=======
use App\Annonce;
use App\AnnonceImage;
>>>>>>> 7694738eab9cd0c199e2344a80ac97826cc2d4ea
use App\BienAlerte;
use App\ChambreAlerte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AlerteController extends Controller
{
<<<<<<< HEAD
    //afficherajouteralerte
    public function afficherAjouterAlerte(){
        return view('alertes.ajouter_alerte');
    }

    private function creerAlerteObjet(Request $request){
        $al = new Alerte();
        $al->wilaya = $request->wilaya;
        $al->mail = $request->mail;
        if ($request->surfacemin == 'smin')
            $al->surface_min = 0 ;
        else
            $al->surface_min = $request->surfacemin;
        if ($request->surfacemax == 'smax')
            $al->surface_max = null ;
        else
            $al->surface_max = $request->surfacemax;
        $al->etat_alerte = 1 ;
        if ($request->lpmin == 'pmin')
            $al->lp_min = 0 ;
        else
            $al->lp_min = $request->lpmin ;
        if ($request->lpmax == 'pmax')
            $al->lp_max = null ;
        else
            $al->lp_max = $request->lpmax ;
        $al->user_id = auth()->user()->id_user ;
        $al->save();
        $al = Alerte::all()->max('id_alerte');
        return $al ;
    }
    private function creerBienAlerteObjet(Request $request, $al){
        if ($request->appartement != null){
            $ba = new BienAlerte();
            $ba->alerte_id = $al ;
            $ba->nom_type_bien = "appartement" ;
            $ba->save();
        }
        if ($request->maison != null){
            $ba = new BienAlerte();
            $ba->alerte_id = $al ;
            $ba->nom_type_bien = "maison" ;
            $ba->save();
        }
        if ($request->studio != null){
            $ba = new BienAlerte();
            $ba->alerte_id = $al ;
            $ba->nom_type_bien = "studio" ;
            $ba->save();
        }
        if ($request->terrain != null){
            $ba = new BienAlerte();
            $ba->alerte_id = $al ;
            $ba->nom_type_bien = "terrain" ;
            $ba->save();
        }
        if ($request->garage != null){
            $ba = new BienAlerte();
            $ba->alerte_id = $al ;
            $ba->nom_type_bien = "garage" ;
            $ba->save();
        }
    }
    private function creerActionAlerteObjet(Request $request, $al){
        if ($request->vente != null){
            $aa = new ActionAlerte();
            $aa->alerte_id = $al ;
            $aa->nom_type_action = "vente" ;
            $aa->save();
        }
        if ($request->location != null){
            $aa = new ActionAlerte();
            $aa->alerte_id = $al ;
            $aa->nom_type_action = "location" ;
            $aa->save();
        }
        if ($request->colocation != null){
            $aa = new ActionAlerte();
            $aa->alerte_id = $al ;
            $aa->nom_type_action = "colocation" ;
            $aa->save();
        }
    }
    private function creerChambreAlerteObjet(Request $request, $al){
        if($request->p1 != null){
            $ca = new ChambreAlerte();
            $ca->alerte_id = $al ;
            $ca->nb_chambres = 1 ;
            $ca->save();
        }
        if($request->p2 != null){
            $ca = new ChambreAlerte();
            $ca->alerte_id = $al ;
            $ca->nb_chambres = 2 ;
            $ca->save();
        }
        if($request->p3 != null){
            $ca = new ChambreAlerte();
            $ca->alerte_id = $al ;
            $ca->nb_chambres = 3 ;
            $ca->save();
        }
        if($request->p4 != null){
            $ca = new ChambreAlerte();
            $ca->alerte_id = $al ;
            $ca->nb_chambres = 4 ;
            $ca->save();
        }
        if($request->p5 != null){
            $ca = new ChambreAlerte();
            $ca->alerte_id = $al ;
            $ca->nb_chambres = 5 ;
            $ca->save();
        }
        if($request->p6 != null){
            $ca = new ChambreAlerte();
            $ca->alerte_id = $al ;
            $ca->nb_chambres = 6 ;
            $ca->save();
        }
        if($request->p7 != null){
            $ca = new ChambreAlerte();
            $ca->alerte_id = $al ;
            $ca->nb_chambres = 7 ;
            $ca->save();
        }
        if($request->p8 != null){
            $ca = new ChambreAlerte();
            $ca->alerte_id = $al ;
            $ca->nb_chambres = 8 ;
            $ca->save();
        }
    }
    //ajouteralerte
=======
    public function afficherAjouterAlerte(){
        return view('alertes.ajouter_alerte');
    }
>>>>>>> 7694738eab9cd0c199e2344a80ac97826cc2d4ea
    public function addAlerte(Request $request){
        $rules = [
            'wilaya' => '',
            'mail' => '',
            'surfacemin' => '',
            'surfacemax' => '',
            'lpmin' => '',
            'lpmax' => ''
        ];
        $val = Validator::make($request->all(),$rules);
        if ($val->fails())
            return back()->withErrors($val)->withInput();
        else{
<<<<<<< HEAD
            $al = $this->creerAlerteObjet($request);
            $this->creerBienAlerteObjet($request,$al);
            $this->creerActionAlerteObjet($request,$al);
            if($request->appartement != null or $request->maison != null){
                $this->creerChambreAlerteObjet($request,$al);
            }
        }
        return redirect('mesalertes/'.auth()->user()->id_user);
    }

    //affichermodifalerte/{id}
    public function afficherModifierAlerte($id){
        $alerte = Alerte::where('id_alerte','=',$id)->where('user_id','=',auth()->user()->id_user)->first();
        if($alerte){
            $sesBiens = Alerte::getSesBiens($id);
            $sesActions = Alerte::getSesActions($id);
            $sesChambres = Alerte::getSesChambres($id);
            return view('alertes.modif_alerte',compact('alerte','sesBiens','sesActions','sesChambres'));
        }
        else{
            return redirect('/mesalertes/'.auth()->user()->id_user);
        }
    }

    private function updateAlerteObjet(Request $request,$id){
        $alerte = Alerte::where('id_alerte','=',$id)->firstOrFail();
        if ($request->wilaya != null and !empty($request->wilaya)){
            $alerte->wilaya = $request->wilaya ;
        }
        elseif ($request->mail != null and !empty($request->mail)){
            $alerte->mail = $request->mail ;
        }
        if ($request->surfacemin == 'smin')
            $alerte->surface_min = null ;
        else
            $alerte->surface_min = $request->surfacemin ;
        if ($request->surfacemax == 'smax')
            $alerte->surface_max = null ;
        else
            $alerte->surface_max = $request->surfacemax ;
        if ($request->lpmin == 'pmin')
            $alerte->lp_min = null ;
        else
            $alerte->lp_min = $request->lpmin ;
        if ($request->lpmax == 'pmax')
            $alerte->lp_max = null ;
        else
            $alerte->lp_max = $request->lpmax ;
        $alerte->save();
    }
    //modifieralerte/{id}
=======
            $al = new Alerte();
            $al->wilaya = $request->wilaya;
            $al->mail = $request->mail;
            if ($request->surfacemin == 'smin')
                $al->surface_min = 0 ;
            else
                $al->surface_min = $request->surfacemin;
            if ($request->surfacemax == 'smax')
                $al->surface_max = null ;
            else
                $al->surface_max = $request->surfacemax;
            $al->etat_alerte = 1 ;
            if ($request->lpmin == 'pmin')
                $al->lp_min = 0 ;
            else
                $al->lp_min = $request->lpmin ;
            if ($request->lpmax == 'pmax')
                $al->lp_max = null ;
            else
                $al->lp_max = $request->lpmax ;
            $al->user_id = auth()->user()->id_user ;
            $al->save();
            $al = Alerte::all()->max('id_alerte');
            if ($request->appartement != null){
                $ba = new BienAlerte();
                $ba->alerte_id = $al ;
                $ba->nom_type_bien = "appartement" ;
                $ba->save();
            }
            if ($request->maison != null){
                $ba = new BienAlerte();
                $ba->alerte_id = $al ;
                $ba->nom_type_bien = "maison" ;
                $ba->save();
            }
            if ($request->studio != null){
                $ba = new BienAlerte();
                $ba->alerte_id = $al ;
                $ba->nom_type_bien = "studio" ;
                $ba->save();
            }
            if ($request->terrain != null){
                $ba = new BienAlerte();
                $ba->alerte_id = $al ;
                $ba->nom_type_bien = "terrain" ;
                $ba->save();
            }
            if ($request->garage != null){
                $ba = new BienAlerte();
                $ba->alerte_id = $al ;
                $ba->nom_type_bien = "garage" ;
                $ba->save();
            }
            if ($request->vente != null){
                $aa = new ActionAlerte();
                $aa->alerte_id = $al ;
                $aa->nom_type_action = "vente" ;
                $aa->save();
            }
            if ($request->location != null){
                $aa = new ActionAlerte();
                $aa->alerte_id = $al ;
                $aa->nom_type_action = "location" ;
                $aa->save();
            }
            if ($request->colocation != null){
                $aa = new ActionAlerte();
                $aa->alerte_id = $al ;
                $aa->nom_type_action = "colocation" ;
                $aa->save();
            }
            if($request->appartement != null or $request->maison != null){
                if($request->p1 != null){
                    $ca = new ChambreAlerte();
                    $ca->alerte_id = $al ;
                    $ca->nb_chambres = 1 ;
                    $ca->save();
                }
                if($request->p2 != null){
                    $ca = new ChambreAlerte();
                    $ca->alerte_id = $al ;
                    $ca->nb_chambres = 2 ;
                    $ca->save();
                }
                if($request->p3 != null){
                    $ca = new ChambreAlerte();
                    $ca->alerte_id = $al ;
                    $ca->nb_chambres = 3 ;
                    $ca->save();
                }
                if($request->p4 != null){
                    $ca = new ChambreAlerte();
                    $ca->alerte_id = $al ;
                    $ca->nb_chambres = 4 ;
                    $ca->save();
                }
                if($request->p5 != null){
                    $ca = new ChambreAlerte();
                    $ca->alerte_id = $al ;
                    $ca->nb_chambres = 5 ;
                    $ca->save();
                }
                if($request->p6 != null){
                    $ca = new ChambreAlerte();
                    $ca->alerte_id = $al ;
                    $ca->nb_chambres = 6 ;
                    $ca->save();
                }
                if($request->p7 != null){
                    $ca = new ChambreAlerte();
                    $ca->alerte_id = $al ;
                    $ca->nb_chambres = 7 ;
                    $ca->save();
                }
                if($request->p8 != null){
                    $ca = new ChambreAlerte();
                    $ca->alerte_id = $al ;
                    $ca->nb_chambres = 8 ;
                    $ca->save();
                }
            }
        }
        $res = $this->findAlerte('Adrar',30,100,'vente','garage',0) ;
        dump($res);
        foreach ($res as $re) {
            dump($this->getSesBiens($re));
            dump($this->getSesActions($re));
            dump($this->getSesChambres($re));
        }
    }

    public function afficherModifierAlerte($id){
        $alerte = Alerte::where('id_alerte','=',$id)->first();
        $sesBiens = $this->getSesBiens($id);
        $sesActions = $this->getSesActions($id);
        $sesChambres = $this->getSesChambres($id);
        return view('alertes.modif_alerte',compact('alerte','sesBiens','sesActions','sesChambres'));
    }
>>>>>>> 7694738eab9cd0c199e2344a80ac97826cc2d4ea
    public function updateAlerte(Request $request, $id){
        $rule = [
            'wilaya' => '' ,
            'mail' => '' ,
            'surfacemin' => '' ,
            'surfacemax' => '' ,
            'lpmin' => '' ,
            'lpmax' => '' ,
        ];
        $validation = Validator::make($request->all(),$rule);
        if ($validation->fails()){
            return back()->withErrors($validation)->withInput();
        }
        else{
<<<<<<< HEAD
            $this->updateAlerteObjet($request,$id);
            BienAlerte::where('alerte_id','=',$id)->delete() ;
            ActionAlerte::where('alerte_id','=',$id)->delete();
            ChambreAlerte::where('alerte_id','=',$id)->delete() ;
            $this->creerBienAlerteObjet($request,$id);
            $this->creerActionAlerteObjet($request,$id);
            if($request->appartement != null or $request->maison != null){
                $this->creerChambreAlerteObjet($request,$id);
            }
            return redirect('/mesalertes/'.auth()->user()->id_user);
        }
    }

    //mesalertes/{id}
=======
            $alerte = Alerte::where('id_alerte','=',$id)->first();
            if ($request->wilaya != null and !empty($request->wilaya)){
                $alerte->wilaya = $request->wilaya ;
            }
            elseif ($request->mail != null and !empty($request->mail)){
                $alerte->mail = $request->mail ;
            }

            if ($request->surfacemin == 'smin')
                $alerte->surface_min = null ;
            else
                $alerte->surface_min = $request->surfacemin ;

            if ($request->surfacemax == 'smax')
                $alerte->surface_max = null ;
            else
                $alerte->surface_max = $request->surfacemax ;

            if ($request->lpmin == 'pmin')
                $alerte->lp_min = null ;
            else
                $alerte->lp_min = $request->lpmin ;

            if ($request->lpmax == 'pmax')
                $alerte->lp_max = null ;
            else
                $alerte->lp_max = $request->lpmax ;

            $alerte->save();

            BienAlerte::where('alerte_id','=',$id)->delete() ;
            ActionAlerte::where('alerte_id','=',$id)->delete();
            ChambreAlerte::where('alerte_id','=',$id)->delete() ;
            if ($request->appartement != null){
                $ba = new BienAlerte();
                $ba->alerte_id = $id ;
                $ba->nom_type_bien = "appartement" ;
                $ba->save();
            }
            if ($request->maison != null){
                $ba = new BienAlerte();
                $ba->alerte_id = $id ;
                $ba->nom_type_bien = "maison" ;
                $ba->save();
            }
            if ($request->studio != null){
                $ba = new BienAlerte();
                $ba->alerte_id = $id ;
                $ba->nom_type_bien = "studio" ;
                $ba->save();
            }
            if ($request->terrain != null){
                $ba = new BienAlerte();
                $ba->alerte_id = $id ;
                $ba->nom_type_bien = "terrain" ;
                $ba->save();
            }
            if ($request->garage != null){
                $ba = new BienAlerte();
                $ba->alerte_id = $id ;
                $ba->nom_type_bien = "garage" ;
                $ba->save();
            }
            if ($request->vente != null){
                $aa = new ActionAlerte();
                $aa->alerte_id = $id ;
                $aa->nom_type_action = "vente" ;
                $aa->save();
            }
            if ($request->location != null){
                $aa = new ActionAlerte();
                $aa->alerte_id = $id ;
                $aa->nom_type_action = "location" ;
                $aa->save();
            }
            if ($request->colocation != null){
                $aa = new ActionAlerte();
                $aa->alerte_id = $id ;
                $aa->nom_type_action = "colocation" ;
                $aa->save();
            }
            if($request->appartement != null or $request->maison != null){
                if($request->p1 != null){
                    $ca = new ChambreAlerte();
                    $ca->alerte_id = $id ;
                    $ca->nb_chambres = 1 ;
                    $ca->save();
                }
                if($request->p2 != null){
                    $ca = new ChambreAlerte();
                    $ca->alerte_id = $id ;
                    $ca->nb_chambres = 2 ;
                    $ca->save();
                }
                if($request->p3 != null){
                    $ca = new ChambreAlerte();
                    $ca->alerte_id = $id ;
                    $ca->nb_chambres = 3 ;
                    $ca->save();
                }
                if($request->p4 != null){
                    $ca = new ChambreAlerte();
                    $ca->alerte_id = $id ;
                    $ca->nb_chambres = 4 ;
                    $ca->save();
                }
                if($request->p5 != null){
                    $ca = new ChambreAlerte();
                    $ca->alerte_id = $id ;
                    $ca->nb_chambres = 5 ;
                    $ca->save();
                }
                if($request->p6 != null){
                    $ca = new ChambreAlerte();
                    $ca->alerte_id = $id ;
                    $ca->nb_chambres = 6 ;
                    $ca->save();
                }
                if($request->p7 != null){
                    $ca = new ChambreAlerte();
                    $ca->alerte_id = $id ;
                    $ca->nb_chambres = 7 ;
                    $ca->save();
                }
                if($request->p8 != null){
                    $ca = new ChambreAlerte();
                    $ca->alerte_id = $id ;
                    $ca->nb_chambres = 8 ;
                    $ca->save();
                }
            }
            return redirect('/profil');
        }
    }
>>>>>>> 7694738eab9cd0c199e2344a80ac97826cc2d4ea
    public function afficherMesAlertes($id){
        $mesAlertes = Alerte::where('user_id','=',$id)->get();
        $biens = collect([]);
        $actions = collect([]);
        $chambres = collect([]);
        foreach ($mesAlertes as $item) {
<<<<<<< HEAD
            $biens->push(Alerte::getSesBiens($item->id_alerte));
            $actions->push(Alerte::getSesActions($item->id_alerte));
            $chambres->push(Alerte::getSesChambres($item->id_alerte));
        }
        return view('alertes.afficher_mes_alertes',compact('mesAlertes','biens','actions','chambres'));
    }

    //changeretat/{id}
    public function changerEtatAnnonce($id){
        $alerte = Alerte::where('id_alerte','=',$id)->firstOrFail();
=======
            $biens->push($this->getSesBiens($item->id_alerte));
            $actions->push($this->getSesActions($item->id_alerte));
            $chambres->push($this->getSesChambres($item->id_alerte));
        }
        return view('alertes.afficher_mes_alertes',compact('mesAlertes','biens','actions','chambres'));
    }
    public function changerEtatAnnonce($id){
        $alerte = Alerte::where('id_alerte','=',$id)->first();
>>>>>>> 7694738eab9cd0c199e2344a80ac97826cc2d4ea
        if ($alerte->etat_alerte == 0 ) $alerte->etat_alerte = 1 ;
        else $alerte->etat_alerte = 0 ;
        $alerte->save();
        return back();
    }
<<<<<<< HEAD

    //supprimeralerte/{id}
    public function supprimerAlerte($id){
=======
    public function supprimerAnnonce($id){
>>>>>>> 7694738eab9cd0c199e2344a80ac97826cc2d4ea
        Alerte::where('id_alerte','=',$id)->delete();
        BienAlerte::where('alerte_id','=',$id)->delete();
        ActionAlerte::where('alerte_id','=',$id)->delete();
        ChambreAlerte::where('alerte_id','=',$id)->delete();
        return back() ;
    }

<<<<<<< HEAD







=======
    public function getSesBiens($id){
        $resultat = collect([]);
        $res = BienAlerte::where('alerte_id','=',$id)->get();
        if ($res != null){
            foreach ($res as $re) {
                $resultat->push($re->nom_type_bien);
            }
        }
        return $resultat ;
    }
    public function getSesActions($id){
        $resultat = collect([]);
        $res = ActionAlerte::where('alerte_id','=',$id)->get();
        if ($res != null){
            foreach ($res as $re) {
                $resultat->push($re->nom_type_action);
            }
        }
        return $resultat ;
    }
    public function getSesChambres($id){
        $resultat = collect([]);
        $res = ChambreAlerte::where('alerte_id','=',$id)->get();
        if ($res != null){
            foreach ($res as $re) {
                $resultat->push($re->nb_chambres);
            }
        }
        return $resultat ;
    }
>>>>>>> 7694738eab9cd0c199e2344a80ac97826cc2d4ea

    public function filterBien($typebien){
        $resultat = collect([]);
        $res = BienAlerte::where('nom_type_bien','=',$typebien)->get();
        if ($res != null){
            foreach ($res as $re) {
                $resultat->push($re->alerte_id);
            }
        }
        return $resultat ;
    }
    public function filterRomm($nbchambres){
        $resultat = collect([]);
        if ($nbchambres >= 8){
            $res = ChambreAlerte::where('nb_chambres','>=',8)->get();
        }else{
            $res = ChambreAlerte::where('nb_chambres','=',$nbchambres)->get();
        }
        if ($res != null){
            foreach ($res as $re) {
                $resultat->push($re->alerte_id);
            }
        }
        return $resultat ;
    }
    public function filterAction($typeaction){
        $resultat = collect([]);
        $res = ActionAlerte::where('nom_type_action','=',$typeaction)->get();
        if ($res != null){
            foreach ($res as $re) {
                $resultat->push($re->alerte_id);
            }
        }
        return $resultat ;
    }
    public function filterAnnonces($wilaya,$surface,$prix){
        $resulat = collect([]);
        $res = Alerte::
            where('wilaya','=',$wilaya)
            ->where('surface_min','<',$surface)
            ->where('lp_min','<',$prix)
            ->where('etat_alerte','=',1)
            ->where('surface_max','>',$surface)
            ->where('surface_max','!=',null)
            ->where('lp_max','>',$prix)
            ->where('lp_max','!=',null)
            ->get();
        if ($res != null){
            foreach ($res as $re) {
                $resulat->push($re->id_alerte);
            }
        }
        $res = Alerte::
        where('wilaya','=',$wilaya)
            ->where('surface_min','<',$surface)
            ->where('lp_min','<',$prix)
            ->where('etat_alerte','=',1)
            ->where('surface_max','=',null)
            ->where('lp_max','=',null)
            ->get();
        if ($res != null){
            foreach ($res as $re) {
                $resulat->push($re->id_alerte);
            }
        }
        return $resulat ;
    }
    public function findAlerte($wilaya,$surface,$prix,$typeaction,$typebien,$chambre){
        $annonce = $this->filterBien($typebien);
        if ($typebien == 'appartement' || $typebien == 'maison')
            $annonce = $this->intersect($annonce,$this->filterRomm($chambre));
        $annonce = $this->intersect($annonce,$this->filterAction($typeaction));
        $annonce = $this->intersect($annonce,$this->filterAnnonces($wilaya,$surface,$prix));
        return $annonce ;
    }

    public function intersect($array1, $array2){
        $resultat = collect([]);
        foreach ($array1 as $item) {
            if ($array2->contains($item))
                $resultat->push($item);
        }
        return $resultat ;
    }
}
