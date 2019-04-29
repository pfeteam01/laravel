<?php

namespace App\Http\Controllers;

use App\Agence;
use App\Mail\Register;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

/**
 * @package App\Http\Controllers
 *
 */
class UserRegisterController extends Controller
{
    //inscription
    public function afficherInscription(){
        return view('inscription');
    }

    //inscription
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
        $nb1 = User::where('mail',request('email'))->count();
        $nb2 = Agence::where('email','=',$request->email)->count();
        if ($nb1 !== 0 || $nb2 !== 0){
            return back()->withErrors('Cette addresse mail est déjà utilisée !!')->withInput();
        }
        $user = new User();
        $user->username = request('nom');
        $user->mail = request('email');
        $user->password = bcrypt(request('password'));
        $user->validation_token = urlencode(str_replace('/','Z',str_random(10)));
        $user->save();
        \Mail::to($user->mail)->send(new Register($user));
        return redirect('/connexion');
    }

    //confirm/{id}/{token}
    public function confirmer($id,$token){
        $user = User::where('id_user',$id)->where('validation_token',$token)->first();
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
