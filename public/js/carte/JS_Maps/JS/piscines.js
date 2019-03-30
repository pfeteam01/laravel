//definir la fonction qui s'occupe de la generation de la popup
function afficherPopup(feature, layer){
    if (feature.Nom)
        layer.bindPopup(feature.Nom);
    else 
        layer.bindPopup("Piscine");
}

//Définir le style de ce geojson
var stylePisc = L.icon({
    iconUrl : "js/carte/Images_Maps/piscine.svg",
    iconSize : [20,20],
    iconAnchor : [10,20],
    popupAnchor : [0,-20]
});
            
//Définition de l'objet option de ce geojson
var optionsPisc = {
    pointToLayer : function(feature,latlng){
        return L.marker(latlng,{icon:stylePisc});
    },
    onEachFeature : afficherPopup
};
            
var piscine = geojsonMaker(geojsonPiscines,optionsPisc);
var tab = [] ;
tab = tabMarker(mymap,piscine);

//Definir le layer group
var layerGroupPiscine = L.layerGroup(tab);
