//definir la fonction qui s'occupe de la generation de la popup
function afficherPopup(feature, layer){
    if (feature.Nom)
        layer.bindPopup(feature.Nom);
    else 
        layer.bindPopup("Poste");
}

//Définir le style de ce geojson
var stylePoste = L.icon({
    iconUrl : "js/carte/Images_Maps/poste.svg",
    iconSize : [20,20],
    iconAnchor : [10,20],
    popupAnchor : [0,-20]
});
            
//Définition de l'objet option de ce geojson
var optionsPoste = {
    pointToLayer : function(feature,latlng){
        return L.marker(latlng,{icon:stylePoste});
    },
    onEachFeature : afficherPopup
};
            
var poste = geojsonMaker(geojsonPoste,optionsPoste);
var tab = [] ;
tab = tabMarker(mymap,poste);

//Definir le layer group
var layerGroupPoste = L.layerGroup(tab);
