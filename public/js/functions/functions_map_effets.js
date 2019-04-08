function recupererItem(mymap,lat,lng) {
    var circle = null;
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
