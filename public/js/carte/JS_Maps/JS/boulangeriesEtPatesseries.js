//definir la fonction qui s'occupe de la generation de la popup
function afficherPopup(feature, layer){
    if (feature.Nom)
        layer.bindPopup(feature.Nom);
    else 
        layer.bindPopup("Boulangerie et Patesserie");
}

//Définir le style de ce geojson
var styleBoul = L.icon({
    iconUrl : "/js/carte/Images_Maps/boulangerie.svg",
    iconSize : [20,20],
    iconAnchor : [10,20],
    popupAnchor : [0,-20]
});
            
//Définition de l'objet option de ce geojson
var optionsBoul = {
    pointToLayer : function(feature,latlng){
        return L.marker(latlng,{icon:styleBoul});
    },
    onEachFeature : afficherPopup
};

var boulangerie = geojsonMaker(geojsonBoulangeriesEtPatesseries,optionsBoul);
var tab = [] ;
tab = tabMarker(mymap,boulangerie);
var layerGroupBoulangerie = L.layerGroup(tab);
