@extends('layouts.app',['title'=>'Mes Favoris'])
@section('content')
    <div id="annonces"></div>
    <div id="mapid" style="width: 850px; height: 600px; position: fixed; top: 50% ; left: 60% ;transform: translate(-50%,-50%);"></div>
    @include('layouts.partials._filter_search_carte')
    <script>
        mymap = L.map('mapid').setView([36.752089156946326,3.065185546875], 13);
        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            id: 'mapbox.streets'
        }).addTo(mymap);
    </script>
    <script type="text/javascript" src="js/functions/functions_map_effets.js"></script>
    <script type="text/javascript" src="js/functions/functions_carte.js"></script>

    <script src="js/carte/JS_Maps/GeoJSONs/geojsonAlimentationsEtSupermarches.js"></script>
    <script src="js/carte/JS_Maps/GeoJSONs/geojsonBanques.js"></script>
    <script src="js/carte/JS_Maps/GeoJSONs/geojsonBibliothequesEtCentresDeCulture.js"></script>
    <script src="js/carte/JS_Maps/GeoJSONs/geojsonBoucheries.js"></script>
    <script src="js/carte/JS_Maps/GeoJSONs/geojsonBoulangeriesEtPatesseries.js"></script>
    <script src="js/carte/JS_Maps/GeoJSONs/geojsonBus.js"></script>
    <script src="js/carte/JS_Maps/GeoJSONs/geojsonCafeteria.js"></script>
    <script src="js/carte/JS_Maps/GeoJSONs/geojsonCEM.js"></script>
    <script src="js/carte/JS_Maps/GeoJSONs/geojsonCentresCommerciaux.js"></script>
    <script src="js/carte/JS_Maps/GeoJSONs/geojsonFastFoodEtRestaurants.js"></script>
    <script src="js/carte/JS_Maps/GeoJSONs/geojsonHopitaux.js"></script>
    <script src="js/carte/JS_Maps/GeoJSONs/geojsonLibrairies.js"></script>
    <script src="js/carte/JS_Maps/GeoJSONs/geojsonLycees.js"></script>
    <script src="js/carte/JS_Maps/GeoJSONs/geojsonMetro.js"></script>
    <script src="js/carte/JS_Maps/GeoJSONs/geojsonMosquees.js"></script>
    <script src="js/carte/JS_Maps/GeoJSONs/geojsonMusees.js"></script>
    <script src="js/carte/JS_Maps/GeoJSONs/geojsonPharmacies.js"></script>
    <script src="js/carte/JS_Maps/GeoJSONs/geojsonPiscines.js"></script>
    <script src="js/carte/JS_Maps/GeoJSONs/geojsonPoste.js"></script>
    <script src="js/carte/JS_Maps/GeoJSONs/geojsonPrimaire.js"></script>
    <script src="js/carte/JS_Maps/GeoJSONs/geojsonSalleDeSportEtFitness.js"></script>
    <script src="js/carte/JS_Maps/GeoJSONs/geojsonShopping.js"></script>
    <script src="js/carte/JS_Maps/GeoJSONs/geojsonTaxis.js"></script>
    <script src="js/carte/JS_Maps/GeoJSONs/geojsonTrains.js"></script>
    <script src="js/carte/JS_Maps/GeoJSONs/geojsonTramway.js"></script>
    <script src="js/carte/JS_Maps/GeoJSONs/geojsonUniversites.js"></script>

    <script src="js/carte/JS_Maps/JS/alimentationsEtSuperMarches.js"></script>
    <script src="js/carte/JS_Maps/JS/banques.js"></script>
    <script src="js/carte/JS_Maps/JS/bibliothequesEtCentresDeCulture.js"></script>
    <script src="js/carte/JS_Maps/JS/boucheries.js"></script>
    <script src="js/carte/JS_Maps/JS/boulangeriesEtPatesseries.js"></script>
    <script src="js/carte/JS_Maps/JS/bus.js"></script>
    <script src="js/carte/JS_Maps/JS/cafeteria.js"></script>
    <script src="js/carte/JS_Maps/JS/cem.js"></script>
    <script src="js/carte/JS_Maps/JS/centresCommerciaux.js"></script>
    <script src="js/carte/JS_Maps/JS/fastFoosEtRestaurants.js"></script>
    <script src="js/carte/JS_Maps/JS/hopitaux.js"></script>
    <script src="js/carte/JS_Maps/JS/librairies.js"></script>
    <script src="js/carte/JS_Maps/JS/lycees.js"></script>
    <script src="js/carte/JS_Maps/JS/metro.js"></script>
    <script src="js/carte/JS_Maps/JS/mosquees.js"></script>
    <script src="js/carte/JS_Maps/JS/musees.js"></script>
    <script src="js/carte/JS_Maps/JS/pharmacies.js"></script>
    <script src="js/carte/JS_Maps/JS/piscines.js"></script>
    <script src="js/carte/JS_Maps/JS/postes.js"></script>
    <script src="js/carte/JS_Maps/JS/primaires.js"></script>
    <script src="js/carte/JS_Maps/JS/sallesDeSportEtFitness.js"></script>
    <script src="js/carte/JS_Maps/JS/shopping.js"></script>
    <script src="js/carte/JS_Maps/JS/taxis.js"></script>
    <script src="js/carte/JS_Maps/JS/trains.js"></script>
    <script src="js/carte/JS_Maps/JS/tramway.js"></script>
    <script src="js/carte/JS_Maps/JS/universite.js"></script>

    <script src="js/carte/JS_Maps/eventMap.js"></script>

    <script src="js/recherche_annonce/detailler_annonce.js"></script>
    <!-- The Modal -->
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
                    <button id="favoris" type="button" class="btn btn-light"><span class="addremove"></span></button>
                    <br>
                </div>
                <!-- Modal footer -->
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#myModal').on('hidden.bs.modal',function(){
            $('#message').removeClass('is-invalid').val("");
            $('#mail').removeClass('is-invalid').val("");
            $('#tel').removeClass('is-invalid').val("");

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
            fillColor: "#ff0097",
            color: "#000",
            weight: 1,
            opacity: 1,
            fillOpacity: 0.8
        } ;
        @for($i=0;$i<count($tabAnnonce);$i++)
            var cicleMarker = new L.circleMarker([{{$tabAnnonce[$i]->lat}},{{$tabAnnonce[$i]->lng}}],option);
            tab.push(cicleMarker);
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
                ' onmouseenter="activerMarker(this,mymap)" ' +
                ' onmouseleave="resetMarker(this,mymap)"' +
                ' data-toggle="modal"' +
                ' data-target="#myModal" ' +
                ' onclick="showDetails({{$tabAnnonce[$i]->id_annonce}});">'+
                '<img width="300" height="200" src="cover_img/'+nom_image+'"><br>'+
                '{{$tabAnnonce[$i]->titre}}<br>'+
                '</div>' +
                '<br/>';
        @endfor
        var fg = new L.featureGroup(tab);
        mymap.addLayer(fg);
        mymap.fitBounds(fg.getBounds());
        if (tab.length == 0)
            annonces = 'Nothing to show ..';
        document.getElementById('annonces').innerHTML = annonces ;
    </script>
@stop
