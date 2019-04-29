var style = null ;

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

function getOptions(marker) {
    var oldOne = {
        radius: marker.options.radius,
        fillColor: marker.options.fillColor ,
        color: marker.options.color,
        weight: marker.options.weight ,
        opacity: marker.options.opacity,
        fillOpacity: marker.options.fillOpacity,
    };
    return oldOne ;
}

function activerMarker(element,mymap){
    var latitude = element.getAttribute('data-lat');
    var longitude = element.getAttribute('data-lng');
    var circleMarkerItem = recupererItem(mymap,latitude,longitude);
    style = getOptions(circleMarkerItem);
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
    circleMarkerItem.setStyle(style);
}
