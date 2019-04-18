//definir la fonction qui s'occupe de la generation de la popup
function afficherPopup(feature, layer){
    if (feature.Nom)
        layer.bindPopup(feature.Nom);
    else 
        layer.bindPopup("Pharmacie");
}

//Définir le style de ce geojson
var stylePhar = L.icon({
    iconUrl : "/js/carte/Images_Maps/pharmacie.svg",
    iconSize : [20,20],
    iconAnchor : [10,20],
    popupAnchor : [0,-20]
});
            
//Définition de l'objet option de ce geojson
var optionsPhar = {
    pointToLayer : function(feature,latlng){
        return L.marker(latlng,{icon:stylePhar});
    },
    onEachFeature : afficherPopup
};
            
var phar = geojsonMaker(geojsonPharmacies,optionsPhar);
var tab = [] ;
tab = tabMarker(mymap,phar);

//Definir le layer group
var layerGroupPharmacie = L.layerGroup(tab);
