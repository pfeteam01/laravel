@extends('layouts.app',['title'=>'Inscription'])
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
    <form action="/inscription" method="post">
        {{csrf_field()}}
        <div class="form-group">
            <input type="text" name="nom" placeholder="Entrez votre nom" value="{{old('nom')}}">
        </div>
        <div class="form-group">
            <input type="email" name="email" placeholder="Email" value="{{old('email')}}">
        </div>
        <div class="form-group">
            <input type="password" name="password" placeholder="Mot de passe">
        </div>
        <div class="form-group">
            <input type="password" name="password_confirmation" placeholder="Confirmer le Mot de passe">
        </div>
        <input type="submit" value="Inscription">
    </form>
@endsection
