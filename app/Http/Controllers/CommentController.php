<?php

namespace App\Http\Controllers;

use App\Agence;
use App\AgenceComment;
use App\Comment;
use App\Notification;
use App\NotificationAgence;
use App\NotificationUser;
use App\User;
use App\UserComment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator ;

class CommentController extends Controller
{
    private function addNotification($id_annonce){
        $notifi = new Notification() ;
        $notifi->annonce_id = $id_annonce ;
        $notifi->etat = 1 ;
        $notifi->texte = "Un abonné vient de commenter une de vos annonces" ;
        $notifi->save() ;
        $id = $notifi->id_notification ;
        if (auth()->check()){
            $notifi = new NotificationUser();
            $notifi->id_notification = $id ;
            $notifi->user_id = auth()->user()->id_user ;
            $notifi->save();
        }
        elseif (auth()->guard('agence')->check()){
            $notifi = new NotificationAgence();
            $notifi->id_notification = $id ;
            $notifi->agence_id = auth()->guard('agence')->user()->id_agence ;
            $notifi->save();
        }
    }
    public function store(Request $request){
        $validate = Validator::make($request->all(),[
            'body_comment' => 'required|min:5',
        ]);
        if ($validate->passes()){
            $comment = new Comment();
            $comment->annonce_id = $request->annonce_id;
            $comment->body_comment = $request->body_comment;
            $comment->save();
            if (auth()->check()){
                $user_comment = new UserComment();
                $user_comment->id_comment = $comment->id_comment ;
                $user_comment->user_id = auth()->user()->id_user ;
                $user_comment->save();
            }
            elseif (auth()->guard('agence')->check()){
                $agence_comment = new AgenceComment();
                $agence_comment->id_comment = $comment->id_comment ;
                $agence_comment->agence_id = auth()->guard('agence')->user()->id_agence ;
                $agence_comment->save();
            }
            $this->addNotification($request->annonce_id);
            return response()->json([
                'status' => 'Success',
                'message' => 'Votre commantaire a bien été inséré' ,
            ]);
        }
        else{
            return response()->json([
                'status' => 'Errors',
                'message' => $validate->errors() ,
	        ]);
        }
    }

    private function getSonPropType($id){
        $prop = UserComment::where('id_comment','=',$id)->first();
        if ($prop == null){
            return 'agence' ;
        }
        else{
            return 'user' ;
        }
    }
    private function getSonPropObjet($id){
        $prop = UserComment::where('id_comment','=',$id)->first();
        if ($prop == null){
            $prop = AgenceComment::where('id_comment','=',$id)->first();
            $idProp =  $prop->agence_id ;
            $propObjet = Agence::where('id_agence','=',$idProp)->first();
            return $propObjet ;
        }
        else{
            $idProp =  $prop->user_id ;
            $propObjet = User::where('id_user','=',$idProp)->first();
            return $propObjet ;
        }
    }
    public function showAllComments(Request $request){
        $id_annonce = 25 ; //$request->id_annonce ;
        $commentsOfAnnonce = Comment::where('annonce_id','=',$id_annonce)->get();
        $propObjetOfComments = collect([]);
        $propTypeOfComments = collect([]);
        for($i=0;$i<$commentsOfAnnonce->count();$i++){
            $sonPropObjet = $this->getSonPropObjet($commentsOfAnnonce->get($i)->id_comment);
            $propObjetOfComments->push($sonPropObjet);
            $sonPropType = $this->getSonPropType($commentsOfAnnonce->get($i)->id_comment);
            $propTypeOfComments->push($sonPropType);
        }
//        dump($commentsOfAnnonce);
//        dump($propObjetOfComments);
//        dd($propTypeOfComments);
        return response()->json([
            'comments' => $commentsOfAnnonce ,
            'propObjetOfComments' => $propObjetOfComments ,
            'propTypeOfComments' => $propTypeOfComments ,
        ]);
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
    public function showMyComments(){
        $idUserConnect = $this->getAuthId() ;
        $guard = $this->getAuthGuard() ;
        $tabComments = collect([]);
        if ($guard == 'web'){
            $comments = UserComment::where('user_id','=',$idUserConnect)->get();
            for ($i=0;$i<$comments->count();$i++){
                $myComments = Comment::where('id_comment','=',$comments->get($i)->id_comment)->first();
                $tabComments->push($myComments);
            }
        }
        elseif ($guard == 'agence'){
            $comments = AgenceComment::where('agence_id','=',$idUserConnect)->get();
            for ($i=0;$i<$comments->count();$i++){
                $myComments = Comment::where('id_comment','=',$comments->get($i)->id_comment)->first();
                $tabComments->push($myComments);
            }
        }
//        dd($tabComments);
        return response()->json([
            'tabComments' => $tabComments ,
        ]);
    }

    public function edit($id){
        $comment = Comment::where('id_comment','=',$id)->first()->body_comment ;
        return view('editComment',compact('comment','id'));
    }

    private function checkIfCommentIsMine($id_comment,$id_Personne){
        $guard = $this->getAuthGuard();
        if ($guard == 'user'){
            $count = UserComment::where('user_id','=',$id_Personne)->where('id_comment','=',$id_comment)->count();
            if ($count == 0)
                return false ;
            else
                return true ;
        }
        elseif($guard == 'agence'){
            $count = AgenceComment::where('agence_id','=',$id_Personne)->where('id_comment','=',$id_comment)->count();
            if ($count == 0)
                return false ;
            else
                return true ;
        }
    }
    public function update(Request $request, $id){
        $validate = Validator::make($request->all(),[
            'body_comment' => 'required|min:5',
        ]);
        $idPersonneConnect = $this->getAuthId();
        if ($validate->passes()){
            if ($this->checkIfCommentIsMine($id, $idPersonneConnect)) {
                $comment = Comment::find($id);
                $comment->body_comment = $request->body_comment;
                $comment->save();
                return redirect('/affichermodifcomment/'.$id)->with('success', 'comment Modified');
            }
            else{
                return back()->withErrors("Vous n'avez pas le droit d'accéder à cette page !!!")->withInput();
            }
        }
        else{
            return back()->withErrors($validate)->withInput();
        }
    }

    public function delete($id){
        $idPersonneConnect = $this->getAuthId();
        if ($this->checkIfCommentIsMine($id, $idPersonneConnect)) {
            $comment = Comment::find($id);
            if(auth()->check()){
                $user_comment = UserComment::find($id);
                $user_comment->delete();
            }
            elseif(auth()->guard('agence')->check()){
                $agence_comment = AgenceComment::find($id);
                $agence_comment->delete();
            }
            $comment->delete();
            //return redirect('/profil')->with('success', 'comment Deleted');
        }
        else{
            //return back()->withErrors('Vous n\'avez pas le droit');
        }
    }

}
