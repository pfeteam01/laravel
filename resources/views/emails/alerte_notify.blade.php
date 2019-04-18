@extends('layouts.app',['title' => ''])
@section('content')
<h1>Salutation</h1>
<h2>Un annonçateur vient de déposer une annonce qui a l'air de correspendre à vos critères d'une de vos alertes.</h2>

<p>{{$alerte->id_alerte}}</p>
<p>{{$alerte->wilaya}}</p>
<p>{{$alerte->mail}}</p>
<p>{{$alerte->surface_min}}</p>
<p>{{$alerte->surface_max}}</p>
<p>{{$alerte->etat_alerte}}</p>
<p>{{$alerte->lp_min}}</p>
<p>{{$alerte->lp_max}}</p>
<p>{{$alerte->user_id}}</p>

<div style="background-color: #e3342f">
    <ul>
        @foreach ($sesBiens as $e)
            <li>{{$e}}</li>
        @endforeach
    </ul>
</div>
<div style="background-color: #9561e2">
    <ul>
        @foreach ($sesActions as $e)
            <li>{{$e}}</li>
        @endforeach
    </ul>
</div>
<div style="background-color: #4dc0b5">
    <ul>
        @foreach ($sesChambres as $e)
            <li>{{$e}}</li>
        @endforeach
    </ul>
</div>
    <a href="{{url('/voirannoncedealerte/'.$id)}}">Aller à l'annonce</a>
@stop
