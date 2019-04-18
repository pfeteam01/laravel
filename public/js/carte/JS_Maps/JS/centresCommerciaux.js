//definir la fonction qui s'occupe de la generation de la popup
function afficherPopup(feature, layer){
    if (feature.Nom)
        layer.bindPopup(feature.Nom);
    else 
        layer.bindPopup("Centre Commercial");
}

//Définir le style de ce geojson
var styleCenComm = L.icon({
    iconUrl : "/js/carte/Images_Maps/centreCommercial.svg",
    iconSize : [20,20],
    iconAnchor : [10,20],
    popupAnchor : [0,-20]
});
            
//Définition de l'objet option de ce geojson
var optionsCenComm = {
    pointToLayer : function(feature,latlng){
        return L.marker(latlng,{icon:styleCenComm});
    },
    onEachFeature : afficherPopup
};

            
var centrecommer = geojsonMaker(geojsonCentresCommerciaux,optionsCenComm);
var tab = [] ;
tab = tabMarker(mymap,centrecommer);

//Definir le layer group
var layerGroupCentreCommerce = L.layerGroup(tab);
