@extends('layouts.app',['title'=>'Profil Agence'])
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Agence Profile') }}</div>
                    <a href="{{url('/agenceprofil_update')}}"><h4>Modifier le profil de l'agence </h4></a> <br>
                    <a href="{{url('/deleteavataragence')}}"><h4>Supprimer l'avatar </h4></a> <br>
                    <a href="{{url('/deletebackgroundagence')}}"><h4>Supprimer la photo de background </h4></a> <br>
                    <a href="{{url('/logout')}}"><h4>Deconnexion</h4></a> <br>
                    <a href="{{url('/creerannonce')}}"><h4>Créer une annonce</h4></a> <br>
                    <div class="row justify-content-center">
                        <img style="width:500px; height:200px; float:left; border-radius:50%; margin-right:25px;"  src="background_agence/{{ auth()->guard('agence')->user()->background_img }} " />
                        <div class="profile-header-container">
                            Username: {{ Auth::guard('agence')->user()->name }} <hr>
                            Email: {{ Auth::guard('agence')->user()->email }} <hr>
                            Description: {{ Auth::guard('agence')->user()->description }} <hr>
                            Wilaya: {{ Auth::guard('agence')->user()->wilaya }} <hr>
                            Adresse: {{ Auth::guard('agence')->user()->adresse }} <hr>
                            Web Site: {{ Auth::guard('agence')->user()->web_site }} <hr>
                            <div class="profile-header-img">
                                <img style="width:180px; height:200px; float:left; border-radius:50%; margin-right:25px;" class="rounded-circle" src="avatar_agence/{{ auth()->guard('agence')->user()->avatar }} " />
                            </div>
                        </div>
                    </div>
                    <div class="row justify-content-center">
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
