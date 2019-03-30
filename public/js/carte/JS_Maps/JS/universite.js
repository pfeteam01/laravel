//definir la fonction qui s'occupe de la generation de la popup
function afficherPopup(feature, layer){
    if (feature.Nom)
        layer.bindPopup(feature.Nom);
    else 
        layer.bindPopup("Université");
}

//Définir le style de ce geojson
var styleUni = L.icon({
    iconUrl : "js/carte/Images_Maps/universite.svg",
    iconSize : [20,20],
    iconAnchor : [10,20],
    popupAnchor : [0,-20]
});
            
//Définition de l'objet option de ce geojson
var optionsUni = {
    pointToLayer : function(feature,latlng){
        return L.marker(latlng,{icon:styleUni});
    },
    onEachFeature : afficherPopup
};
            
var universite = geojsonMaker(geojsonUniversites,optionsUni);
var tab = [] ;
tab = tabMarker(mymap,universite);

var layerGroupUniversite = L.layerGroup(tab);
