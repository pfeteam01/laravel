//definir la fonction qui s'occupe de la generation de la popup
function afficherPopup(feature, layer){
    if (feature.Nom)
        layer.bindPopup(feature.Nom);
    else 
        layer.bindPopup("Cafétéria");
}

//Définir le style de ce geojson
var styleCafe = L.icon({
    iconUrl : "js/carte/Images_Maps/cafe.svg",
    iconSize : [20,20],
    iconAnchor : [10,20],
    popupAnchor : [0,-20]
});
            
//Définition de l'objet option de ce geojson
var optionsCafe = {
    pointToLayer : function(feature,latlng){
        return L.marker(latlng,{icon:styleCafe});
    },
    onEachFeature : afficherPopup
};
            
var cafe = geojsonMaker(geojsonCafeteria,optionsCafe);
var tab = [] ;
tab = tabMarker(mymap,cafe);

var layerGroupCafeteria = L.layerGroup(tab);
