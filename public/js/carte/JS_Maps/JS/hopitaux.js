//definir la fonction qui s'occupe de la generation de la popup
function afficherPopup(feature, layer){
    if (feature.Nom)
        layer.bindPopup(feature.Nom);
    else 
        layer.bindPopup("Hopital");
}

//Définir le style de ce geojson
var styleHop = L.icon({
    iconUrl : "/js/carte/Images_Maps/hospital.svg",
    iconSize : [20,20],
    iconAnchor : [10,20],
    popupAnchor : [0,-20]
});
            
//Définition de l'objet option de ce geojson
var optionsHop = {
    pointToLayer : function(feature,latlng){
        return L.marker(latlng,{icon:styleHop});
    },
    onEachFeature : afficherPopup
};
            
var hopital = geojsonMaker(geojsonHopitaux,optionsHop);
var tab = [] ;
tab = tabMarker(mymap,hopital);

//Definir le layer group
var layerGroupHopitaux = L.layerGroup(tab);
