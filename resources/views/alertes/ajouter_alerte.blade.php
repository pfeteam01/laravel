@extends('layouts.app',['title'=>'Ajouter une alerte'])
@section('content')
    <h2>Ajouter une alerte</h2>
    <form method="post" action="{{url('/ajouteralerte')}}">
        {{csrf_field()}}
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Wilaya" name="wilaya">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" placeholder="Email" name="mail">
        </div>
        <div class="form-group">
            <select name="surfacemin">
                <option selected value="smin">Surface Min</option>
                <option value="25">25 m2</option>
                <option value="50">50 m2</option>
                <option value="75">75 m2</option>
                <option value="100">100 m2</option>
                <option value="125">125 m2</option>
            </select>
        </div>
        <div class="form-group">
            <select name="surfacemax">
                <option value="25">25 m2</option>
                <option value="50">50 m2</option>
                <option value="75">75 m2</option>
                <option value="100">100 m2</option>
                <option value="125">125 m2</option>
                <option value="150">150 m2</option>
                <option selected value="smax">Surface Max</option>
            </select>
        </div>
        <div class="form-group">
            <select name="lpmin">
                <option selected value="pmin">Prix Min</option>
                <option value="25">25 DA</option>
                <option value="50">50 DA</option>
                <option value="75">75 DA</option>
                <option value="100">100 DA</option>
                <option value="125">125 DA</option>
            </select>
        </div>
        <div class="form-group">
            <select name="lpmax">
                <option value="25">25 DA</option>
                <option value="50">50 DA</option>
                <option value="75">75 DA</option>
                <option value="100">100 DA</option>
                <option value="125">125 DA</option>
                <option selected value="pmax">Prix Max</option>
            </select>
        </div>
        <div class="form-group">
            <input name="appartement" type="checkbox" id="appartement"><label for="appartement">Appartement</label>
            <input name="maison" type="checkbox" id="maison"><label for="maison">Maison</label>
            <input name="studio" type="checkbox" id="studio"><label for="studio">Studio</label>
            <input name="terrain" type="checkbox" id="terrain"><label for="terrain">Terrain</label>
            <input name="garage" type="checkbox" id="garage"><label for="garage">Garage</label>
        </div>
        <div class="form-group">
            <input name="p1" type="checkbox" id="p1"><label for="p1">1 pièce</label>
            <input name="p2" type="checkbox" id="p2"><label for="p2">2 pièces</label>
            <input name="p3" type="checkbox" id="p3"><label for="p3">3 pièces</label>
            <input name="p4" type="checkbox" id="p4"><label for="p4">4 pièces</label>
            <input name="p5" type="checkbox" id="p5"><label for="p5">5 pièces</label>
            <input name="p6" type="checkbox" id="p6"><label for="p6">6 pièces</label>
            <input name="p7" type="checkbox" id="p7"><label for="p7">7 pièces</label>
            <input name="p8" type="checkbox" id="p8"><label for="p8">8 pièces</label>
        </div>
        <div class="form-group">
            <input name="vente" type="checkbox" id="vente"><label for="vente">Vente</label>
            <input name="location" type="checkbox" id="location"><label for="location">Location</label>
            <input name="colocation" type="checkbox" id="colocation"><label for="colocation">Colocation</label>
        </div>
        <div class="form-group">
            <input type="submit" value="Envoyer">
        </div>
    </form>
@stop
