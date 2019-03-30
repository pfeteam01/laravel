@extends('layouts.app',['title'=>'Récupération de mot de passe'])
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
    <form method="post" action="/verifcode">
        {{csrf_field()}}
        <div class="form-group">
            <label for="coderecup"> Entrez votre code :  </label>
            <input type="text" name="coderecup" id="coderecup">
        </div>
        <div class="form-group">
            <input type="submit" value="Envoyer le code d'activation">
        </div>
    </form>
@stop
