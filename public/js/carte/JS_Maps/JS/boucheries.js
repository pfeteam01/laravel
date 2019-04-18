//definir la fonction qui s'occupe de la generation de la popup
function afficherPopup(feature, layer){
    if (feature.Nom)
        layer.bindPopup(feature.Nom);
    else 
        layer.bindPopup("Boucherie");
}

//Définir le style de ce geojson
var styleBouch = L.icon({
    iconUrl : "/js/carte/Images_Maps/boucherie.svg",
    iconSize : [20,20],
    iconAnchor : [10,20],
    popupAnchor : [0,-20]
});
            
//Définition de l'objet option de ce geojson
var optionsBouch = {
    pointToLayer : function(feature,latlng){
        return L.marker(latlng,{icon:styleBouch});
    },
    onEachFeature : afficherPopup
};

var boucher = geojsonMaker(geojsonBoucheries,optionsBouch);
var tab = [] ;
tab = tabMarker(mymap,boucher);

var layerGroupBoucherie = L.layerGroup(tab);
