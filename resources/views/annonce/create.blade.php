@extends('layouts.app')

@section('content')

<h1>Deposer annonce</h1>
<div class="row justify-content-center">

    {!! Form::open(['action' => 'annonceController@store', 'method' => 'POST', 'enctype' => 'multipart/form-data']) !!}

        <div class="form-group">
            {{Form::label('titre', 'titre')}}
            {{Form::text('titre', '', ['class' => 'form-control', 'placeholder' => 'titre'])}}
        </div>
        <div class="form-group">
            {{Form::label('description', 'description')}}
            {{Form::textarea('description', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'description'])}}
        </div>

       <div class="form-group">
            {{Form::label('adresse', 'adresse')}}
            {{Form::text('adresse', '', ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'adresse (alger)'])}}
        </div>

       <div class="form-group">
            {{Form::label('prix', 'prix')}}
            {{Form::text('prix', '', ['class' => 'form-control', 'placeholder' => 'prix ($)'])}}
        </div>
        @include('inc/messages')
   
        <div class="form-group">
            {{Form::file('cover_image')}}
        </div>

        {{Form::submit('Valider', ['class'=>'btn btn-primary'])}}
    {!! Form::close() !!}
</div>
<?php
        /*  $commune = array('Alger-Centre','Sidi M\'Hamed','El Madania','Belouizdad','Bab El Oued','Bologhine','Casbah','Oued Koriche','Bir Mourad Raïs','El Biar','Bouzareah','Birkhadem','El Harrach','Baraki ','Oued Smar','Bachdjerrah','Hussein Dey','Kouba','Bourouba','Dar El Beïda','Bab Ezzouar','Ben Aknoun','Dely Ibrahim','El Hammamet','Raïs Hamidou','Djasr Kasentina','El Mouradia','Hydra','Mohammadia','Bordj El Kiffan ','El Magharia','Beni Messous','Les Eucalyptus','Birtouta','Tessala El Merdja','Ouled Chebel','Sidi Moussa','Aïn Taya','Bordj El Bahri','El Marsa','H\'Raoua','Rouïba','Reghaïa','Aïn Benian','Staoueli','Zeralda','Mahelma','Rahmania','Souidania','Cheraga','Ouled Fayet','El Achour','Draria','Douera','Baba Hassen','Khraicia','Saoula');*/

       /* $commune = array('Alger-Centre' => 'Alger-Centre' , 'El Madania' => 'El Madania');
              {!! Form::select('commune', $commune, null, ['class' => 'form-control']) !!} */

              
          
 ?>

@endsection
