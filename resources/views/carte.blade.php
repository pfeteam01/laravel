@extends('layouts.app',['title'=>'Carte'])
@section('content')
<script type="text/javascript">
    function tabMarker(mymap,geojson){
        var tab = [];
        var bounds = mymap.getBounds();
        $.each(geojson._layers,function(i){
            var marker = geojson._layers[i];
            if (marker.feature && bounds.contains(marker.getLatLng())){
                tab.push(this);
            }else{
                mymap.removeLayer(this);
            }
        });
        return tab;
    }
    function geojsonMaker(geojsonX,optionX){
        var geojson = L.geoJSON(geojsonX,optionX);
        return geojson;
    }
    function f1(checkElem,geo){
        if (checkElem.checked){
            mymap.addLayer(geo);
        }else{
            mymap.removeLayer(geo);
        }
    }
    function tabMarkerNotPrecision(mymap,geojson){
        var tab = [];
        $.each(geojson._layers,function(i){
            var marker = geojson._layers[i];
            if (marker.feature){
                tab.push(this);
            }
        });
        return tab;
    }
</script>

<div id="annonces"></div>

<div id="mapid" style="width: 850px; height: 600px; position: fixed; top: 50% ; left: 60% ;transform: translate(-50%,-50%);"></div>

<label for="ali">Alimantations</label><input type="checkbox" id="ali" onchange="f1(this,layerGroupAlimentations)"><br/>
<label for="ban">Banques</label><input type="checkbox" id="ban" onchange="f1(this,layerGroupBanque)"><br>
<label for="bib">Bibliothèques et centres culturels</label><input type="checkbox" id="bib" onchange="f1(this,layerGroupBibio)"><br>
<label for="bouch">Boucheries</label><input type="checkbox" id="bouch" onchange="f1(this,layerGroupBoucherie)"><br>
<label for="boul">Boulangeries</label><input type="checkbox" id="boul" onchange="f1(this,layerGroupBoulangerie)"><br>
<label for="bus">Bus</label><input type="checkbox" id="bus" onchange="f1(this,layerGroupBus)"><br>
<label for="cafe">Cafétéria</label><input type="checkbox" id="cafe" onchange="f1(this,layerGroupCafeteria)"><br>
<label for="coll">Collège(CEM)</label><input type="checkbox" id="coll" onchange="f1(this,layerGroupCEM)"><br>
<label for="cencom">Centres Commerciaux</label><input type="checkbox" id="cencom" onchange="f1(this,layerGroupCentreCommerce)"><br>
<label for="res">Fast food et Restaurants</label><input type="checkbox" id="res" onchange="f1(this,layerGroupfastfood)"><br>
<label for="hop">Hopitaux</label><input type="checkbox" id="hop" onchange="f1(this,layerGroupHopitaux)"><br>
<label for="lib">Librairies</label><input type="checkbox" id="lib" onchange="f1(this,layerGroupLibrairie)"><br>
<label for="lyc">Lycées</label><input type="checkbox" id="lyc" onchange="f1(this,layerGroupLycee)"><br>
<label for="met">Metro</label><input type="checkbox" id="met" onchange="f1(this,LayerGroupMetro)"> <br>
<label for="mosq">Mosquées</label><input type="checkbox" id="mosq" onchange="f1(this,layerGroupMosque)"><br>
<label for="muse">Musées</label><input type="checkbox" id="muse" onchange="f1(this,layerGroupMusee)"><br>
<label for="phar">Pharmacies</label><input type="checkbox" id="phar" onchange="f1(this,layerGroupPharmacie)"><br>
<label for="pisc">Piscines</label><input type="checkbox" id="pisc" onchange="f1(this,layerGroupPiscine)"><br>
<label for="poste">Postes</label><input type="checkbox" id="poste" onchange="f1(this,layerGroupPoste)"><br>
<label for="prim">Primaires</label><input type="checkbox" id="prim" onchange="f1(this,layerGroupPrimaire)"><br>
<label for="sport">Salles de sport et fitness</label><input type="checkbox" id="sport" onchange="f1(this,layerGroupSport)"><br>
<label for="shop">Shopping</label><input type="checkbox" id="shop" onchange="f1(this,layerGroupShopping)"><br>
<label for="taxi">Taxis</label><input type="checkbox" id="taxi" onchange="f1(this,layerGroupTaxis)"><br>
<label for="train">Trains</label><input type="checkbox" id="train" onchange="f1(this,layerGroupTrain)"--><br>
<label for="tram">Tramway</label><input type="checkbox" id="tram" onchange="f1(this,layerGroupTramway)"><br>
<label for="uni">Universitées</label><input type="checkbox" id="uni" onchange="f1(this,layerGroupUniversite)"><br>

