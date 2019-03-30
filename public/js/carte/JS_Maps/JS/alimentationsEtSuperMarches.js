//definir la fonction qui s'occupe de la generation de la popup
function afficherPopup(feature, layer){
    if (feature.Nom)
        layer.bindPopup(feature.Nom);
    else 
        layer.bindPopup("Alimentations");
}

//Définir le style de ce geojson
var styleAli = L.icon({
    iconUrl : "js/carte/Images_Maps/supermarket.svg",
    iconSize : [20,20],
    iconAnchor : [10,20],
    popupAnchor : [0,-20]
});

//Définition de l'objet option de ce geojson
var optionsAli = {
    pointToLayer : function(feature,latlng){
        return L.marker(latlng,{icon:styleAli});
    },
    onEachFeature : afficherPopup
};

var alimentaion = geojsonMaker(geojsonAlimentationsEtSupermarches,optionsAli);
var tab = [] ;
tab = tabMarker(mymap,alimentaion);

var layerGroupAlimentations = L.layerGroup(tab);
