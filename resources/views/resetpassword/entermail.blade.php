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
    <form method="post" action="/resetpassword">
        {{csrf_field()}}
        <div class="form-group">
            <label for="mailrecup" >Veuillez entrer votre Email: </label>
            <input type="email" name="mailrecup" id="mailrecup">
        </div>
        <div class="form-group">
            <input type="submit" value="Envoyer le code d'activation">
        </div>
    </form>
@stop