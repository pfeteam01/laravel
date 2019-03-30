//definir la fonction qui s'occupe de la generation de la popup
function afficherPopup(feature, layer){
    if (feature.Nom)
        layer.bindPopup(feature.Nom);
    else 
        layer.bindPopup("Fast food");
}

//Définir le style de ce geojson
var styleRes = L.icon({
    iconUrl : "js/carte/Images_Maps/Restaurant.svg",
    iconSize : [20,20],
    iconAnchor : [10,20],
    popupAnchor : [0,-20]
});
            
//Définition de l'objet option de ce geojson
var optionsRes = {
    pointToLayer : function(feature,latlng){
        return L.marker(latlng,{icon:styleRes});
    },
    onEachFeature : afficherPopup
};
            
var restaurant = geojsonMaker(geosjsonFastFoodEtRestaurants,optionsRes);
var tab = [] ;
tab = tabMarker(mymap,restaurant);

//Definir le layer group
var layerGroupfastfood = L.layerGroup(tab);
