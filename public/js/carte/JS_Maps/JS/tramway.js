//definir la fonction qui s'occupe de la generation de la popup
function afficherPopup(feature, layer){
    if (feature.properties.Nom)
        layer.bindPopup(feature.properties.Nom);
    else 
        layer.bindPopup("TramWay");
}

//Définir le style de ce geojson
var styleTram = L.icon({
    iconUrl : "/js/carte/Images_Maps/tramway.ico",
    iconSize : [20,20],
    iconAnchor : [10,20],
    popupAnchor : [0,-20]
});
            
//Définition de l'objet option de ce geojson
var optionsTram = {
    pointToLayer : function(feature,latlng){
        return L.marker(latlng,{icon:styleTram});
    },
    onEachFeature : afficherPopup,
	style : function(feature){
		return{
			color : "#FFD700",
			weight : 4
		};
	}
};
            
var tram = geojsonMaker(geojsonTramway,optionsTram);
var tab = [] ;
tab = tabMarkerNotPrecision(mymap,tram);

//Definir le layer group
var layerGroupTramway = L.layerGroup(tab);
