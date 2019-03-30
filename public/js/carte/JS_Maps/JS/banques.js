//definir la fonction qui s'occupe de la generation de la popup
function afficherPopup(feature, layer){
    if (feature.Nom)
        layer.bindPopup(feature.Nom);
    else 
        layer.bindPopup("Banque");
}

//Définir le style de ce geojson
var styleBanque = L.icon({
    iconUrl : "js/carte/Images_Maps/banque.svg",
    iconSize : [20,20],
    iconAnchor : [10,20],
    popupAnchor : [0,-20]
});
            
//Définition de l'objet option de ce geojson
var optionsBanque = {
    pointToLayer : function(feature,latlng){
        return L.marker(latlng,{icon:styleBanque});
    },
    onEachFeature : afficherPopup
};
            
var banque = geojsonMaker(geojsonBanques,optionsBanque);
var tab = [] ;
tab = tabMarker(mymap,banque);

var layerGroupBanque = L.layerGroup(tab);
