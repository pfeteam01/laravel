//definir la fonction qui s'occupe de la generation de la popup
function afficherPopup(feature, layer){
    if (feature.Nom)
        layer.bindPopup(feature.Nom);
    else 
        layer.bindPopup("Bibliothèque");
}

//Définir le style de ce geojson
var styleBib = L.icon({
    iconUrl : "js/carte/Images_Maps/bibliotheque.svg",
    iconSize : [20,20],
    iconAnchor : [10,20],
    popupAnchor : [0,-20]
});
            
//Définition de l'objet option de ce geojson
var optionsBib = {
    pointToLayer : function(feature,latlng){
        return L.marker(latlng,{icon:styleBib});
    },
    onEachFeature : afficherPopup
};
            
var bibliotheque = geojsonMaker(geojsonBibliothequesEtCentresDeCulture,optionsBib);
var tab = [] ;
tab = tabMarker(mymap,bibliotheque);

var layerGroupBibio = L.layerGroup(tab);
