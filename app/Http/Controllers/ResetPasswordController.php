<?php

namespace App\Http\Controllers;

use App\Mail\ResetPasswordMail;
use App\ResetPassword;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

/**
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

    public function resetPasswordFindMail(Request $request){
        $validate = Validator::make($request->all(),[
            'mailrecup' => 'required|email|max:255'
        ]);
        if($validate->fails()){
            return back()->withErrors($validate)->withInput();
        }
        $user = User::where('mail',request('mailrecup'))->first();
        if($user){
            Session::put('id',$user->id_user);
            $code = str_random(10);
            $dejamodif = ResetPassword::where('user_id',$user->id_user)->first();
            if ($dejamodif){
                $dejamodif->code = $code ;
                $dejamodif->save();
                \Mail::to($user->email)->send(new ResetPasswordMail($dejamodif));
            }else{
                $resetpass = new resetPassword();
                $resetpass->user_id = $user->id_user;
                $resetpass->code = $code ;
                $resetpass->save();
                \Mail::to($user->mail)->send(new ResetPasswordMail($resetpass));
            }
            return redirect('/resetpasswordpart2');
        }else{
            return back()->withErrors('Cet email n\'existe pas');
        }
    }

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
