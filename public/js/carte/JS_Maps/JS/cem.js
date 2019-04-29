//definir la fonction qui s'occupe de la generation de la popup
function afficherPopup(feature, layer){
    if (feature.Nom)
        layer.bindPopup(feature.Nom);
    else 
        layer.bindPopup("Collège");
}

//Définir le style de ce geojson
var styleColle = L.icon({
    iconUrl : "/js/carte/Images_Maps/cem.svg",
    iconSize : [20,20],
    iconAnchor : [10,20],
    popupAnchor : [0,-20]
});
            
//Définition de l'objet option de ce geojson
var optionsColle = {
    pointToLayer : function(feature,latlng){
        return L.marker(latlng,{icon:styleColle});
    },
    onEachFeature : afficherPopup
};

var cem = geojsonMaker(geojsonCEM,optionsColle);
var tab = [] ;
tab = tabMarker(mymap,cem);

//Definir le layer group
var layerGroupCEM = L.layerGroup(tab);
