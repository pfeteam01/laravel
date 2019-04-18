@extends('layouts.app',['title'=>'Modifier l\'alerte'])
@section('content')
    <h1>Modifier une alerte</h1>
    <form method="post" action="{{url('/modifieralerte/'.$alerte->id_alerte)}}">
        {{csrf_field()}}
        <div class="form-group">
            <input type="text" class="form-control" placeholder="Wilaya" name="wilaya" value="{{$alerte->wilaya}}">
        </div>
        <div class="form-group">
            <input type="email" class="form-control" placeholder="Email" name="mail" value="{{$alerte->mail}}">
        </div>
        <div class="form-group">
            <select name="surfacemin">
                <option @if($alerte->surface_min == null) {{'selected'}} @endif value="smin">Surface Min</option>
                <option @if($alerte->surface_min == 25) {{'selected'}} @endif value="25">25 m2</option>
                <option @if($alerte->surface_min == 50) {{'selected'}} @endif value="50">50 m2</option>
                <option @if($alerte->surface_min == 75) {{'selected'}} @endif value="75">75 m2</option>
                <option @if($alerte->surface_min == 100) {{'selected'}} @endif value="100">100 m2</option>
                <option @if($alerte->surface_min == 125) {{'selected'}} @endif value="125">125 m2</option>
            </select>
        </div>
        <div class="form-group">
            <select name="surfacemax">
                <option @if($alerte->surface_max == 25) {{'selected'}} @endif value="25">25 m2</option>
                <option @if($alerte->surface_max == 50) {{'selected'}} @endif value="50">50 m2</option>
                <option @if($alerte->surface_max == 75) {{'selected'}} @endif value="75">75 m2</option>
                <option @if($alerte->surface_max == 100) {{'selected'}} @endif value="100">100 m2</option>
                <option @if($alerte->surface_max == 125) {{'selected'}} @endif value="125">125 m2</option>
                <option @if($alerte->surface_max == 150) {{'selected'}} @endif value="150">150 m2</option>
                <option @if($alerte->surface_max == null) {{'selected'}} @endif value="smax">Surface Max</option>
            </select>
        </div>
        <div class="form-group">
            <select name="lpmin">
                <option @if($alerte->lp_min == null) {{'selected'}} @endif value="pmin">Prix Min</option>
                <option @if($alerte->lp_min == 25) {{'selected'}} @endif value="25">25 DA</option>
                <option @if($alerte->lp_min == 50) {{'selected'}} @endif value="50">50 DA</option>
                <option @if($alerte->lp_min == 75) {{'selected'}} @endif value="75">75 DA</option>
                <option @if($alerte->lp_min == 100) {{'selected'}} @endif value="100">100 DA</option>
                <option @if($alerte->lp_min == 125) {{'selected'}} @endif value="125">125 DA</option>
            </select>
        </div>
        <div class="form-group">
            <select name="lpmax">
                <option @if($alerte->lp_max == 25) {{'selected'}} @endif value="25">25 DA</option>
                <option @if($alerte->lp_max == 50) {{'selected'}} @endif value="50">50 DA</option>
                <option @if($alerte->lp_max == 75) {{'selected'}} @endif value="75">75 DA</option>
                <option @if($alerte->lp_max == 100) {{'selected'}} @endif value="100">100 DA</option>
                <option @if($alerte->lp_max == 125) {{'selected'}} @endif value="125">125 DA</option>
                <option @if($alerte->lp_max == null) {{'selected'}} @endif value="pmax">Prix Max</option>
            </select>
        </div>
        <div class="form-group">
            <input @if($sesBiens->contains('appartement')) {{'checked'}} @endif name="appartement" type="checkbox" id="appartement"><label for="appartement">Appartement</label>
            <input @if($sesBiens->contains('maison')) {{'checked'}} @endif name="maison" type="checkbox" id="maison"><label for="maison">Maison</label>
            <input @if($sesBiens->contains('studio')) {{'checked'}} @endif name="studio" type="checkbox" id="studio"><label for="studio">Studio</label>
            <input @if($sesBiens->contains('terrain')) {{'checked'}} @endif name="terrain" type="checkbox" id="terrain"><label for="terrain">Terrain</label>
            <input @if($sesBiens->contains('garage')) {{'checked'}} @endif name="garage" type="checkbox" id="garage"><label for="garage">Garage</label>
        </div>
        <div class="form-group">
            <input @if($sesChambres->contains(1)) {{'checked'}} @endif name="p1" type="checkbox" id="p1"><label for="p1">1 pièce</label>
            <input @if($sesChambres->contains(2)) {{'checked'}} @endif name="p2" type="checkbox" id="p2"><label for="p2">2 pièces</label>
            <input @if($sesChambres->contains(3)) {{'checked'}} @endif name="p3" type="checkbox" id="p3"><label for="p3">3 pièces</label>
            <input @if($sesChambres->contains(4)) {{'checked'}} @endif name="p4" type="checkbox" id="p4"><label for="p4">4 pièces</label>
            <input @if($sesChambres->contains(5)) {{'checked'}} @endif name="p5" type="checkbox" id="p5"><label for="p5">5 pièces</label>
            <input @if($sesChambres->contains(6)) {{'checked'}} @endif name="p6" type="checkbox" id="p6"><label for="p6">6 pièces</label>
            <input @if($sesChambres->contains(7)) {{'checked'}} @endif name="p7" type="checkbox" id="p7"><label for="p7">7 pièces</label>
            <input @if($sesChambres->contains(8)) {{'checked'}} @endif name="p8" type="checkbox" id="p8"><label for="p8">8 pièces</label>
        </div>
        <div class="form-group">
            <input @if($sesActions->contains('vente')) {{'checked'}} @endif name="vente" type="checkbox" id="vente"><label for="vente">Vente</label>
            <input @if($sesActions->contains('location')) {{'checked'}} @endif name="location" type="checkbox" id="location"><label for="location">Location</label>
            <input @if($sesActions->contains('colocation')) {{'checked'}} @endif name="colocation" type="checkbox" id="colocation"><label for="colocation">Colocation</label>
        </div>
        <div class="form-group">
            <input class="btn btn-info" type="submit" value="Modifier l'annonce">
        </div>
    </form>
@stop
