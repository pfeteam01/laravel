@extends('layouts.app')
@section('content')
    <h1>Mon compte</h1>
    <h2>Bonjour {{ucfirst(auth()->user()->name)}}</h2>
    <br>

    <img src="storage/avatars/{{auth()->user()->avatar}}" width="400" height="400" />
    @auth
        <a href="{{  url("/deconnexion") }}">Deconnexion</a>
        <br><br>
        <a href="{{  url("/modifierprofil") }}">Modifier mon profil</a>
        <br><br>
        <a href="{{ url("/creerannonce") }}">Ajouter une annonce</a>
        <br><br>
    @else
        <a href="{{ url("/inscription") }} ">Inscription</a>
        <a href="{{url('/connexion')}}">Connexion</a>
    @endauth
@endsection
