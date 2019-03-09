<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\annonce;
use logdb;
use File;

class annonceController extends Controller
{
    public function create()
    {
        return view('annonce.create');
    }

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

    public function index(){
        $annonces = annonce::orderBy('created_at','desc')->paginate(10);
        return view('annonce.index')->with('annonces', $annonces);
    }

    public function show($id)
    {
        $annonce = annonce::find($id);
        return view('annonce.show')->with('annonce', $annonce);
    }

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

    public function edit($id)
    {
        $annonce = annonce::find($id);
        return view('annonce.edit')->with('annonce', $annonce);
    }

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

    public function commander($id)
    {
        $annonce = annonce::find($id);
        return view('annonce.commander')->with('annonce', $annonce);
    }

}
