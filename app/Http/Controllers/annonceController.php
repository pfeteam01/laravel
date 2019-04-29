<?php

namespace App\Http\Controllers;

use App\Agence;
use App\Annonce;
use App\AnnonceAgence;
use App\AnnonceImage;
use App\AnnonceUser;
use App\Appartement;
use App\Colocation;
use App\Garage;
use App\Location;
use App\Mail\AlerteMail;
use App\Maison;
use App\Notification;
use App\NotificationAgence;
use App\NotificationUser;
use App\Reservation;
use App\Studio;
use App\Terrain;
use App\User;
use App\Vente;
use App\Favoris;
use App\ActionAlerte;
use App\Alerte;
use App\BienAlerte;
use App\ChambreAlerte;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

/**
 * @package App\Http\Controllers
 */
class AnnonceController extends Controller
{
    private function filterBien($typebien){
        $resultat = collect([]);
        $res = BienAlerte::where('nom_type_bien','=',$typebien)->get();
        if ($res != null){
            foreach ($res as $re) {
                $resultat->push($re->alerte_id);
            }
        }
        return $resultat ;
    }
    private function filterRomm($nbchambres){
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
    private function filterAction($typeaction){
        $resultat = collect([]);
        $res = ActionAlerte::where('nom_type_action','=',$typeaction)->get();
        if ($res != null){
            foreach ($res as $re) {
                $resultat->push($re->alerte_id);
            }
        }
        return $resultat ;
    }
    private function filterAnnonces($wilaya,$surface,$prix){
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
    private function findAlerte($wilaya,$surface,$prix,$typeaction,$typebien,$chambre){
        $annonce = $this->filterBien($typebien);
        if ($typebien == 'appartement' || $typebien == 'maison')
            $annonce = $this->intersect($annonce,$this->filterRomm($chambre));
        $annonce = $this->intersect($annonce,$this->filterAction($typeaction));
        $annonce = $this->intersect($annonce,$this->filterAnnonces($wilaya,$surface,$prix));
        return $annonce ;
    }

    private function intersect($array1, $array2){
        $resultat = collect([]);
        foreach ($array1 as $item) {
            if ($array2->contains($item))
                $resultat->push($item);
        }
        return $resultat ;
    }







    //creerannonce
    public function create(){
        return view('annonce.create');
    }

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
    private function getAuthUsername(){
        $guard = $this->getAuthGuard();
        if ($guard == 'web'){
            $usernameProp = auth()->guard($guard)->user()->username ;
        }
        else{
            $usernameProp = auth()->guard($guard)->user()->name ;
        }
        return $usernameProp ;
    }
    private function checkIfItIsMyAnnonce($id_annonce,$idProp){
        $trouv = AnnonceUser::where('id_annonce','=',$id_annonce)->where('user_id','=',$idProp)->count();
        if ($trouv == 0){
            $trouv = AnnonceAgence::where('id_annonce','=',$id_annonce)->where('agence_id','=',$idProp)->count();
            if ($trouv == 0){
                return false ;
            }
            else
                return true ;
        }
        else
            return true ;
    }
    //edit/{id}
    public function afficherModifAnnonce($id){
        $idPersonneConnect = $this->getAuthId();
        if ($this->checkIfItIsMyAnnonce($id,$idPersonneConnect)){
            $annonce = Annonce::where('id_annonce',$id)->firstOrFail();
            $typeBien = Annonce::getTypeBien($id);
            $typeBienObjet = Annonce::getTypeBienObject($id);
            $typeAction = Annonce::getTypeAction($id);
            $typeActionObjet = Annonce::getTypeActionObject($id);
            $tabAnnonceImage = Annonce::getAnnonceImages($id);
            return view('annonce.modifier',compact('annonce','typeBien','typeBienObjet','typeAction','typeActionObjet','tabAnnonceImage'));
        }
        else
            return back(404) ;

    }

    private function validerCreerAnnonce(Request $request){
        $rules = [
            'titre' => 'required',
            'wilaya' => 'required',
            'description' => '',
            'adresse' => '',
            'mail' => '',
            'tel' => '',
            'superficie' => '',
        ];
        for ($i=0;$i<$request->len;$i++){
            $rules += ['image'.$i => ''];
        }
        if ($request->typeAction == 'vente'){
            $rules += [
                'prix' => ''
            ];
        }
        elseif($request->typeAction == 'location'){
            $rules += [
                'loyer' => '',
                'charge' => '',
                'depotdegarantie' => '',
                'datededisponibilite' => '',
                'dureemin' => '',
            ];
        }
        elseif($request->typeAction == 'colocation'){
            $rules += [
                'loyer' => '',
                'charge' => '',
                'depotdegarantie' => '',
                'datededisponibilite' => '',
                'dureemin' => '',
                'superficiedelachambre' => '',
                'nombrecolocataire' => '',
            ];
        }
        if ($request->typeBien == 'appartement'){
            $rules += [
                'nbpiece' => '',
                'nbchambre' => '',
                'nbwc' => '',
                'nbbains' => '',
                'nbbalcons' => '',
                'numetage' => '',
                'meuble' => '',
                'assenceur' => '',
                'parking' => '',
                'interphone' => '',
            ];
        }
        elseif($request->typeBien == 'maison'){
            $rules += [
                'nbpiecemaison' => '',
                'nbchambremaison' => '',
                'nbwcmaison' => '',
                'nbbainsmaison' => '',
                'nbbalconsmaison' => '',
                'nbetage' => '',
                'meublemaison' => '',
                'garagemaison' => '',
                'jardinmaison' => '',
            ];
        }
        elseif ($request->typeBien == 'studio'){
            $rules += [
                'numetagestudio' => '',
                'meublestudio' => '' ,
            ];
        }
        else if ($request->typeBien == 'terrain'){
            $rules += [
                'acteprop' => '',
                'meubleterrain' => '' ,
            ];
        }
        else if ($request->typeBien == 'garage'){
            $rules += [
            ] ;
        }
        return $rules ;
    }
    private function validerNombreImages($nombreImagesEnvoye){
        if ($nombreImagesEnvoye <= 7){
            return true ;
        }else
            return false ;
    }
    private function creerAnnonceForUser($id){
        $newAnnonceUser = new AnnonceUser();
        $newAnnonceUser->id_annonce = $id ;
        $newAnnonceUser->user_id = auth()->user()->id_user ;
        $newAnnonceUser->save();
    }
    private function creerAnnonceForAgence($id){
        $newAnnonceAgence = new AnnonceAgence();
        $newAnnonceAgence->id_annonce = $id ;
        $newAnnonceAgence->agence_id = auth()->guard('agence')->user()->id_agence ;
        $newAnnonceAgence->save();
    }
    private function creerAnnonce(Request $request){
        $annonce = new Annonce();
        $annonce->titre = $request->titre;
        $annonce->wilaya = ucfirst($request->wilaya);
        $annonce->adresse = $request->adresse ;
        $annonce->mail = $request->mail;
        $annonce->tel = $request->tel ;
        $annonce->description = $request->description ;
        $annonce->lat = $request->lat ;
        $annonce->lng = $request->lng ;
        $annonce->superficie = $request->superficie ;
        $annonce->etat = 1 ;
        $annonce->save();
        $id =  Annonce::all()->max('id_annonce');
        if ($this->getAuthGuard() == 'web'){
            $this->creerAnnonceForUser($id);
        }
        else{
            $this->creerAnnonceForAgence($id);
        }
        return $id ;
    }
    private function creerActionAnnonce(Request $request,$id){
        if ($request->typeAction == 'vente'){
            $v = new Vente();
            $v->id_vente = $id ;
            $v->prix = $request->prix ;
            $v->save();
            $prixAlerte = $request->prix ;
        }
        elseif ($request->typeAction == 'location'){
            $l = new \App\Location();
            $l->id_location = $id ;
            $l->loyer = $request->loyer ;
            $l->charge = $request->charge ;
            $l->depot_de_garantie = $request->depotdegarantie ;
            $l->date_de_disponibilite = $request->datededisponibilite ;
            $l->duree_min = $request->dureemin ;
            $l->save();
            $prixAlerte = $request->loyer ;
        }
        elseif ($request->typeAction == 'colocation'){
            $c = new Colocation();
            $c->id_colocation = $id ;
            $c->loyer = $request->loyer ;
            $c->charge = $request->charge ;
            $c->depot_de_garantie = $request->depotdegarantie ;
            $c->date_de_disponibilite = $request->datededisponibilite ;
            $c->duree_min = $request->dureemin ;
            $c->superficie_de_la_chambre = $request->superficiedelachambre ;
            $c->nombre_de_colocataires = $request->nombrecolocataire ;
            $c->save();
            $prixAlerte = $request->loyer ;
        }
        return $prixAlerte ;
    }
    private function creerBienAnnonce(Request $request,$id){
        if($request->typeBien == 'appartement'){
            $a = new Appartement();
            $a->id_appartement = $id ;
            $a->nb_pieces = $request->nbpiece ;
            $a->nb_chambres = $request->nbchambre ;
            $a->nb_toilettes = $request->nbwc;
            $a->nb_salles_de_bain = $request->nbbains;
            $a->nb_balcons = $request->nbbalcons;
            $a->num_etage = $request->numetage;
            $a->meuble = $request->meuble;
            $a->assenceur = $request->assenceur;
            $a->parking = $request->parking;
            $a->interphone = $request->interphone;
            $a->save();
            $chambreAlerte = $request->nbpiece ;
        }
        elseif ($request->typeBien == 'maison'){
            $m = new Maison();
            $m->id_maison = $id ;
            $m->nb_pieces = $request->nbpiecemaison;
            $m->nb_chambres = $request->nbchambremaison;
            $m->nb_toilettes = $request->nbwcmaison;
            $m->nb_salles_de_bain = $request->nbbainsmaison;
            $m->nb_balcons = $request->nbbalconsmaison;
            $m->nb_etage = $request->nbetage;
            $m->meuble = $request->meublemaison;
            $m->garage = $request->garagemaison;
            $m->jardin = $request->jardinmaison;
            $m->save();
            $chambreAlerte = $request->nbpiecemaison ;
        }
        elseif ($request->typeBien == 'studio'){
            $s = new Studio();
            $s->id_studio = $id ;
            $s->num_etage = $request->numetagestudio;
            $s->meuble = $request->meublestudio;
            $s->save();
            $chambreAlerte = 0 ;
        }
        elseif ($request->typeBien == 'terrain'){
            $t = new Terrain();
            $t->id_terrain = $id ;
            $acteDeProp = $request->file('acteprop');
            if ($acteDeProp == null){
                $name = 'default_acte_de_prop.jpg';
            }else{
                $name = $id.'_'.rand().'.'.$acteDeProp->getClientOriginalExtension();
                $acteDeProp->move(public_path('acte_de_prop'),$name);
            }
            $t->acte_prop = $name;
            $t->permis_de_construction = $request->meubleterrain;
            $t->save();
            $chambreAlerte = 0 ;
        }
        elseif ($request->typeBien == 'garage'){
            $g = new Garage();
            $g->id_garage = $id;
            $g->save();
            $chambreAlerte = 0 ;
        }
        return $chambreAlerte ;
    }
    private function creerImagesAnnonce(Request $request, $id){
        for ($i=0;$i<$request->len;$i++){
            $img = $request->file('image'.$i);
            $name = $id.'_'.rand().'.'.$img->getClientOriginalExtension();
            $img->move(public_path('cover_img'),$name);
            $imgAnnonce = new AnnonceImage();
            $imgAnnonce->nom_image = $name ;
            $imgAnnonce->annonce_id = $id ;
            $imgAnnonce->save();
        }
    }
    private function checkExistAlert($request,$prixAlerte,$chambreAlerte,$id){
        $resFinal = $this->findAlerte($request->wilaya,$request->superficie,$prixAlerte,$request->typeAction,$request->typeBien,$chambreAlerte);
        if ($resFinal->count() != 0){
            foreach ($resFinal as $item) {
                $alerte = Alerte::where('id_alerte','=',$item)->first();
                if ($alerte)
                    \Mail::to($alerte->mail)->send(new AlerteMail($alerte,Alerte::getSesBiens($item),Alerte::getSesActions($item),Alerte::getSesChambres($item),$id));
            }
        }
        return $resFinal->count();
    }
    //save
    public function store(Request $request){
        $rules = $this->validerCreerAnnonce($request);
        $validate = Validator::make($request->all(),$rules);
        if ($validate->passes() and $this->validerNombreImages($request->len))
        {
            $id = $this->creerAnnonce($request);
            $prixAlerte = $this->creerActionAnnonce($request,$id);
            $chambreAlerte = $this->creerBienAnnonce($request,$id);
            $this->creerImagesAnnonce($request,$id);
            $nbAlertes = $this->checkExistAlert($request,$prixAlerte,$chambreAlerte,$id);
            if ($this->getAuthGuard() == 'web')
                $guard = 'user' ;
            else{
                $guard = 'agence' ;
            }
            return response()->json([
                'status' => 'Success',
                'message' => 'Votre annonce a bien été insérée.',
                'alerte' => 'Votre annonce a correspendu à '.$nbAlertes.' alertes postées.',
                'guard' => $guard ,
            ]);
        }
        else{
            if ($this->validerNombreImages($request->len) == false)
                $tab = [
                    'status' => 'Errors',
                    'message' => $validate->errors(),
                    'info' => 'Le nombre d\'images ne doit pas dépasser 7 images',
                ];
            else
                $tab = [
                    'status' => 'Errors',
                    'message' => $validate->errors(),
                ];
            return \response()->json($tab);
        }
    }

    private function checkNombretotalImage($received,$had){
        if ($received + $had <= 7)
            return true ;
        else
            return false ;
    }
    private function updateAnnonceObject(Request $request){
        $annonce = Annonce::find($request->id_annonce);
        $annonce->titre = $request->titre;
        $annonce->wilaya = $request->wilaya;
        $annonce->adresse = $request->adresse;
        $annonce->mail = $request->mail;
        $annonce->tel = $request->tel;
        $annonce->description = $request->description;
        $annonce->lat = $request->lat;
        $annonce->lng = $request->lng;
        $annonce->superficie = $request->superficie;
        $annonce->save();
    }
    private function updateActionObject(Request $request,$typeAction,$typeActionObjet){
        if ($typeAction == 'vente'){
            $typeActionObjet->prix = $request->prix ;
            $prixAlerte = $request->prix ;
        }elseif ($typeAction == 'location'){
            $typeActionObjet->loyer = $request->loyer ;
            $typeActionObjet->charge = $request->charge ;
            $typeActionObjet->depot_de_garantie = $request->depotdegarantie ;
            $typeActionObjet->date_de_disponibilite = $request->datededisponibilite ;
            $typeActionObjet->duree_min = $request->dureemin ;
            $prixAlerte = $request->loyer ;
        }elseif ($typeAction == 'colocation'){
            $typeActionObjet->loyer = $request->loyer ;
            $typeActionObjet->charge = $request->charge ;
            $typeActionObjet->depot_de_garantie = $request->depotdegarantie ;
            $typeActionObjet->date_de_disponibilite = $request->datededisponibilite ;
            $typeActionObjet->duree_min = $request->dureemin ;
            $typeActionObjet->superficie_de_la_chambre = $request->superficiedelachambre ;
            $typeActionObjet->nombre_de_colocataires = $request->nombrecolocataire ;
            $prixAlerte = $request->loyer ;
        }
        $typeActionObjet->save();
        return $prixAlerte ;
    }
    private function updateBienObject(Request $request,$typeBien, $typeBienObjet){
        $chambreAlerte = 0 ;
        if ($typeBien == 'appartement'){
            $typeBienObjet->nb_pieces = $request->nbpiece;
            $typeBienObjet->nb_chambres = $request->nbchambre;
            $typeBienObjet->nb_toilettes = $request->nbwc;
            $typeBienObjet->nb_salles_de_bain = $request->nbbains;
            $typeBienObjet->nb_balcons = $request->nbbalcons;
            $typeBienObjet->num_etage = $request->numetage;
            $typeBienObjet->meuble = $request->meuble;
            $typeBienObjet->assenceur = $request->assenceur;
            $typeBienObjet->parking = $request->parking;
            $typeBienObjet->interphone = $request->interphone;
            $chambreAlerte = $request->nbchambre ;
        }
        elseif ($typeBien == 'maison'){
            $typeBienObjet->nb_pieces = $request->nbpiecemaison;
            $typeBienObjet->nb_chambres = $request->nbchambremaison;
            $typeBienObjet->nb_toilettes = $request->nbwcmaison;
            $typeBienObjet->nb_salles_de_bain = $request->nbbainsmaison;
            $typeBienObjet->nb_balcons = $request->nbbalconsmaison;
            $typeBienObjet->nb_etage = $request->nbetage;
            $typeBienObjet->meuble = $request->meublemaison;
            $typeBienObjet->garage = $request->garagemaison;
            $typeBienObjet->jardin = $request->jardinmaison;
            $chambreAlerte = $request->nbchambremaison;
        }
        elseif ($typeBien == 'studio'){
            $typeBienObjet->num_etage = $request->numetagestudio;
            $typeBienObjet->meuble = $request->meublestudio;
        }
        elseif ($typeBien == 'terrain'){
            $acteDeProp = $request->file('acteprop');
            if ($acteDeProp == null){
                $name = $typeBienObjet->acte_prop;
            }else{
                $name = $request->id_annonce.'_'.rand().'.'.$acteDeProp->getClientOriginalExtension();
                $acteDeProp->move(public_path('acte_de_prop'),$name);
            }
            $typeBienObjet->acte_prop = $name;
            $typeBienObjet->permis_de_construction = $request->meubleterrain;
        }
        elseif ($typeBien == 'garage'){
        }
        $typeBienObjet->save();
    }
    //update
    public function updateAnnonce(Request $request){
        $rules = $this->validerCreerAnnonce($request) ;
        $tabAnnonceImage = Annonce::getAnnonceImages($request->id_annonce);
        $ln = $tabAnnonceImage->count();
        $validate = Validator::make($request->all(),$rules);
        if ($validate->passes() and $this->checkNombretotalImage($ln,$request->len)){
            $prixAlerte = 0 ; $chambreAlerte = 0 ;
            $this->updateAnnonceObject($request);
            $typeAction = Annonce::getTypeAction($request->id_annonce);
            $typeActionObjet = Annonce::getTypeActionObject($request->id_annonce);
            if ($typeAction == $request->typeAction){
                $prixAlerte = $this->updateActionObject($request,$typeAction,$typeActionObjet);
            }
            else{
                $this->creerActionAnnonce($request,$request->id_annonce);
                $typeActionObjet->delete();
            }
            $typeBien = Annonce::getTypeBien($request->id_annonce);
            $typeBienObjet = Annonce::getTypeBienObject($request->id_annonce);
            if($typeBien == $request->typeBien){
                $chambreAlerte = $this->updateBienObject($request,$typeBien,$typeBienObjet);
            }
            else{
                $chambreAlerte = $this->creerBienAnnonce($request,$request->id_annonce);
                $typeBienObjet->delete();
            }
            $this->creerImagesAnnonce($request,$request->id_annonce);
            $nbAlertes = $this->checkExistAlert($request,$prixAlerte,$chambreAlerte,$request->id_annonce);
            return response()->json([
                'status' => 'Success',
                'message' => 'Votre annonce a bien été modifier',
                'nombresAlertes' => 'Grace à votre modification, votre annonce désormais correspent à '.$nbAlertes.' alertes.',
            ]);
        }
        else{
            if ($this->checkNombretotalImage($ln,$request->len) == false)
                $tab = [
                    'status' => 'Errors',
                    'message' => $validate->errors(),
                    'info' => $ln.'Le nombre d\'images ne doit pas dépasser 7 images',
                ];
            else
                $tab = [
                    'status' => 'Errors',
                    'message' => $validate->errors(),
                ];
            return \response()->json($tab);
        }
    }

    //supprimerimageannonce/{id}
    public function supprimerImageAnnonce($id){
        $image = AnnonceImage::find($id);
        $path = 'cover_img/'.$image->nom_image;
        if (File::exists($path)){
            File::delete($path);
        }
        $image->delete();
        return back()->with('message','Votre photo a bien été supprimée')->withInput();
    }

    //changeetat/{id}
    public function changerEtat($id){
        $annonce = Annonce::where('id_annonce','=',$id)->firstOrFail();
        if($annonce->etat == 0)
            $annonce->etat = 1 ;
        else
            $annonce->etat = 0 ;
        $annonce->save();
        $typeAction = Annonce::getTypeAction($id);
        $typeActionObj = Annonce::getTypeActionObject($id);
        if ($typeAction == 'vente'){
            $prixAlerte = $typeActionObj->prix ;
        }
        elseif ($typeAction == 'location' || $typeAction == 'colocation'){
            $prixAlerte = $typeActionObj->loyer ;
        }
        $typeBien = Annonce::getTypeBien($id);
        $typeBienObj = Annonce::getTypeBienObject($id);
        if ($typeBien == 'appartement' || $typeBien == 'maison'){
            $chambreAlerte = $typeBienObj->nb_pieces ;
        }else
            $chambreAlerte = 0 ;
        $nbAlerte = $this->checkExistAlert($annonce,$prixAlerte,$chambreAlerte,$id);
        return back()->withInput()->with('info','En réactivant cette annonce, désormais elle correspend à '.$nbAlerte.' alerte(s).');
    }

    //supprimerannonce/{id}
    public function supprimerAnnonce($id){
        $annonce = Annonce::find($id);
        $typeActionObject = Annonce::getTypeActionObject($id);
        $typeBienObject = Annonce::getTypeBienObject($id);
        if ($annonce != null) $annonce->delete();
        if ($typeActionObject != null) $typeActionObject->delete();
        if ($typeBienObject != null) $typeBienObject->delete();
        $tabPhotos = AnnonceImage::where('annonce_id',$id);
        foreach ($tabPhotos as $tabPhoto) {
            $path = 'cover_img/'.$tabPhoto->nom_image ;
            if (File::exists($path)){
                File::delete($path);
            }
        }
        if ($tabPhotos != null) $tabPhotos->delete();
        if ($this->getAuthGuard() == 'web'){
            AnnonceUser::where('id_annonce','=',$id)->delete();
            return redirect('/profil');
        }
        else{
            AnnonceAgence::where('id_annonce','=',$id)->delete();
            return redirect('/profilAgence');
        }
    }

    //supprimeracteprop/{id}
    public function supprimerActeDeProp($id){
        $typeBien = Annonce::getTypeBienObject($id);
        if ($typeBien){
            $path = 'acte_de_prop/'.$typeBien->acte_prop ;
            if (File::exists($path)){
                File::delete($path);
            }
            $typeBien->acte_prop = 'default_acte_de_prop' ;
            $typeBien->save();

        }
        return back()->withInput() ;
    }

    private function getTypeProp($id){
        $count = AnnonceAgence::where('id_annonce','=',$id)->count();
        if ($count == 0){
            return 'user' ;
        }
        else{
            return 'agence' ;
        }
    }
    private function getTypePropObjet($id){
        $item = AnnonceAgence::where('id_annonce','=',$id)->first();
        if ($item == null){
            $item = AnnonceUser::where('id_annonce','=',$id)->firstOrFail();
            $id_user = $item->user_id ;
            $user = User::where('id_user','=',$id_user)->firstOrFail();
            return $user ;
        }
        else{
            $id_agence = $item->agence_id ;
            $agence = Agence::where('id_agence','=',$id_agence)->firstOrFail();
            return $agence ;
        }
    }
    //afficherdetail
    public function showDetailsAnnonce(Request $request){
        $id = $request->id ;
        $typeProp = $this->getTypeProp($id) ;
        $typePropObjet = $this->getTypePropObjet($id) ;
        $annonce = Annonce::where('id_annonce','=',$id)->first();
        $typeAction = Annonce::getTypeAction($id);
        $typeActionObj = Annonce::getTypeActionObject($id);
        $typeBien = Annonce::getTypeBien($id);
        $typeBienObj = Annonce::getTypeBienObject($id);
        $imageAnnonce = Annonce::getAnnonceImages($id);
        $idPersonneConnect = $this->getAuthId();
        $favoris = Favoris::where('annonce_id','=',$id)->where('user_id','=',$idPersonneConnect)->first();
        if ($favoris == null)
            $titreBoutton = "Ajouter à mes favoris" ;
        else{
            $titreBoutton = 'Retirer de mes favoris';
        }
        return response()->json([
            'annonce' => $annonce ,
            'typeaction' => $typeAction ,
            'typeactionobj' => $typeActionObj ,
            'typebien' => $typeBien ,
            'typebienobj' => $typeBienObj ,
            'images' => $imageAnnonce ,
            'titreBoutton' => $titreBoutton,
            'typeProp' => $typeProp ,
            'typePropObjet' => $typePropObjet ,
            'personneAuth' => $this->getAuthGuard() ,
        ]);
    }

    //commander
    public function commanderAnnonce(Request $request){
        $rules = [
            'mail' => 'required',
            'tel' => 'required|numeric',
            'message' => 'required|min:5',
        ];
        $validator = Validator::make($request->all(),$rules);
        if ($validator->passes()){
            $res = new Reservation();
            $res->annonce_id = $request->id_annonce ;
            $res->mail = $request->mail ;
            $res->tel = $request->tel ;
            $res->message = $request->message ;
            $res->save();
            $annonce = Annonce::where('id_annonce','=',$request->id_annonce)->firstOrFail();
            $typeBien = Annonce::getTypeBien($request->id_annonce);
            $typeBienObj = Annonce::getTypeBienObject($request->id_annonce);
            $typeAction = Annonce::getTypeAction($request->id_annonce);
            $typeActionObj = Annonce::getTypeActionObject($request->id_annonce);
            $image00 = Annonce::getAnnonceImages($request->id_annonce)->get(0)->nom_image;
            $path = 'cover_img/'.$image00 ;
            $prop_annonce = AnnonceUser::where('id_annonce','=',$annonce->id_annonce)->first();
            if ($prop_annonce == null){
                $prop_annonce = AnnonceAgence::where('id_annonce','=',$annonce->id_annonce)->firstOrFail();
                $id_prop_annonce = $prop_annonce->agence_id ;
                $id_prop_annonce_Objet = Agence::where('id_agence','=',$id_prop_annonce)->firstOrFail();
                $mail = $id_prop_annonce_Objet->email ;
            }
            else{
                $id_prop_annonce = $prop_annonce->user_id ;
                $id_prop_annonce_Objet = User::where('id_user','=',$id_prop_annonce)->firstOrFail();
                $mail = $id_prop_annonce_Objet->mail ;
            }
            if ($annonce->mail != null)
                $mailExp = $annonce->mail ;
            else
                $mailExp = $mail ;

            $myUser = $this->getAuthUsername() ;

            \Mail::send('emails.commander',compact('annonce','typeBien','typeBienObj','typeAction','typeActionObj','id_prop_annonce_Objet','myUser','path','res'),function ($message) use($mailExp){
                $message->from('NotreSite@Immobilier.dz');
                $message->to($mailExp);
                $message->subject('Vous avez reçu une nouvelle notification.');
                $message->replyTo('NotreSite@Immobilier.dz');
            });

            $not = new Notification();
            $not->annonce_id = $request->id_annonce ;
            $not->etat = 1 ;
            $not->texte = 'Un utilisateur vient de commander une de vos annonces, un mail vous a été envoyé dans votre boite email afin d\'avoir plus de details sur cette personne et sur l\'annonce en question.';
            $not->save();
            $id = Notification::max('id_notification');
            $guard = $this->getTypeProp($request->id_annonce);
            if ($guard == 'user'){
                $notifUser = new NotificationUser();
                $notifUser->id_notification = $id ;
                $notifUser->user_id = $id_prop_annonce ;
                $notifUser->save();
            }
            else{
                $notifAgence = new NotificationAgence();
                $notifAgence->id_notification = $id ;
                $notifAgence->agence_id = $id_prop_annonce ;
                $notifAgence->save();
            }
            return response()->json([
                'status' => 'Success',
                'message' => 'Votre commande a bien été envoyé',
            ]);
        }
        else{
            return response()->json([
                'status' => 'Erreur',
                'message' => $validator->errors(),
            ]);
        }
    }

    //voirannoncedealerte/{id}
    public function afficherAnnonceFromAlerte($id){
        $ann = Annonce::where('id_annonce','=',$id)->get();
        $typeBien = Annonce::getTypeBien($id);
        $typeBienObj = Annonce::getTypeBienObject($id);
        $typeAction = Annonce::getTypeAction($id);
        $typeActionObj = Annonce::getTypeActionObject($id);
        $images = Annonce::getAnnonceImages($id);
        return view('alertes.details_annonce_alerte',compact('ann','typeBien','typeBienObj','typeAction','typeActionObj','images'));
    }

    private function searchActions(Request $request,$idResult){
        if ($request->vente == 1){
            $v = Vente::where('prix','<=',$request->prixmax)->where('prix','>=',$request->prixmin)->get();
            if ($v !== null)
                foreach ($v as $var)
                    $idResult->push($var->id_vente);
        }
        if ($request->location == 1){
            $v = Location::where('loyer','<=',$request->loyermax)->where('loyer','>=',$request->loyermin)->get();
            if ($v !== null)
                foreach ($v as $var)
                    $idResult->push($var->id_location);
        }
        if ($request->colocation == 1){
            $v = Colocation::where('loyer','<=',$request->loyermax)->where('loyer','>=',$request->loyermin)->get();
            if ($v !== null)
                foreach ($v as $var)
                    $idResult->push($var->id_colocation);
        }
        return $idResult ;
    }
    private function builtTabPieces(Request $request, $tabPiece){
        if ($request->onepiece == 1) $tabPiece->push(1);
        if ($request->twopieces == 1) $tabPiece->push(2);
        if ($request->threepieces == 1) $tabPiece->push(3);
        if ($request->fourpieces == 1) $tabPiece->push(4);
        if ($request->fivepieces == 1) $tabPiece->push(5);
        if ($request->sixpieces == 1) $tabPiece->push(6);
        if ($request->sevenpieces == 1) $tabPiece->push(7);
        if ($request->eightandmorepieces == 1) $tabPiece->push(8);
        return $tabPiece ;
    }
    private function builtTabEtages(Request $request, $tabEtage){
        if ($request->oneetage == 1) $tabEtage->push(1);
        if ($request->twoetages == 1) $tabEtage->push(2);
        if ($request->threeetages == 1) $tabEtage->push(3);
        if ($request->fouretages == 1) $tabEtage->push(4);
        if ($request->fiveetages == 1) $tabEtage->push(5);
        if ($request->sixetages == 1) $tabEtage->push(6);
        if ($request->sevenetages == 1) $tabEtage->push(7);
        if ($request->eightandmoreetages == 1) $tabEtage->push(8);
        return $tabEtage ;
    }
    private function searchAppartement($idResult,$tabPiece,$tabEtage,$resultat){
        foreach ($idResult as $id){
            foreach ($tabPiece as $tp){
                foreach ($tabEtage as $te){
                    $a = Appartement::where('id_appartement','=',$id)->where('nb_pieces','=',$tp)->where('num_etage','=',$te)->get();
                    if ($a != null)
                        foreach ($a as $item) {
                            $resultat->push($item->id_appartement);
                        }
                }
                if ($tabEtage->contains(8)){
                    $a = Appartement::where('id_appartement','=',$id)->where('nb_pieces','=',$tp)->where('num_etage','>',8)->get();
                    foreach ($a as $item) {
                        $resultat->push($item->id_appartement);
                    }
                }
            }
            if ($tabPiece->contains(8)){
                foreach ($tabEtage as $te){
                    $a = Appartement::where('id_appartement','=',$id)->where('nb_pieces','>',8)->where('num_etage','=',$te)->get();
                    foreach ($a as $item) {
                        $resultat->push($item->id_appartement);
                    }
                }
            }
            if ($tabPiece->contains(8) && $tabEtage->contains(8)){
                $a = Appartement::where('id_appartement','=',$id)->where('nb_pieces','>',8)->where('num_etage','>',8)->get();
                foreach ($a as $item) {
                    $resultat->push($item->id_appartement);
                }
            }
        }
        return $resultat ;
    }
    private function searchMaison($idResult,$tabPiece,$resultat){
        foreach ($idResult as $id){
            foreach ($tabPiece as $tp) {
                $m = Maison::where('id_maison','=',$id)->where('nb_pieces','=',$tp)->get();
                if ($m != null){
                    foreach ($m as $item) {
                        $resultat->push($item->id_maison);
                    }
                }
            }
            if ($tabPiece->contains(8)){
                $m = Maison::where('id_maison','=',$id)->where('nb_pieces','>',8)->get();
                if ($m != null){
                    foreach ($m as $item) {
                        $resultat->push($item->id_maison);
                    }
                }
            }
        }
        return $resultat ;
    }
    private function searchStudio($idResult,$tabEtage,$resultat){
        foreach ($idResult as $id){
            foreach ($tabEtage as $te){
                $s = Studio::where('id_studio','=',$id)->where('num_etage','=',$te)->get();
                if ($s != null)
                    foreach ($s as $var)
                        $resultat->push($var->id_studio);
            }
            if ($tabEtage->contains(8)){
                $s = Studio::where('id_studio','=',$id)->where('num_etage','>',8)->get();
                if ($s != null){
                    foreach ($s as $var)
                        $resultat->push($var->id_studio);
                }
            }
        }
        return $resultat ;
    }
    private function searchTerrain($idResult,$resultat){
        foreach ($idResult as $id){
            $t = Terrain::where('id_terrain','=',$id)->get();
            if ($t != null)
                foreach ($t as $var)
                    $resultat->push($var->id_terrain);
        }
        return $resultat ;
    }
    private function searchGarage($idResult,$resultat){
        foreach ($idResult as $id){
            $g = Garage::where('id_garage','=',$id)->get();
            if ($g != null)
                foreach ($g as $item) {
                    $resultat->push($item->id_garage);
                }
        }
        return $resultat ;
    }
    private function searchDateAndSuperficie(Request $request, $resultat, $resultFinal){
        foreach ($resultat as $id){
            if ($request->datedepublication == -1){
                $annonce = Annonce::where('id_annonce','=',$id)->where('superficie','<=',$request->surfacemax)->where('superficie','>=',$request->surfacemin)->get();
                foreach ($annonce as $var)
                    $resultFinal->push($var);
            }else{
                $now = new \DateTime();
                $annonce = Annonce::where('created_at','<=',new \DateTime())->where('created_at','>=',$now->sub(new \DateInterval('P'.$request->datedepublication.'D')))->where('id_annonce','=',$id)->where('superficie','<=',$request->surfacemax)->where('superficie','>=',$request->surfacemin)->get();
                if ($annonce != null)
                    foreach ($annonce as $a)
                        $resultFinal->push($a);
            }
        }
        return $resultFinal ;
    }
    //find
    //c'est quand je clique sur le bouton chercher annonce
    public function findAnnonce(Request $request){
        $idResult = collect([]);$tabPiece = collect([]);$tabEtage = collect([]);$resultat = collect([]);
        $idResult = $this->searchActions($request,$idResult);
        $tabPiece = $this->builtTabPieces($request,$tabPiece);
        $tabEtage = $this->builtTabEtages($request,$tabEtage);
        if ($request->appartement == 1){
            $resultat = $this->searchAppartement($idResult,$tabPiece,$tabEtage,$resultat);
        }
        if ($request->maison == 1){
            $resultat = $this->searchMaison($idResult,$tabPiece,$resultat);
        }
        if ($request->studio == 1){
            $resultat = $this->searchStudio($idResult,$tabEtage,$resultat);
        }
        if ($request->terrain == 1){
            $resultat = $this->searchTerrain($idResult,$resultat);
        }
        if($request->garage == 1){
            $resultat = $this->searchGarage($idResult,$resultat);
        }
        $resultFinal = collect([]);
        $resultFinal = $this->searchDateAndSuperficie($request,$resultat,$resultFinal);
        $typeBien = collect([]);
        $typeBienObj = collect([]);
        $typeAction = collect([]);
        $typeActionObj = collect([]);
        $image = collect([]);
        $trouvInFavoris = collect([]);

        foreach ($resultFinal as $item) {
            $typeBien->push(Annonce::getTypeBien($item->id_annonce));
            $typeBienObj->push(Annonce::getTypeBienObject($item->id_annonce));
            $typeAction->push(Annonce::getTypeAction($item->id_annonce));
            $typeActionObj->push(Annonce::getTypeActionObject($item->id_annonce));
            $image->push(Annonce::getAnnonceImages($item->id_annonce));
            //On s'assure qu'on soit connecté afin que les favoris s'affiche avec un autre marqueur.
            if (auth()->check() == true){
                $favoris = Favoris::where('annonce_id','=',$item->id_annonce)->where('user_id','=',auth()->user()->id_user)->first();
                if ($favoris != null){
                    $trouvInFavoris->push(1);
                }else{
                    $trouvInFavoris->push(0);
                }
            }else{
                $trouvInFavoris->push(0);
            }
        }

        return response()->json([
            'annonce' => $resultFinal ,
            'typebien' => $typeBien ,
            'typebienobj' => $typeBienObj ,
            'typeaction' => $typeAction ,
            'typeactionobj' => $typeActionObj ,
            'image' => $image ,
            'mesfavoris' => $trouvInFavoris,
        ]);
    }
}
