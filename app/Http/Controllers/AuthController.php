<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Support\Facades\Validator ;
use Illuminate\Http\Request;

/**
 * Class authController: c'est le controller qui s'occupe du login d'un user
 * @package App\Http\Controllers
 */
class authController extends Controller
{
    public function afficherConnexion(){
        return view('connexion');
    }

    /**
     * elle vérifie la validité du formulaire ainsi que l'existance du l'user via son email et mot de passe puis verifie la validité du compte en se basant sur le champs token_validation si oui ou non il est égale à NULL ou nn puis verifie la case à cocher, pour enfin laisser l'user se connecter
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function connect(Request $request){
        $validate = Validator::make($request->all(),[
            'emailconnect' => 'required',
            'passwordconnect' => 'required'
        ]);
        if($validate->fails()){
            return back()->withErrors($validate)->withInput();
        }
        $user = User::where('email',request('emailconnect'))->first();
        if($user){
            if(password_verify(request('passwordconnect'),$user->password)) {
                if ($user->validation_token !== null){
                    return back()->withErrors("Vous devez valider votre compte avant de pouvoir vous connecter")->withInput();
                }
                else{
                    if(request('remember'))
                        auth()->login($user,true);
                    else
                        auth()->login($user,false);
                    return redirect('/profil');
                }
            }
        }
        return back()->withInput()->withErrors([
            "email" => "Identifiants Erronés"
        ]);
    }
}
