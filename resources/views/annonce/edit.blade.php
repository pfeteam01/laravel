@extends('layouts.app')
@section('content')
<div class="content">
    <h2>Modifier annonce</h2>
    <hr>
    <a href="/Annonces/{{$annonce->id}}" class="btn btn-default">Retour</a>
    <div class="row justify-content-center">
        {!! Form::open(['action' => ['annonceController@update',$annonce->id],
        'method' => 'POST',
        'enctype' => 'multipart/form-data']) !!}
            <div class="form-group">
                {{Form::label('titre', 'titre')}}
                {{Form::text('titre', $annonce->titre, ['class' => 'form-control', 'placeholder' => 'titre'])}}
            </div>
            <div class="form-group">
                {{Form::label('description', 'description')}}
                {{Form::textarea('description',$annonce->description,
                ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'description'])}}
            </div>
           <div class="form-group">
                {{Form::label('adresse', 'adresse')}}
                {{Form::text('adresse',$annonce->adresse, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'adresse (alger)'])}}
            </div>
        <div class="form-group">
            {{Form::label('prix', 'prix')}}
            {{Form::number('prix',$annonce->prix, ['id' => 'article-ckeditor', 'class' => 'form-control', 'placeholder' => 'Prix'])}}
        </div>
           @include('inc/messages')
            <div class="form-group">
                {{Form::file('cover_image')}}
            </div>
            {{form::hidden('_method','PUT')}}
            {{Form::submit('Valider', ['class'=>'btn btn-primary'])}}
        {!! Form::close() !!}
    </div>
</div> 
@endsection
