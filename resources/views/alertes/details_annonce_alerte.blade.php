@extends('layouts.app',['title'=>'Carte'])
@section('content')
<<<<<<< HEAD
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
=======
    <ul>
    @foreach($ann as $e)
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
    @endforeach
    </ul>
    <div id="annonces"></div>
    <div id="mapid" style="width: 850px; height: 600px; position: fixed; top: 50% ; left: 60% ;transform: translate(-50%,-50%);"></div>
>>>>>>> 7694738eab9cd0c199e2344a80ac97826cc2d4ea
    @include('layouts.partials._filter_search_carte')
    <script>
        mymap = L.map('mapid').setView([36.752089156946326,3.065185546875], 13);
        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            id: 'mapbox.streets'
        }).addTo(mymap);
    </script>
<<<<<<< HEAD

    {{-- C'est le partial qui contient le chargement des scripts qui permette de gerer la carte (filtrer et faire apparaitre les éléments etc...) --}}
    @include('layouts.partials._load_files_script_filter_map')

    {{-- C'est le partial qui permet d'afficher le modale qui detaille l'annonce --}}
    @include('layouts.partials._modale_for_detailler_annonce')

    <script src="{{asset('js/recherche_annonce/detailler_annonce.js')}}"></script>
    <script>
        {{--La gestion des évènements du formulaire de commander concernant le modale pour afficher les informations d'une annonce--}}
=======
    <script type="text/javascript" src="../js/functions/functions_map_effets.js"></script>
    <script type="text/javascript" src="../js/functions/functions_carte.js"></script>

    <script src="{{asset('js/carte/JS_Maps/GeoJSONs/geojsonAlimentationsEtSupermarches.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/GeoJSONs/geojsonBanques.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/GeoJSONs/geojsonBibliothequesEtCentresDeCulture.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/GeoJSONs/geojsonBoucheries.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/GeoJSONs/geojsonBoulangeriesEtPatesseries.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/GeoJSONs/geojsonBus.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/GeoJSONs/geojsonCafeteria.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/GeoJSONs/geojsonCEM.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/GeoJSONs/geojsonCentresCommerciaux.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/GeoJSONs/geojsonFastFoodEtRestaurants.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/GeoJSONs/geojsonHopitaux.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/GeoJSONs/geojsonLibrairies.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/GeoJSONs/geojsonLycees.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/GeoJSONs/geojsonMetro.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/GeoJSONs/geojsonMosquees.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/GeoJSONs/geojsonMusees.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/GeoJSONs/geojsonPharmacies.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/GeoJSONs/geojsonPiscines.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/GeoJSONs/geojsonPoste.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/GeoJSONs/geojsonPrimaire.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/GeoJSONs/geojsonSalleDeSportEtFitness.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/GeoJSONs/geojsonShopping.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/GeoJSONs/geojsonTaxis.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/GeoJSONs/geojsonTrains.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/GeoJSONs/geojsonTramway.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/GeoJSONs/geojsonUniversites.js')}}"></script>

    <script src="{{asset('js/carte/JS_Maps/JS/alimentationsEtSuperMarches.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/JS/banques.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/JS/bibliothequesEtCentresDeCulture.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/JS/boucheries.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/JS/boulangeriesEtPatesseries.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/JS/bus.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/JS/cafeteria.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/JS/cem.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/JS/centresCommerciaux.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/JS/fastFoosEtRestaurants.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/JS/hopitaux.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/JS/librairies.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/JS/lycees.js')}}"></script>
    <script src="{{asset('js/carte/JS_Maps/JS/metro.js')}}"></script>
    <script src="../js/carte/JS_Maps/JS/mosquees.js"></script>
    <script src="../js/carte/JS_Maps/JS/musees.js"></script>
    <script src="../js/carte/JS_Maps/JS/pharmacies.js"></script>
    <script src="../js/carte/JS_Maps/JS/piscines.js"></script>
    <script src="../js/carte/JS_Maps/JS/postes.js"></script>
    <script src="../js/carte/JS_Maps/JS/primaires.js"></script>
    <script src="../js/carte/JS_Maps/JS/sallesDeSportEtFitness.js"></script>
    <script src="../js/carte/JS_Maps/JS/shopping.js"></script>
    <script src="../js/carte/JS_Maps/JS/taxis.js"></script>
    <script src="../js/carte/JS_Maps/JS/trains.js"></script>
    <script src="../js/carte/JS_Maps/JS/tramway.js"></script>
    <script src="../js/carte/JS_Maps/JS/universite.js"></script>

    <script src="../js/carte/JS_Maps/eventMap.js"></script>

    <script src="../js/recherche_annonce/script_load.js"></script>
    <script src="../js/recherche_annonce/script_change.js"></script>
    <script src="../js/recherche_annonce/script_move.js"></script>
    <script src="../js/recherche_annonce/detailler_annonce.js"></script>
    <!-- The Modal -->
    <img src="../js/carte/Images_Maps/banque.svg">
    <div class="modal fade" id="myModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <!-- Modal Header -->
                <div class="modal-header">
                    <h4 class="modal-title">Les infos sur l'annonce.</h4>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <!-- Modal body -->
                <div class="modal-body">
                    <span class="typebien"></span><br>
                    <span class="typeaction"></span><br>
                    <span class="description"></span><br>
                    <button type="button" id="commander" class="btn btn-info">Commander</button><br>
                    <form method="post" id="commanderAnnonce">
                        {{csrf_field()}}
                        <div class="form-group">
                            <input type="email" id="mail" class="form-control" placeholder="Entrer votre email" />
                            <div class="invalid-feedback">That didn't work.</div>
                        </div>
                        <div class="form-group">
                            <input type="tel" id="tel" class="form-control" placeholder="Entrer votre telephone" />
                            <div class="invalid-feedback">That didn't work.</div>
                        </div>
                        <div class="form-group">
                            <textarea id="message" class="form-control" placeholder="Message"></textarea>
                            <div class="invalid-feedback">That didn't work.</div>
                        </div>
                        <input type="submit" value="Envoyer">
                    </form>
                    <button id="favoris" type="button" class="btn btn-light"><span class="addremove"></span></button><br>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
>>>>>>> 7694738eab9cd0c199e2344a80ac97826cc2d4ea
        $('#myModal').on('hidden.bs.modal',function(){
            $('#message').removeClass('is-invalid').val("");
            $('#mail').removeClass('is-invalid').val("");
            $('#tel').removeClass('is-invalid').val("");
<<<<<<< HEAD
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
=======

        });
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
                    var c = recupererItem(mymap,mylat,mylng);
                    if (data.status == 0){
                        c.setStyle({
                            radius: 15,
                            fillColor: "#ff0097",
                            color: "#000",
                            weight: 1,
                            opacity: 1,
                            fillOpacity: 0.8
                        });
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
>>>>>>> 7694738eab9cd0c199e2344a80ac97826cc2d4ea
        });
    </script>
@stop
