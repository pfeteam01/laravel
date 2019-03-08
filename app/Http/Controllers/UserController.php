<?php

namespace App\Http\Controllers;

use App\Mail\Register;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * Class userController: c'est le controller responsable de l'inscription
 * @package App\Http\Controllers
 *
 */
class userController extends Controller
{
    public function afficherInscription(){
        return view('inscription');
    }

    /**
     * cette méthode sert à créer un nouvelle utilisateur et envoie un mail afin que le user puisse valider son compte
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function creerUser(Request $request) {
        $validate = Validator::make($request->all(),[
            'email' => 'required|email|max:255',
            'password' => 'required|string|min:6|confirmed|max:255',
            'password_confirmation' => 'required',
            'nom' => 'required|max:255|min:5',
        ]);
        if($validate->fails()){
            return back()->withErrors($validate)->withInput();
        }
        $nb = User::where('email',request('email'))->count();
        if ($nb!==0){
            return back()->withErrors('Cet addresse mail est déjà used')->withInput();
        }
        $user = new User();
        $user->name = request('nom');
        $user->email = request('email');
        $user->password = bcrypt(request('password'));
        $user->validation_token = urlencode(str_replace('/','Z',str_random(10)));
        $user->save();
        \Mail::to($user->email)->send(new Register($user));
        return redirect('/connexion');
    }

    /**
     * cette méthode sert à confirmer le compte de l'utilsateur dont son id est $id et mettre son champs validation_token à NULL
     * @param $id => c'est le id de l'utilisateur
     * @param $token => c'est le validation_token du l'utilsateur
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function confirmer($id,$token){
        $user = User::where('id',$id)->where('validation_token',$token)->first();
        if ($user){
            $user->validation_token = null ;
            $user->save();
            auth()->login($user);
            return redirect('/profil');
        }else{
            return redirect('/connexion')->withErrors("Il semble qu'il ait un problème dans la validaation 
            de votre compte");
        }
    }
}
