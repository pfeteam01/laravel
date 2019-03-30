@extends('layouts.app',['title'=>'Modifier le profil'])
@section('content')
    @if(count($errors) > 0)
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $e)
                    <li>{{ $e }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <h1>Modifier mon compte</h1>
    <form action="" method="post" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-group">
            <input type="text" name="nommodif" placeholder="Nom" value="{{auth()->user()->username}}" />
        </div>
        <div class="form-group">
            <input type="email" name="emailmodif" placeholder="Email" value="{{auth()->user()->mail}}" />
        </div>
        <div class="form-group">
            <input type="password" name="passwordmodif" placeholder="Mot de passe" />
        </div>
        <div class="form-group">
            <input type="password" name="passwordmodif_confirmation" placeholder="Confirmer le Mot de passe" />
        </div>

        <div class="form-group">
            <img src="avatars/{{auth()->user()->photo_de_profil}}" alt="" width="50" height="50"/>
            <input type="file" name="avatar" />
            <a href="{{url('/modifierprofil/supprimeravatar')}}">Supprimer l'avatar</a>
        </div>
        <input type="submit" value="Modifier le profil" />
    </form>
@endsection
