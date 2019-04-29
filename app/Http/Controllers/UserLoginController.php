<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Support\Facades\Validator ;
use Illuminate\Http\Request;

/**
 * @package App\Http\Controllers
 */
class UserLoginController extends Controller
{
    //connexion
    public function afficherConnexion(){
        return view('connexion');
    }

    //connexion
    public function connect(Request $request){
        $validate = Validator::make($request->all(),[
            'emailconnect' => 'required',
            'passwordconnect' => 'required'
        ]);
        if($validate->fails()){
            return back()->withErrors($validate)->withInput();
        }
        $user = User::where('mail',request('emailconnect'))->first();
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
