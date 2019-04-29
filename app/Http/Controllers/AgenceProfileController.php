<?php

namespace App\Http\Controllers;

use App\Agence;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AgenceProfileController extends Controller
{
    public function showAgenceProfile()
    {
        return view('agence.profile_agence');
    }

    public function showAgenceUpdateProfile()
    {
        return view('agence.edit_profile_agence');
    }

    //Ici on concidère que loukane un champs n'est pas rempli cv generer une erreur .
    public function updateAgence(Request $request)
    {
        $rules = [
            'avatar' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'background_img' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'name' =>'required',
            'email' =>'required|email',
            'description' =>'required',
            'wilaya' =>'required',
            'adresse' =>'required',
            'web_site' =>'required',
            'password' => 'confirmed',
            'password_confirmation' =>'required_with:password',
        ];
        $val  = Validator::make($request->all(),$rules);
        if ($val->fails()){
            return back()->withErrors($val)->withInput();
        }
        $agence = Auth::guard('agence')->user();
        if(strlen($request->password) < 6 && $request->password != null)
            return back()->withErrors("Le mot de passe doit etre au min 6 caractères")->withInput();
        if ($request->email !== $agence->email){
            $nb1 = User::where('mail',request('email'))->count();
            $nb2 = Agence::where('email','=',$request->email)->count();
            if ($nb1 !== 0 || $nb2 !== 0){
                return back()->withErrors('Cette addresse mail est déjà utilisée !!')->withInput();
            }
        }
        if($request->hasFile('avatar')){
            $avatarName = $agence->id_agence.'_avatar'.time().'.'.request()->avatar->getClientOriginalExtension();
            $request->avatar->move(public_path('avatar_agence'),$avatarName);
            $agence->avatar = $avatarName ;
        }
        if($request->hasFile('background_img')){
            $backgroundName = $agence->id.'_background_img'.time().'.'.request()->background_img->getClientOriginalExtension();
            $request->background_img->move(public_path('background_agence'),$backgroundName);
            $agence->background_img = $backgroundName ;
        }
        $agence->name = $request->name;
        $agence->email = $request->email;
        $agence->description = $request->description;
        $agence->wilaya = $request->wilaya;
        $agence->adresse = $request->adresse;
        $agence->web_site = $request->web_site;
        if ($request->password != null && !empty($request->password)){
            $agence->password = bcrypt($request->password);
        }
        $agence->save();
        return redirect('/profilAgence')->with('success','votre profile a bien été modifié');
    }

    public function logoutAgence()
    {
        Auth::guard('agence')->logout();
        return redirect('/loginagence');
    }

    public function deleteAvatarAgence(){
        $id = auth()->guard('agence')->user()->id_agence ;
        $agence = Agence::where('id_agence','=',$id)->first();
        if ($agence){
            $path = 'avatar_agence/'.$agence->avatar ;
            if (File::exists($path)){
                File::delete($path);
            }
            $agence->avatar = 'default_avatar_agence.jpg';
            $agence->save();
        }
        return redirect('/profilAgence');
    }
    public function deleteBackgroundAgence(){
        $id = auth()->guard('agence')->user()->id_agence ;
        $agence = Agence::where('id_agence','=',$id)->first();
        if ($agence){
            $path = 'background_agence/'.$agence->background_img ;
            if (File::exists($path)){
                File::delete($path);
            }
            $agence->background_img = 'default_background_image_agence.jpg';
            $agence->save();
        }
        return redirect('/profilAgence');
    }
}
