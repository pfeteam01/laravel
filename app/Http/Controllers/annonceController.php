<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\annonce;
use logdb;
use File;

/**
 * Class annonceController gère les annonces
 * @package App\Http\Controllers
 */
class annonceController extends Controller
{
    /**
     * elle afficher la vue qui permet de créer une annonce
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function create()
    {
        return view('annonce.create');
    }

    /**
     * elle créer et sauvegardre une nouvelle annonce
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'titre' => 'required|min:5',
            'description' => 'required',
            'adresse' => 'required',
            'prix' => 'required',
            'cover_image' => 'image|max:1999'
        ]);
        if($request->hasFile('cover_image')){
            $img_name = time(). '.' . $request->cover_image->getClientOriginalExtension();
            $request->cover_image->move(public_path('cover_img'),$img_name);
        }
        else{
            $img_name =  'noimage.jpg';
        }
        $annonce = new annonce;
        $annonce->titre = $request->input('titre');
        $annonce->description = $request->input('description');
        $annonce->adresse = $request->input('adresse');
        $annonce->prix = $request->input('prix');
        $annonce->cover_image = $img_name;
        $annonce->user_id = auth()->user()->id;
        $annonce->save();
        return redirect('/Annonces')->with('success', 'annonce Created');
    }

    /**
     * Elle affiche toute les annonces
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index(){
        $annonces = annonce::orderBy('created_at','desc')->paginate(10);
        return view('annonce.index')->with('annonces', $annonces);
    }

    /**
     * elle retourne la vue qui affiche les détails d'une annonce
     * @param $id => C'est le id de l'annonce
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function show($id)
    {
        $annonce = annonce::find($id);
        return view('annonce.show')->with('annonce', $annonce);
    }

    /**
     * Elle sert à supprimer l'annonce d'un utilisateur qui est son propriétaire.
     * @param $id => C'est le id de l'annonce
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $annonce = annonce::find($id);
        // Check for correct user
        if(auth()->user()->id !== $annonce->user_id){
            return redirect('/Annonces')->with('error', 'Unauthorized Page');
        }
        if($annonce->cover_image != 'noimage.jpg'){
            //'cover_img/'.$annonce->cover_image::delete();
            // Delete Image
            //Storage::delete('public/cover_img/'.$annonce->cover_image);
            $cover_img = 'cover_img/'.$annonce->cover_image;
            File::delete($cover_img.'/your_file');
        }
        $annonce->delete();
        return redirect('/Annonces')->with('success', 'Post Removed');
    }

    /**
     * Elle sert à afficher la vue qui nous permettra de modifier une annonce
     * @param $id => C'est le id de l'annonce
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $annonce = annonce::find($id);
        return view('annonce.edit')->with('annonce', $annonce);
    }

    /**
     * Elle sert à modifier l'annonce
     * @param Request $request
     * @param $id => C'est le id de l'annonce
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'titre' => 'required|min:5',
            'description' => 'required',
            'adresse' => 'required',
            'prix' => 'required|integer',
            'cover_image' => 'image|max:1999'
        ]);
        // Handle File Upload
        if($request->hasFile('cover_image')){
            $img_name = time(). '.' . $request->cover_image->getClientOriginalExtension();
            $request->cover_image->move(public_path('cover_img'),$img_name);
        }
        else{
            $img_name =  'noimage.jpg';
        }
        // Create Post
        $annonce = annonce::find($id);
        $annonce->titre = $request->input('titre');
        $annonce->description = $request->input('description');
        $annonce->adresse = $request->input('adresse');
        if($request->hasFile('cover_image')){
            $annonce->cover_image = $img_name;
        }
        $annonce->save();
        return redirect('/Annonces')->with('success', 'Annonce modifiee');
    }

    /*public function commander($id)
    {
        $annonce = annonce::find($id);
        return view('annonce.commander')->with('annonce', $annonce);
    }*/
}
