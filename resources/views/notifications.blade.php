@extends('layouts.app',['title'=>'Mes notifications'])
@section('content')
@foreach($mesNotifi as $not)
    @if($not->etat == 1)
        <div style="width: 900px;height: 175px; background-color: #e3342f; font-weight: bold;color: #1b1e21;">
            <p>Vous avez reçu une notification concernant l'annonce dont le id est: {{$not->annonce_id}}.</p>
            <p>Veuillez verifier votre boite mail afin d'en savoir plus.</p>
            {{--Apres on va personaliser la faàon d'affichage des notifications--}}
            <p>Il ya maintenant {{$not->created_at}}.</p>
            <a href="/chageetatnotification/{{$not->id_notification}}" class="btn btn-info" id="changeEtat">Marquer comme lue </a>
            <a href="/supprimernotification/{{$not->id_notification}}" class="btn btn-danger" id="supprimer-notification">Supprimer cette notification</a>
        </div>
        <br><br>
    @else
        <div style="width: 900px;height: 175px; background-color: #9561e2; font-weight: normal;color: #1b1e21;">
            <p>Vous avez reçu une notification concernant l'annonce dont le id est: {{$not->annonce_id}}.</p>
            <p>Veuillez verifier votre boite mail afin d'en savoir plus.</p>
            {{--Apres on va personaliser la faàon d'affichage des notifications--}}
            <p>Il ya maintenant {{$not->created_at}}.</p>
            <a href="/chageetatnotification/{{$not->id_notification}}" class="btn btn-info" id="changeEtat">Marquer comme non lue </a>
            <a href="/supprimernotification/{{$not->id_notification}}" class="btn btn-danger" id="supprimer-notification">Supprimer cette notification</a>
        </div>
        <br><br>
    @endif
@endforeach
@stop