<script type="text/javascript">
    mymap = L.map('mapid').setView([36.752089156946326,3.065185546875], 13);
    L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
        maxZoom: 18,
        id: 'mapbox.streets'
    }).addTo(mymap);
    L.circleMarker([36.752089156946326,3.065185546875]).addTo(mymap);
    out = '' ;
    tab = [];
    mymap.eachLayer(function(layer){
        if (layer instanceof L.CircleMarker){
            mymap.removeLayer(layer);
        }
    });
    @foreach($all as $e)
        var circleMarkerAnnonce = L.circleMarker( [ {{$e->lat}},{{$e->lng}} ], {
            radius: 15,
            fillColor: "#ff0097",
            color: "#000",
            weight: 1,
            opacity: 1,
            fillOpacity: 0.8,
        });
        var bounds = mymap.getBounds();
        if (bounds.contains(circleMarkerAnnonce.getLatLng())){
            tab.push(circleMarkerAnnonce);
            out += '<div ' +
                ' style="background-color: #1b1e21; width: 150px; height: 100px; color: white" ' +
                ' data-lat ="{{$e->lat}}" ' +
                ' data-lng="{{$e->lng}}" ' +
                ' onmouseenter="activerMarker(this,mymap)" onmouseleave="resetMarker(this,mymap)">{{$e->titre}}<br>{{$e->description}}</div><br/>';
        }else{
            mymap.removeLayer(circleMarkerAnnonce);
        }
        var layerGroupAnnonce = new L.LayerGroup(tab);
        mymap.addLayer(layerGroupAnnonce);
    @endforeach
    if (tab.length == 0 )
        out = 'nothing to set ...' ;
    document.getElementById("annonces").innerHTML = out ;
    mymap.on('move',function () {
        out = '' ;
        tab = [];
        mymap.eachLayer(function(layer){
            if (layer instanceof L.CircleMarker){
                mymap.removeLayer(layer);
            }
        });
        @foreach($all as $e)
        var circleMarkerAnnonce = L.circleMarker( [ {{$e->lat}},{{$e->lng}} ], {
                radius: 15,
                fillColor: "#ff0097",
                color: "#000",
                weight: 1,
                opacity: 1,
                fillOpacity: 0.8
            });
        var bounds = mymap.getBounds();
        if (bounds.contains(circleMarkerAnnonce.getLatLng())){
            tab.push(circleMarkerAnnonce);
            out += '<div ' +
                ' style="background-color: #1b1e21; width: 150px; height: 100px; color: white" ' +
                ' data-lat ="{{$e->lat}}" ' +
                ' data-lng="{{$e->lng}}" ' +
                ' onmouseenter="activerMarker(this,mymap)" onmouseleave="resetMarker(this,mymap)">{{$e->titre}}<br>{{$e->description}}</div><br/>';
        }else{
            mymap.removeLayer(circleMarkerAnnonce);
        }
        var layerGroupAnnonce = new L.LayerGroup(tab);
        mymap.addLayer(layerGroupAnnonce);
        @endforeach
        if (tab.length == 0 )
            out = 'nothing to set ...' ;
        document.getElementById("annonces").innerHTML = out ;
    });
</script>

<script type="text/javascript">
    function recupererItem(mymap,lat,lng) {
        var circle ;
        mymap.eachLayer(function (layer) {
            if (layer instanceof L.CircleMarker){
                if (layer.getLatLng().lat == lat && layer.getLatLng().lng == lng){
                    circle = layer ;
                }
            }
        });
        return circle ;
    }
    function activerMarker(element,mymap){
        var latitude = element.getAttribute('data-lat');
        var longitude = element.getAttribute('data-lng');
        var circleMarkerItem = recupererItem(mymap,latitude,longitude);
        circleMarkerItem.setStyle({
            fillColor: "#3388ff",
            weight: 2,
            radius : 18
        });
    }
    function resetMarker(element,mymap) {
        var latitude = element.getAttribute('data-lat');
        var longitude = element.getAttribute('data-lng');
        var circleMarkerItem = recupererItem(mymap,latitude,longitude);
        circleMarkerItem.setStyle({
            radius: 15,
            fillColor: "#ff0097",
            color: "#000",
            weight: 1,
            opacity: 1,
            fillOpacity: 0.8
        });
    }
</script>

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

@stop
