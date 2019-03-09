@extends('layouts.app')
@section('content')
<div class="col-lg-8">
    <a href="/Annonces" class="btn btn-default">Retour</a>
    <h1>{{$annonce->titre}}</h1>
    <div>
        {!!$annonce->description!!}
    </div>
    <hr>
    <small>{{$annonce->adresse}}</small>
    <hr>
    <small>Publie le  {{$annonce->created_at}} par {{$annonce->user->name}}</small>
    <hr>
    <small>Publie par {{$annonce->user->name}}</small>
    <hr>
     @if(!Auth::guest())
        @if(Auth::user()->id == $annonce->user_id)
            <a href="/Annonces/{{$annonce->id}}/edit" class="btn btn-default">Modifier</a>

            {!!Form::open(['action' => ['annonceController@destroy', $annonce->id], 'method' => 'POST', 'class' => 'pull-right'])!!}
                {{Form::hidden('_method', 'DELETE')}}
                {{Form::submit('Supprimer', ['class' => 'btn btn-default'])}}
            {!!Form::close()!!}
        @else
            <a href="/Annonces/{{$annonce->id}}/commander" class="btn btn-default">Commander</a>

        @endif
    @endif
</div>
    @endsection
