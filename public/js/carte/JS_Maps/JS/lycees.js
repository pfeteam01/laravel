//definir la fonction qui s'occupe de la generation de la popup
function afficherPopup(feature, layer){
    if (feature.Nom)
        layer.bindPopup(feature.Nom);
    else 
        layer.bindPopup("Lycées");
}

//Définir le style de ce geojson
var styleLycee = L.icon({
    iconUrl : "js/carte/Images_Maps/lycee.svg",
    iconSize : [20,20],
    iconAnchor : [10,20],
    popupAnchor : [0,-20]
});
            
//Définition de l'objet option de ce geojson
var optionsLycee = {
    pointToLayer : function(feature,latlng){
        return L.marker(latlng,{icon:styleLycee});
    },
    onEachFeature : afficherPopup
};
            
var lycee = geojsonMaker(geojsonLycees,optionsLycee);
var tab = [] ;
tab = tabMarker(mymap,lycee);

//Definir le layer group
var layerGroupLycee = L.layerGroup(tab);
