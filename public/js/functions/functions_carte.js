
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
