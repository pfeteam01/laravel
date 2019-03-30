//definir la fonction qui s'occupe de la generation de la popup
function afficherPopup(feature, layer){
    if (feature.Nom)
        layer.bindPopup(feature.Nom);
    else 
        layer.bindPopup("Librairies");
}

//Définir le style de ce geojson
var styleLib = L.icon({
    iconUrl : "js/carte/Images_Maps/librairie.svg",
    iconSize : [20,20],
    iconAnchor : [10,20],
    popupAnchor : [0,-20]
});
            
//Définition de l'objet option de ce geojson
var optionsLib = {
    pointToLayer : function(feature,latlng){
        return L.marker(latlng,{icon:styleLib});
    },
    onEachFeature : afficherPopup
};
            
var librai = geojsonMaker(geojsonLibrairies,optionsLib);
var tab = [] ;
tab = tabMarker(mymap,librai);

//Definir le layer group
var layerGroupLibrairie = L.layerGroup(tab);
