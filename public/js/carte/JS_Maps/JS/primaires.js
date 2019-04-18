//definir la fonction qui s'occupe de la generation de la popup
function afficherPopup(feature, layer){
    if (feature.Nom)
        layer.bindPopup(feature.Nom);
    else 
        layer.bindPopup("Primaire");
}

//Définir le style de ce geojson
var stylePrimaire = L.icon({
    iconUrl : "/js/carte/Images_Maps/primaire.svg",
    iconSize : [20,20],
    iconAnchor : [10,20],
    popupAnchor : [0,-20]
});
            
//Définition de l'objet option de ce geojson
var optionsPrimaire = {
    pointToLayer : function(feature,latlng){
        return L.marker(latlng,{icon:stylePrimaire});
    },
    onEachFeature : afficherPopup
};
            
var primaire = geojsonMaker(geojsonPrimaires,optionsPrimaire);
var tab = [] ;
tab = tabMarker(mymap,primaire);

//Definir le layer group
var layerGroupPrimaire = L.layerGroup(tab);
