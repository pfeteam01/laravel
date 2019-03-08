@extends('layouts.app')
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
    <form method="post" action="/changerpassword">
        {{csrf_field()}}
        <div class="form-group">
            <label for="mdp">Entrez votre nouveau mot de passe:  </label>
            <input type="password" name="mdp" id="mdp">
        </div>
        <div class="form-group">
            <label for="mdp_confirmation">Confirmer votre nouveau mot de passe: </label>
            <input type="password" name="mdp_confirmation" id="mdp_confirmation">
        </div>
        <div class="form-group">
            <input type="submit" value="Changer le mot de passe">
        </div>
    </form>
@stop