<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class profilController c'est le controller responsable du profil d'un user
 * @package App\Http\Controllers
 */
class profilController extends Controller
{
    public function afficherProfil(){
        return view('profil');
    }
    public function deconexion(){
        auth()->logout();
        return redirect('/connexion');
    }
    public function afficherModifierProfil(){
        return view('modifprofil');
    }

    /**
     * Cette méthode sert à modifier les données d'un user (mot de passe, email, name, avatar etc ...)
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function traitementmodifprofil(Request $request){
        $validate = Validator::make($request->all(), [
            'nommodif' => 'required|max:255|min:5',
            'emailmodif' => 'required|email|max:255',
            'passwordmodif' => 'confirmed|max:255',
            'passwordmodif_confirmation' => 'required_with:passwordmodif',
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:10240'
        ],[
            'avatar.image' => 'Le fichier que vous avez selectionné ne correspent pas à une image',
            'avatar.mimes' => 'L\'extension doit etre jpeg,png,jpg,gif,svg',
            'avatar.max' => 'la taille de l\'image ne doit pas dépasser 10Mo.'
        ]);
        if($validate->fails()){
            return back()->withErrors($validate)->withInput();
        }
        if(strlen(request('passwordmodif')) < 6 && request('passwordmodif')!=null && !empty(request('passwordmodif')))
            return back()->withErrors("Le mot de passe doit etre au min 6 caractères")->withInput();
        if (request('emailmodif') !== auth()->user()->email){
            $nb = User::where('email',request('emailmodif'))->count();
            if ($nb !== 0)
                return back()->withErrors('Cet addresse mail est déjà utilisée')->withInput();
        }
        $utilisateur = auth()->user();
        if (request('nommodif')!=null && !empty(request('nommodif')))
            $utilisateur->name = request('nommodif');
        if (request('emailmodif')!=null && !empty(request('emailmodif')))
            $utilisateur->email = request('emailmodif');
        if (request('passwordmodif')!=null && !empty(request('passwordmodif')))
            $utilisateur->password = bcrypt(request('passwordmodif'));
        if (request('avatar')!=null && !empty(request('avatar'))) {
            $avatarName = $utilisateur->id . '_avatar.' . request()->avatar->getClientOriginalExtension();
            $request->avatar->storeAs('avatars', $avatarName);
            $utilisateur->avatar = $avatarName;
        }
        $utilisateur->save();
        flash('Votre profil a bien été modifié')->success();
        return redirect('/profil');
    }

    public function supprimerAvatar(){
        auth()->user()->avatar = "default.jpg";
        auth()->user()->save();
        return redirect('/modifierprofil');
    }
}
