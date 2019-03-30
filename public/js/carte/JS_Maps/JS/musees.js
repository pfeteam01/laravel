//definir la fonction qui s'occupe de la generation de la popup
function afficherPopup(feature, layer){
    if (feature.Nom)
        layer.bindPopup(feature.Nom);
    else 
        layer.bindPopup("Musée");
}

//Définir le style de ce geojson
var styleMusee = L.icon({
    iconUrl : "js/carte/Images_Maps/musee.svg",
    iconSize : [20,20],
    iconAnchor : [10,20],
    popupAnchor : [0,-20]
});
            
//Définition de l'objet option de ce geojson
var optionsMusee = {
    pointToLayer : function(feature,latlng){
        return L.marker(latlng,{icon:styleMusee});
    },
    onEachFeature : afficherPopup
};
            
var musee = geojsonMaker(geojsonMusees,optionsMusee);
var tab = [] ;
tab = tabMarker(mymap,musee);

//Definir le layer group
var layerGroupMusee = L.layerGroup(tab);
