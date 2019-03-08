<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use App\resetPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

/**
 * Class ResetPasswordController c'est le controller responsable de recuperer les mots de passe oubliés
 * @package App\Http\Controllers
 */
class ResetPasswordController extends Controller
{
    public function afficherEnterMail(){
        return view('resetpassword.entermail');
    }
    public function afficherConfirmCode(){
        return view('resetpassword.confirmcode');
    }
    public function afficherChangerPassword(){
        return view('resetpassword.changerpassword');
    }


    /**
     * cette méthode verifie que l'addresse email est valide et existe déjà puis elle génère un code et l'insère dans la table "resetPassword" puis l'envoie par mail à la bonne adresse puis elle change de page
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function resetPasswordFindMail(Request $request){
        $validate = Validator::make($request->all(),[
            'mailrecup' => 'required|email|max:255'
        ]);
        if($validate->fails()){
            return back()->withErrors($validate)->withInput();
        }
        $user = User::where('email',request('mailrecup'))->first();
        if($user){
            Session::put('id',$user->id);
            $code = str_random(10);
            $dejamodif = resetPassword::where('user_id',$user->id)->first();
            if ($dejamodif){
                $dejamodif->code = $code ;
                $dejamodif->save();
                \Mail::to($user->email)->send(new ResetPasswordMail($dejamodif));
            }else{
                $resetpass = new resetPassword();
                $resetpass->user_id = $user->id;
                $resetpass->code = $code ;
                $resetpass->save();
                \Mail::to($user->email)->send(new ResetPasswordMail($resetpass));
            }
            return redirect('/resetpasswordpart2');
        }else{
            return back()->withErrors('Cet email n\'existe pas');
        }
    }

    /**
     * cette méthode vérifie si il existe un tuple dans la table resetpassword dont le id est le id du user et dont le code correspend au code entré, si c'est le cas l'user sera redirigé vers une page pour changer de mot de passe
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function resetPasswordVerifCode(Request $request){
        $validate = Validator::make($request->all(),[
            'coderecup' => 'required|max:10'
        ]);
        if($validate->fails()){
            return back()->withErrors($validate)->withInput();
        }
        $count = ResetPassword::where('user_id',session('id'))->where('code',request('coderecup'))->count();
        if($count != 0){
            return redirect('/resetpasswordpart3');
        }else{
            return back()->withErrors("Code Erroné, veuillez réessayer");
        }
    }

    /**
     * cette méthode sert tout simplement pour trouver le bon user et lui faire changer de mot de passe puis on redirige le user vvers la page connexion
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function resetPasswordChangerPassword(Request $request){
        $validate = Validator::make($request->all(),[
            'mdp' => 'required|min:6|confirmed',
            'mdp_confirmation' => 'required'
        ]);
        if($validate->fails()){
            return back()->withErrors($validate)->withInput();
        }
        $utilisateur = User::find(\session('id'));
        $utilisateur->password = bcrypt(request('mdp'));
        $utilisateur->save();
        return redirect('/connexion');
    }
}
