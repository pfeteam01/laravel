<?php

namespace App\Http\Controllers;

use App\Agence;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgenceLoginController extends Controller{

    public function showAgenceLoginForm(){
        return view('agence.login_agence');
    }

    public function loginAgence(Request $request){
        $rules = [
            'email' => 'required|email',
            'password' => 'required|min:6'
        ];
        $val = Validator::make($request->all(),$rules);
        if ($val->passes()){
            $agence = Agence::where('email','=',$request->email)->first();
            if ($agence){
                if (password_verify($request->password,$agence->password)){
                    if ($agence->is_activated == 1){
                        if ($request->remember){
                            auth()->guard('agence')->login($agence,true);
                        }else{
                            auth()->guard('agence')->login($agence,false);
                        }
                        return redirect('/profilAgence');
                    }else{
                        return back()->withErrors('Vous devez valider votre compte avant de pouvoir acceder à votre compte.');
                    }
                }else{
                    return back()->withErrors('votre mot de passe est incorrecte');
                }
            }else{
                return back()->withErrors('Vos identifiants sont incorrectes.');
            }
        }else{
            return back()->withErrors($val)->withInput();
        }
    }

}
