//definir la fonction qui s'occupe de la generation de la popup
function afficherPopup(feature, layer){
    if (feature.Nom)
        layer.bindPopup(feature.Nom);
    else 
        layer.bindPopup("Taxi");
}

//Définir le style de ce geojson
var styleTaxi = L.icon({
    iconUrl : "js/carte/Images_Maps/taxis.svg",
    iconSize : [20,20],
    iconAnchor : [10,20],
    popupAnchor : [0,-20]
});
            
//Définition de l'objet option de ce geojson
var optionsTaxi = {
    pointToLayer : function(feature,latlng){
        return L.marker(latlng,{icon:styleTaxi});
    },
    onEachFeature : afficherPopup
};
            
var taxis = geojsonMaker(geojsonTaxis,optionsTaxi);
var tab = [] ;
tab = tabMarker(mymap,taxis);

//Definir le layer group
var layerGroupTaxis = L.layerGroup(tab);
