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
    <form action="" method="post">
        {{csrf_field()}}
        <div class="form-group {{$errors->has('emailconnect')}}">
            <input type="email" name="emailconnect" placeholder="Email" value="{{old('emailconnect')}}">
        </div>
        <div class="form-group {{$errors->has('passwordconnect')}}">
            <input type="password" name="passwordconnect" placeholder="Mot de passe" value="{{old('passwordconnect')}}">
        </div>
        <div class="form-group {{$errors->has('remember')}}">
            <label for="remember">Se souvenir de moi</label>
            <input type="checkbox" name="remember" id="remember">
        </div>
        <input type="submit" value="Login">
        <br>
        <br>
        <a href="{{url('/resetpasswordpart1')}}">Mot de passe oublié ?</a>
    </form>
@stop