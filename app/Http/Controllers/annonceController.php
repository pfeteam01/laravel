<?php

namespace App\Http\Controllers;

use App\Annonce;
use App\AnnonceImage;
use App\Appartement;
use App\Colocation;
use App\Garage;
use App\Location;
use App\Mail\CommandeMail;
use App\Maison;
use App\Notification;
use App\Reservation;
use App\Studio;
use App\Terrain;
use App\User;
use App\Vente;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use logdb;
use File;

/**
 * @package App\Http\Controllers
 */
class AnnonceController extends Controller
{
    public function create(){
        return view('annonce.create');
    }

    public function store(Request $request){
        $rules = [
            'titre' => '',
            'wilaya' => '',
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
        $validate = Validator::make($request->all(),$rules);
        if ($validate->passes() and $request->len<=7){
            $annonce = new Annonce();
            $annonce->titre = $request->titre;
            $annonce->wilaya = $request->wilaya;
            $annonce->adresse = $request->adresse ;
            $annonce->mail = $request->mail;
            $annonce->tel = $request->tel ;
            $annonce->description = $request->description ;
            $annonce->lat = $request->lat ;
            $annonce->lng = $request->lng ;
            $annonce->superficie = $request->superficie ;
            $annonce->etat = 1 ;
            $annonce->user_id = auth()->user()->id_user ;
            $annonce->save();
            $id =  Annonce::all()->max('id_annonce');
            if ($request->typeAction == 'vente'){
                $v = new Vente();
                $v->id_vente = $id ;
                $v->prix = $request->prix ;
                $v->save();
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
            }
            if($request->typeBien == 'appartement'){
                $a = new Appartement();
                $a->id_appartement = $id ;
                $a->nb_pieces = $request->nbpiece;
                $a->nb_chambres = $request->nbchambre;
                $a->nb_toilettes = $request->nbwc;
                $a->nb_salles_de_bain = $request->nbbains;
                $a->nb_balcons = $request->nbbalcons;
                $a->num_etage = $request->numetage;
                $a->meuble = $request->meuble;
                $a->assenceur = $request->assenceur;
                $a->parking = $request->parking;
                $a->interphone = $request->interphone;
                $a->save();
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
            }
            elseif ($request->typeBien == 'studio'){
                $s = new Studio();
                $s->id_studio = $id ;
                $s->num_etage = $request->numetagestudio;
                $s->meuble = $request->meublestudio;
                $s->save();
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
            }
            elseif ($request->typeBien == 'garage'){
                $g = new Garage();
                $g->id_garage = $id;
                $g->save();
            }
            for ($i=0;$i<$request->len;$i++){
                $img = $request->file('image'.$i);
                $name = $id.'_'.rand().'.'.$img->getClientOriginalExtension();
                $img->move(public_path('cover_img'),$name);
                $imgAnnonce = new AnnonceImage();
                $imgAnnonce->nom_image = $name ;
                $imgAnnonce->annonce_id = $id ;
                $imgAnnonce->save();
            }
            return response()->json([
                'status' => 'Success',
                'message' => 'Votre annonce a bien été inséré',
            ]);
        }
        else{
            if ($request->len > 7)
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

    public function afficherModifAnnonce($id){
        $annonce = Annonce::where('id_annonce',$id)->first();
        $typeBien = $this->getTypeBien($id);
        $typeBienObjet = $this->getTypeBienObject($id);
        $typeAction = $this->getTypeAction($id);
        $typeActionObjet = $this->getTypeActionObject($id);
        $tabAnnonceImage = $this->getAnnonceImages($id);
        return view('annonce.modifier',compact('annonce','typeBien','typeBienObjet','typeAction','typeActionObjet','tabAnnonceImage'));
    }

    public function supprimerImageAnnonce(Request $request){
        $image = AnnonceImage::find($request->id);
        $id_annonce = $image->annonce_id ;
        $image->delete();
        //Prochainemet retirer cette image de vrai
        return response()->json([
            'message' => 'Cette image a bien été supprimée',
            'status' => 'Success',
        ]);
    }

    public function updateAnnonce(Request $request){
        $rules = [
            'titre' => '',
            'wilaya' => '',
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
        }elseif($request->typeAction == 'location'){
            $rules += [
                'loyer' => '',
                'charge' => '',
                'depotdegarantie' => '',
                'datededisponibilite' => '',
                'dureemin' => '',
            ];
        }elseif($request->typeAction == 'colocation'){
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
        }elseif($request->typeBien == 'maison'){
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
        }elseif ($request->typeBien == 'studio'){
            $rules += [
                'numetagestudio' => '',
                'meublestudio' => '' ,
            ];
        }else if ($request->typeBien == 'terrain'){
            $rules += [
                'acteprop' => '',
                'meubleterrain' => '' ,
            ];
        }else if ($request->typeBien == 'garage'){
            $rules += [] ;
        }

        $tabAnnonceImage = $this->getAnnonceImages($request->id_annonce);
        $ln = $tabAnnonceImage->count();
        $validate = Validator::make($request->all(),$rules);
        if ($validate->passes() and $ln+$request->len<=7){
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
            $typeAction = $this->getTypeAction($request->id_annonce);
            $typeActionObjet = $this->getTypeActionObject($request->id_annonce);
            if ($typeAction == $request->typeAction){
                if ($typeAction == 'vente'){
                    $typeActionObjet->prix = $request->prix ;
                }elseif ($typeAction == 'location'){
                    $typeActionObjet->loyer = $request->loyer ;
                    $typeActionObjet->charge = $request->charge ;
                    $typeActionObjet->depot_de_garantie = $request->depotdegarantie ;
                    $typeActionObjet->date_de_disponibilite = $request->datededisponibilite ;
                    $typeActionObjet->duree_min = $request->dureemin ;
                }elseif ($typeAction == 'colocation'){
                    $typeActionObjet->loyer = $request->loyer ;
                    $typeActionObjet->charge = $request->charge ;
                    $typeActionObjet->depot_de_garantie = $request->depotdegarantie ;
                    $typeActionObjet->date_de_disponibilite = $request->datededisponibilite ;
                    $typeActionObjet->duree_min = $request->dureemin ;
                    $typeActionObjet->superficie_de_la_chambre = $request->superficiedelachambre ;
                    $typeActionObjet->nombre_de_colocataires = $request->nombrecolocataire ;
                }
                $typeActionObjet->save();
            }
            else{
                if ($request->typeAction == 'vente'){
                    $v = new Vente();
                    $v->id_vente = $request->id_annonce ;
                    $v->prix = $request->prix ;
                    $v->save();
                }elseif ($request->typeAction == 'location'){
                    $l = new Location();
                    $l->id_location = $request->id_annonce ;
                    $l->loyer = $request->loyer ;
                    $l->charge = $request->charge ;
                    $l->depot_de_garantie = $request->depotdegarantie ;
                    $l->date_de_disponibilite = $request->datededisponibilite ;
                    $l->duree_min = $request->dureemin ;
                    $l->save();
                }elseif ($request->typeAction == 'colocation'){
                    $c = new Colocation();
                    $c->id_colocation = $request->id_annonce ;
                    $c->loyer = $request->loyer ;
                    $c->charge = $request->charge ;
                    $c->depot_de_garantie = $request->depotdegarantie ;
                    $c->date_de_disponibilite = $request->datededisponibilite ;
                    $c->duree_min = $request->dureemin ;
                    $c->superficie_de_la_chambre = $request->superficiedelachambre ;
                    $c->nombre_de_colocataires = $request->nombrecolocataire ;
                    $c->save();
                }
                $typeActionObjet->delete();
            }
            $typeBien = $this->getTypeBien($request->id_annonce);
            $typeBienObjet = $this->getTypeBienObject($request->id_annonce);
            if($typeBien == $request->typeBien){
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
                }elseif ($typeBien == 'maison'){
                    $typeBienObjet->nb_pieces = $request->nbpiecemaison;
                    $typeBienObjet->nb_chambres = $request->nbchambremaison;
                    $typeBienObjet->nb_toilettes = $request->nbwcmaison;
                    $typeBienObjet->nb_salles_de_bain = $request->nbbainsmaison;
                    $typeBienObjet->nb_balcons = $request->nbbalconsmaison;
                    $typeBienObjet->nb_etage = $request->nbetage;
                    $typeBienObjet->meuble = $request->meublemaison;
                    $typeBienObjet->garage = $request->garagemaison;
                    $typeBienObjet->jardin = $request->jardinmaison;
                }elseif ($typeBien == 'studio'){
                    $typeBienObjet->num_etage = $request->numetagestudio;
                    $typeBienObjet->meuble = $request->meublestudio;
                }elseif ($typeBien == 'terrain'){
                    $acteDeProp = $request->file('acteprop');
                    if ($acteDeProp == null){
                        $name = $typeBienObjet->acte_prop;
                    }else{
                        $name = $request->id_annonce.'_'.rand().'.'.$acteDeProp->getClientOriginalExtension();
                        $acteDeProp->move(public_path('acte_de_prop'),$name);
                    }
                    $typeBienObjet->acte_prop = $name;
                    $typeBienObjet->permis_de_construction = $request->meubleterrain;
                }elseif ($typeBien == 'garage'){
                }
                $typeBienObjet->save();
            }
            else{
                if($request->typeBien == 'appartement'){
                    $a = new Appartement();
                    $a->id_appartement = $request->id_annonce ;
                    $a->nb_pieces = $request->nbpiece;
                    $a->nb_chambres = $request->nbchambre;
                    $a->nb_toilettes = $request->nbwc;
                    $a->nb_salles_de_bain = $request->nbbains;
                    $a->nb_balcons = $request->nbbalcons;
                    $a->num_etage = $request->numetage;
                    $a->meuble = $request->meuble;
                    $a->assenceur = $request->assenceur;
                    $a->parking = $request->parking;
                    $a->interphone = $request->interphone;
                    $a->save();
                }
                elseif ($request->typeBien == 'maison'){
                    $m = new Maison();
                    $m->id_maison = $request->id_annonce ;
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
                }
                elseif ($request->typeBien == 'studio'){
                    $s = new Studio();
                    $s->id_studio = $request->id_annonce ;
                    $s->num_etage = $request->numetagestudio;
                    $s->meuble = $request->meublestudio;
                    $s->save();
                }
                elseif ($request->typeBien == 'terrain'){
                    $t = new Terrain();
                    $t->id_terrain = $request->id_annonce ;
                    $acteDeProp = $request->file('acteprop');
                    if ($acteDeProp == null){
                        $name = 'default_acte_de_prop.jpg';
                    }else{
                        $name = $request->id_annonce.'_'.rand().'.'.$acteDeProp->getClientOriginalExtension();
                        $acteDeProp->move(public_path('acte_de_prop'),$name);
                    }
                    $t->acte_prop = $name;
                    $t->permis_de_construction = $request->meubleterrain;
                    $t->save();
                }
                elseif ($request->typeBien == 'garage'){
                    $g = new Garage();
                    $g->id_garage = $request->id_annonce ;
                    $g->save();
                }
                $typeBienObjet->delete();
            }
            for ($i=0;$i<$request->len;$i++){
                $img = $request->file('image'.$i);
                $name = $request->id_annonce.'_'.rand().'.'.$img->getClientOriginalExtension();
                $img->move(public_path('cover_img'),$name);
                $imgAnnonce = new AnnonceImage();
                $imgAnnonce->nom_image = $name ;
                $imgAnnonce->annonce_id = $request->id_annonce ;
                $imgAnnonce->save();
            }
            return response()->json([
                'status' => 'Success',
                'message' => 'Votre annonce a bien été modifier',
            ]);
        }
        else{
            if ($ln+$request->len>7)
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

    public function changerEtat($id){
        $annonce = Annonce::find($id);
        if($annonce->etat == 0)
            $annonce->etat = 1 ;
        else
            $annonce->etat = 0 ;
        $annonce->save();
        return back()->withInput();
    }

    public function supprimerAnnonce($id){
        $annonce = Annonce::find($id);
        $typeActionObject = $this->getTypeActionObject($id);
        $typeBienObject = $this->getTypeBienObject($id);
        if ($annonce != null) $annonce->delete();
        if ($typeActionObject != null) $typeActionObject->delete();
        if ($typeBienObject != null) $typeBienObject->delete();
        $tabPhotos = AnnonceImage::where('annonce_id',$id);
        if ($tabPhotos != null) $tabPhotos->delete();
        //Les supprimer reelement
        return redirect('/profil');
    }

    public function supprimerActeDeProp($id){
        $typeBien = $this->getTypeBienObject($id);
        if ($typeBien){
            $typeBien->acte_prop = 'default_acte_de_prop' ;
            $typeBien->save();
            //Effacer l'acte realement du fichier
        }
        return back()->withInput() ;
    }

    public function findAnnonce(Request $request){
        $idResult = collect([]);
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
        $tabPiece = collect([]);
        $tabEtage = collect([]);

        if ($request->onepiece == 1) $tabPiece->push(1);
        if ($request->twopieces == 1) $tabPiece->push(2);
        if ($request->threepieces == 1) $tabPiece->push(3);
        if ($request->fourpieces == 1) $tabPiece->push(4);
        if ($request->fivepieces == 1) $tabPiece->push(5);
        if ($request->sixpieces == 1) $tabPiece->push(6);
        if ($request->sevenpieces == 1) $tabPiece->push(7);
        if ($request->eightandmorepieces == 1) $tabPiece->push(8);

        if ($request->oneetage == 1) $tabEtage->push(1);
        if ($request->twoetages == 1) $tabEtage->push(2);
        if ($request->threeetages == 1) $tabEtage->push(3);
        if ($request->fouretages == 1) $tabEtage->push(4);
        if ($request->fiveetages == 1) $tabEtage->push(5);
        if ($request->sixetages == 1) $tabEtage->push(6);
        if ($request->sevenetages == 1) $tabEtage->push(7);
        if ($request->eightandmoreetages == 1) $tabEtage->push(8);

        $resultat = collect([]);
        if ($request->appartement == 1){
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
        }
        if ($request->maison == 1){
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
        }
        if ($request->studio == 1){
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
        }
        if ($request->terrain == 1){
            foreach ($idResult as $id){
                $t = Terrain::where('id_terrain','=',$id)->get();
                if ($t != null)
                    foreach ($t as $var)
                        $resultat->push($var->id_terrain);
            }
        }
        if($request->garage == 1){
            foreach ($idResult as $id){
                $g = Garage::where('id_garage','=',$id)->get();
                if ($g != null)
                    foreach ($g as $item) {
                        $resultat->push($item->id_garage);
                    }
            }
        }

        $resultFinal = collect([]);
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

        $typeBien = collect([]);
        $typeBienObj = collect([]);
        $typeAction = collect([]);
        $typeActionObj = collect([]);
        $image = collect([]);
        foreach ($resultFinal as $item) {
            $typeBien->push($this->getTypeBien($item->id_annonce));
            $typeBienObj->push($this->getTypeBienObject($item->id_annonce));
            $typeAction->push($this->getTypeAction($item->id_annonce));
            $typeActionObj->push($this->getTypeActionObject($item->id_annonce));
            $image->push($this->getAnnonceImages($item->id_annonce));
        }
        return response()->json([
            'annonce' => $resultFinal ,
            'typebien' => $typeBien ,
            'typebienobj' => $typeBienObj ,
            'typeaction' => $typeAction ,
            'typeactionobj' => $typeActionObj ,
            'image' => $image ,
        ]);
    }

    public function showDetailsAnnonce(Request $request){
        $id = $request->id ;
        $annonce = Annonce::where('id_annonce','=',$id)->first();
        $typeAction = $this->getTypeAction($id);
        $typeActionObj = $this->getTypeActionObject($id);
        $typeBien = $this->getTypeBien($id);
        $typeBienObj = $this->getTypeBienObject($id);
        $imageAnnonce = $this->getAnnonceImages($id);
        return response()->json([
            'annonce' => $annonce ,
            'typeaction' => $typeAction ,
            'typeactionobj' => $typeActionObj ,
            'typebien' => $typeBien ,
            'typebienobj' => $typeBienObj ,
            'images' => $imageAnnonce ,
        ]);
    }

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
            $annonce = Annonce::where('id_annonce','=',$request->id_annonce)->first();
            $typeBien = $this->getTypeBien($request->id_annonce);
            $typeBienObj = $this->getTypeBienObject($request->id_annonce);
            $typeAction = $this->getTypeAction($request->id_annonce);
            $typeActionObj = $this->getTypeActionObject($request->id_annonce);
            $image00 = $this->getAnnonceImages($request->id_annonce)->get(0);
            $user = User::where('id_user','=',$annonce->user_id)->first();
            if ($annonce->mail != null)
                $mailExp = $annonce->mail;
            else
                $mailExp = $user->mail;
            \Mail::to($mailExp)->send(new CommandeMail($annonce,$typeBien,$typeBienObj,$typeAction,$typeActionObj,$image00,$user->username));
            $not = new Notification();
            $not->annonce_id = $request->id_annonce ;
            $not->user_id = $user->id_user ;
            $not->etat = 1 ;
            $not->save();
            return response()->json([
                'status' => 'Success',
                'message' => 'Votre commande a bien été envoyé',
                'message' => $image00,
            ]);
        }else{
            return response()->json([
                'status' => 'Erreur',
                'message' => $validator->errors(),
            ]);
        }
    }











}
