@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Annonce</h1>
    @if(count($annonces) > 0)
        @foreach($annonces as $annonce)
            <div class="well">
                <div class="row">
                    <div class="col-md-8 col-sm-8">
                        <h3><a href="/Annonces/{{$annonce->id}}">{{$annonce->titre}}</a></h3>
                        <small>publie {{$annonce->created_at}} par {{$annonce->user->name}} </small> 
                        <div class="col-md-4 col-sm-4">
                                @if ($annonce->cover_image)
                                    <img style="height:150px; width: 200px"  src="cover_img/{{$annonce->cover_image}}"> 
                                    <hr style="height: 5px; width: 150px"> 
                                @endif 
                            </div>
                    </div>
                </div>
            </div>
        @endforeach
        {{$annonces->links()}}
    @else
        <p>No annonce found</p>
    @endif
</div>
@endsection
