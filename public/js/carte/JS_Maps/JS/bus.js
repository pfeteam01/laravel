//definir la fonction qui s'occupe de la generation de la popup
function afficherPopup(feature, layer){
    layer.bindPopup("Gare de bus Routière");
}

//Définir le style de ce geojson
var styleBus = L.icon({
    iconUrl : "js/carte/Images_Maps/bus.svg",
    iconSize : [20,20],
    iconAnchor : [10,20],
    popupAnchor : [0,-20]
});
            
//Définition de l'objet option de ce geojson
var optionsBus = {
    pointToLayer : function(feature,latlng){
        return L.marker(latlng,{icon:styleBus});
    },
    onEachFeature : afficherPopup
};

var bus = geojsonMaker(geojsonBus,optionsBus);
var tab = [] ;
tab = tabMarker(mymap,bus);

var layerGroupBus= L.layerGroup(tab);
