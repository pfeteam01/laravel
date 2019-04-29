//definir la fonction qui s'occupe de la generation de la popup
function afficherPopup(feature, layer){
    if (feature.Nom)
        layer.bindPopup(feature.Nom);
    else 
        layer.bindPopup("Mosquée");
}

//Définir le style de ce geojson
var styleMos = L.icon({
    iconUrl : "/js/carte/Images_Maps/mosquee.svg",
    iconSize : [20,20],
    iconAnchor : [10,20],
    popupAnchor : [0,-20]
});
            
//Définition de l'objet option de ce geojson
var optionsMos = {
    pointToLayer : function(feature,latlng){
        return L.marker(latlng,{icon:styleMos});
    },
    onEachFeature : afficherPopup
};
            
var mosquee = geojsonMaker(geojsonMosquees,optionsMos);
var tab = [] ;
tab = tabMarker(mymap,mosquee);

//Definir le layer group
var layerGroupMosque = L.layerGroup(tab);
