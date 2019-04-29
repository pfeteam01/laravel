@extends('layouts.app',['title'=>'Carte'])
@section('content')
    @foreach($ann as $e)
        <div class="annonces" style="border: 5px #1b1e21 solid; height: 350px; width: 350px;background-color: #98e1b7; color: #1b1e21 ;text-align: center ;margin-bottom: 50px;">
            <ul>
                <li>Id Annonce: {{$e->id_annonce}}</li>
                <li>Titre: {{$e->titre}}</li>
                <li>Wilaya: {{$e->wilaya}}</li>
                <li>Addresse: {{$e->adresse}}</li>
                <li>Mail: {{$e->mail}}</li>
                <li>Description: {{$e->description}}</li>
                <li>Latitude: {{$e->lat}}</li>
                <li>Longitude: {{$e->lng}}</li>
                <li>Superficie: {{$e->superficie}}</li>
                <li>Etat: {{$e->etat}}</li>
                <li>User: {{$e->user_id}}</li>
                {{-- Continue à afficher les autres infos --}}
            </ul>
        </div>
    @endforeach
    <div id="mapid" style="width: 850px; height: 600px; position: fixed; top: 50% ; left: 60% ;transform: translate(-50%,-50%);"></div>
    {{-- C'est le partial qui contient le formulaire de cases à cocher qui permet de faire apparaitre les musées, les trains etc ... --}}
    @include('layouts.partials._filter_search_carte')
    <script>
        mymap = L.map('mapid').setView([36.752089156946326,3.065185546875], 13);
        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            id: 'mapbox.streets'
        }).addTo(mymap);
    </script>

    {{-- C'est le partial qui contient le chargement des scripts qui permette de gerer la carte (filtrer et faire apparaitre les éléments etc...) --}}
    @include('layouts.partials._load_files_script_filter_map')

    {{-- C'est le partial qui permet d'afficher le modale qui detaille l'annonce --}}
    @include('layouts.partials._modale_for_detailler_annonce')

    <script src="{{asset('js/recherche_annonce/detailler_annonce.js')}}"></script>
    <script>
        {{--La gestion des évènements du formulaire de commander concernant le modale pour afficher les informations d'une annonce--}}
        $('#myModal').on('hidden.bs.modal',function(){
            $('#message').removeClass('is-invalid').val("");
            $('#mail').removeClass('is-invalid').val("");
            $('#tel').removeClass('is-invalid').val("");
            $('.typebien').empty();
            $('.typeaction').empty();
            $('.description').empty();
        });
    </script>

    <script>
        $(document).ready(function () {
            var options = {
                radius: 15,
                fillColor: '#ff030d',
                color: "#ff030d",
                weight: 1,
                opacity: 1,
                fillOpacity: 0.8
            } ;
            var circleMarker = new L.circleMarker([{{$e->lat}},{{$e->lng}}],options).addTo(mymap).on('click',function () {
                showDetails({{$e->id_annonce}});
                $('#myModal').modal();
            });
        });
    </script>
    <script>
        {{--Mettre un listener click dans la div afin que la modale s'affiche--}}
        $('.annonces').click(function () {
            showDetails({{$e->id_annonce}});
            $('#myModal').modal();
        });
    </script>
@stop
