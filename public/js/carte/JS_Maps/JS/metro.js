//definir la fonction qui s'occupe de la generation de la popup
function afficherPopup(feature, layer){
    if (feature.properties.Nom)
        layer.bindPopup(feature.properties.Nom);
    else 
        layer.bindPopup("Metro");
}

//Définir le style des markers de ce geojson
var styleMetro = L.icon({
    iconUrl : "js/carte/Images_Maps/metro.svg",
    iconSize : [20,20],
    iconAnchor : [10,20],
    popupAnchor : [0,-20]
});
            
//Définition de l'objet option de ce geojson
var optionsMetro = {
    pointToLayer : function(feature,latlng){
        return L.marker(latlng,{icon:styleMetro});
    },
    onEachFeature : afficherPopup,
	style : function(feature){
		return{
			color : "#000000",
			weight : 4
		};
	}
};
            
var metro = geojsonMaker(geojsonMetro,optionsMetro);
var tab = [] ;
tab = tabMarkerNotPrecision(mymap,metro);

//Definir le layer group
var LayerGroupMetro = L.layerGroup(tab);
