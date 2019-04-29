//definir la fonction qui s'occupe de la generation de la popup
function afficherPopup(feature, layer){
    if (feature.Nom)
        layer.bindPopup(feature.Nom);
    else 
        layer.bindPopup("Salle de sport");
}

//Définir le style de ce geojson
var styleSport = L.icon({
    iconUrl : "/js/carte/Images_Maps/sportetfitness.svg",
    iconSize : [20,20],
    iconAnchor : [10,20],
    popupAnchor : [0,-20]
});
            
//Définition de l'objet option de ce geojson
var optionsSport = {
    pointToLayer : function(feature,latlng){
        return L.marker(latlng,{icon:styleSport});
    },
    onEachFeature : afficherPopup
};
            
var sport = geojsonMaker(geojsonSallesDeSportEtFitness,optionsSport);
var tab = [] ;
tab = tabMarker(mymap,sport);

//Definir le layer group
var layerGroupSport = L.layerGroup(tab);
