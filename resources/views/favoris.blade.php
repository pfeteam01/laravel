@extends('layouts.app',['title'=>'Mes Favoris'])
@section('content')
    <div id="annonces"></div>
    <div id="mapid" style="width: 850px; height: 600px; position: fixed; top: 50% ; left: 60% ;transform: translate(-50%,-50%);"></div>
    {{-- C'est le partial qui contient le formulaire de cases à cocher qui permet de faire apparaitre les musées, les trains etc... --}}
    @include('layouts.partials._filter_search_carte')
    <script>
        mymap = L.map('mapid').setView([36.752089156946326,3.065185546875], 13);
        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            id: 'mapbox.streets'
        }).addTo(mymap);
    </script>
    {{--C'est le partial qui contient le chargement des scripts qui permette de gerer la carte (filtrer et faire apparaitre les éléments etc...) --}}
    @include('layouts.partials._load_files_script_filter_map')

    <script src="js/recherche_annonce/detailler_annonce.js"></script>
    {{-- C'est le partial qui permet d'afficher le modale qui detaille l'annonce --}}
    @include('layouts.partials._modale_for_detailler_annonce')
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
        //La gestion de la fonction de commande
        $('#commanderAnnonce').on('submit',function (e) {
            e.preventDefault();
            var fd = new FormData();
            fd.append('id_annonce',myid);
            fd.append('mail',$('#mail').val());
            fd.append('tel',$('#tel').val());
            fd.append('message',$('#message').val());
            fd.append('_token','{{csrf_token()}}');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"{{url('/commander')}}",
                method:"POST",
                data:fd,
                contentType: false,
                processData: false,
                dataType:'JSON',
                success:function(data) {
                    if (data.status == 'Success')
                        console.log(data.message);
                    else{
                        $.each(data.message, function(key,value){
                            console.log(key+" "+value);
                        });
                        if (data.message.hasOwnProperty('message')){
                            $('#message').addClass('is-invalid');
                        }
                        if (data.message.hasOwnProperty('mail')){
                            $('#mail').addClass('is-invalid');
                        }
                        if(data.message.hasOwnProperty('tel')){
                            $('#tel').addClass('is-invalid');
                        }
                    }
                }
            });
        });
        //La gestion des facoris.
        $('#favoris').on('click',function () {
            var fd = new FormData();
            fd.append('id_annonce',myid);
            fd.append('_token','{{csrf_token()}}');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"{{ url('/ajouterfavoris') }}",
                method:"POST",
                data:fd,
                contentType: false,
                processData: false,
                dataType:'JSON',
                success:function(data) {
                    $('.addremove').html(data.titreBouton);
                    var m = $('div[onclick="showDetails('+myid+');"]');
                    m.slideUp(2000);
                    m.remove();
                    var c = recupererItem(mymap,mylat,mylng);
                    if (data.status == 0){
                        mymap.removeLayer(c);
                    }else{
                        c.setStyle({
                            radius: 15,
                            fillColor: "#fff",
                            color: "#000",
                            weight: 1,
                            opacity: 1,
                            fillOpacity: 0.8
                        });

                    }
                }
            });
        });
    </script>

    <script>
        var tab = [];
        var annonces = '';
        var option = {
            radius: 15,
            fillColor: '#77ff45',
            color: "#000",
            weight: 1,
            opacity: 1,
            fillOpacity: 0.8
        };
        @for($i=0;$i<count($tabAnnonce);$i++)
            var cicleMarker = new L.circleMarker([{{$tabAnnonce[$i]->lat}},{{$tabAnnonce[$i]->lng}}],option);
            tab.push(cicleMarker);
            console.log(tab);
            @if( count($tabImage[$i]) != 0 )
                nom_image = '{{$tabImage[$i][0]->nom_image}}'  ;
            @else
                nom_image = 'ImageAnnonceParDefault.jpg' ;
            @endif
            annonces +=
                '<div ' +
                ' style="background-color: #1b1e21; width: 300px; height: 400px; color: white" ' +
                ' data-lat="{{$tabAnnonce[$i]->lat}}" ' +
                ' data-lng="{{$tabAnnonce[$i]->lng}}" ' +
                ' data-id="{{$tabAnnonce[$i]->id_annonce}}" ' +
                ' onmouseenter="activerMarker(this,mymap)" ' +
                ' onmouseleave="resetMarker(this,mymap)"' +
                ' data-toggle="modal"' +
                ' data-target="#myModal" ' +
                ' onclick="showDetails({{$tabAnnonce[$i]->id_annonce}});">'+
                '<img width="300" height="200" src="cover_img/'+nom_image+'"><br>'+
                '{{$tabAnnonce[$i]->titre}}<br>'+
                '{{$tabAnnonce[$i]->id_annonce}}<br>'+
                '</div>' +
                '<br/>';
        @endfor
        var len = tab.length ;
        var fg = new L.featureGroup(tab);
        mymap.addLayer(fg);
        mymap.fitBounds(fg.getBounds());
        if (len == 0)
            annonces = 'Nothing to show ..';
        document.getElementById('annonces').innerHTML = annonces ;
        fg.eachLayer(function (layer) {
            if (layer instanceof L.CircleMarker){
                layer.on('click',function () {
                    var lat = layer.getLatLng().lat ;
                    var lng = layer.getLatLng().lng ;
                    var maDiv = $('div[data-lat="'+lat+'"]');
                    var id_annonce = maDiv.attr('data-id');
                    showDetails(id_annonce);
                    $('#myModal').modal();
                });
            }
        });
    </script>
@stop
