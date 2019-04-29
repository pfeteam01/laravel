@extends('layouts.app',['title'=>'Ajouter une alerte'])
@section('content')
    @for($i=0;$i<$mesAlertes->count();$i++)
        <div style="background-color: #98e1b7; border: 2px #1b1e21 dashed ;">
            <ul>
                <li><b>L'id de l'alerte: </b>{{$mesAlertes->get($i)->id_alerte}}</li>
                <li><b>Wilaya de l'alerte: </b>{{$mesAlertes->get($i)->wilaya}}</li>
                <li><b>Le mail de l'alerte: </b>{{$mesAlertes->get($i)->mail}}</li>
                <li><b>La surface min: </b>@if($mesAlertes->get($i)->surface_min != null){{$mesAlertes->get($i)->surface_min}}@else SURFACE MIN @endif</li>
                <li><b>La surface Max: </b>@if($mesAlertes->get($i)->surface_max != null){{$mesAlertes->get($i)->surface_max}}@else SURFACE MAX @endif</li>
                <li><b>Etat: </b>{{$mesAlertes->get($i)->etat_alerte}}</li>
                <li><b>Prix/Loyer Min</b>@if($mesAlertes->get($i)->lp_min != null){{$mesAlertes->get($i)->lp_min}}@else PRIX MIN @endif</li>
                <li><b>Prix/Loyer Max</b>@if($mesAlertes->get($i)->lp_max != null){{$mesAlertes->get($i)->lp_max}}@else PRIX MAX @endif</li>
                @foreach($biens->get($i) as $e)
                    <li>{{$e}}</li>
                @endforeach
                @foreach($actions->get($i) as $e)
                    <li>{{$e}}</li>
                @endforeach
                @foreach($chambres->get($i) as $e)
                    <li>{{$e}}</li>
                @endforeach
            </ul>
            <a href="{{url('/affichermodifalerte/'.$mesAlertes->get($i)->id_alerte)}}" class="btn btn-light">Modifier l'alerte.</a>
            <a href="{{url('/changeretat/'.$mesAlertes->get($i)->id_alerte)}}" class="btn btn-light">@if($mesAlertes->get($i)->etat_alerte == 0){{'Activer de l\'alerte'}}@else {{'Désactiver l\'alerte'}} @endif</a>
            <a href="{{url('/supprimeralerte/'.$mesAlertes->get($i)->id_alerte)}}" class="btn btn-light">Supprimer l'alerte</a>
        </div>
        <br><br>
    @endfor
@stop
