<?php

namespace App\Http\Controllers;

use App\Agence;
use App\ResetPassword;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

/**
 * @package App\Http\Controllers
 */
class ResetPasswordAgenceController extends Controller
{
    public function afficherEnterMail(){
        return view('resetpasswordagence.entermail');
    }
    public function afficherConfirmCode(){
        return view('resetpasswordagence.confirmcode');
    }
    public function afficherChangerPassword(){
        return view('resetpasswordagence.changerpassword');
    }

    public function resetPasswordFindMail(Request $request){
        $validate = Validator::make($request->all(),[
            'mailrecup' => 'required|email|max:255'
        ]);
        if($validate->fails()){
            return back()->withErrors($validate)->withInput();
        }
        $agence = Agence::where('email',request('mailrecup'))->first();
        if($agence){
            Session::put('id_agence',$agence->id_agence);
            $code = str_random(10);
            $dejamodif = ResetPassword::where('user_id',$agence->id_agence)->first();
            if ($dejamodif){
                $dejamodif->code = $code ;
                $dejamodif->save();
                \Mail::send('emails.reset_password_agence_mail',compact('dejamodif'),function ($message) use($agence){
                    $message->from('NotreSite@Immobilier.dz');
                    $message->to($agence->email);
                    $message->subject('Recupération de mot de passe');
                    $message->replyTo('NotreSite@Immobilier.dz');
                });
            }
            else{
                $resetpass = new resetPassword();
                $resetpass->user_id = $agence->id_agence ;
                $resetpass->code = $code ;
                $resetpass->save();
                \Mail::send('emails.reset_password_agence_mail',compact('resetpass'),function ($message) use($agence){
                    $message->from('NotreSite@Immobilier.dz');
                    $message->to($agence->email);
                    $message->subject('Recupération de mot de passe');
                    $message->replyTo('NotreSite@Immobilier.dz');
                });
            }
            return redirect('/resetpasswordagencepart2');
        }
        else{
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
        $count = ResetPassword::where('user_id',session('id_agence'))->where('code',request('coderecup'))->count();
        if($count != 0){
            return redirect('/resetpasswordagencepart3');
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
        $agence = Agence::find(\session('id_agence'));
        $agence->password = bcrypt(request('mdp'));
        $agence->save();
        return redirect('/loginagence');
    }
}
