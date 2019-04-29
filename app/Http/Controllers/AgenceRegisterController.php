<?php

namespace App\Http\Controllers;

use App\Agence;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AgenceRegisterController extends Controller
{
    public function showAgenceRegisterForm()
    {
        return view('agence.register_agence');
    }

    public function createAgence(Request $request)
    {
        $rules = [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:agences',
            'password' => 'required|string|min:6|confirmed',
            'adresse' => 'required',
            'wilaya' => 'required',
            'web_site' => 'required',
            'description' => 'required',
        ] ;
        $val = Validator::make($request->all(),$rules);
        if ($val->fails()){
            return back()->withErrors($val)->withInput();
        }
        else{
            $nb1 = User::where('mail',request('email'))->count();
            $nb2 = Agence::where('email','=',$request->email)->count();
            if ($nb1 !== 0 || $nb2 !== 0){
                return back()->withErrors('Cette addresse mail est déjà utilisée !!')->withInput();
            }
            else{
                $ag = new Agence();
                $ag->name = $request->name ;
                $ag->email = $request->email ;
                $ag->description = $request->description ;
                $ag->wilaya = $request->wilaya ;
                $ag->adresse = $request->adresse ;
                $ag->web_site = $request->web_site ;
                $ag->password = bcrypt($request->password) ;
                $ag->is_activated = 0 ;
                $ag->save();
                \Mail::send('emails.register_agence_mail',compact('ag'),function ($message) use($request){
                    $message->from('NotreSite@Immobilier.dz');
                    $message->to($request->email);
                    $message->subject('Confirmation de votre compte.');
                    $message->replyTo('NotreSite@Immobilier.dz');
                });
                return redirect('/loginagence');
            }
        }
    }

    public function confirmAgenceMail($id)
    {
        $agence = Agence::where('id_agence','=',$id)->first();
        if ($agence){
            $agence->is_activated = 1 ;
            $agence->save();
            auth()->guard('agence')->login($agence);
            return redirect('/profilAgence');
        }
        else{
            return redirect('/loginagence')->withErrors('Une erreur a été comit lors de la confirmation par mail');
        }
    }
}
