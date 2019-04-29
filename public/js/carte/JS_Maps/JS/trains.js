//definir la fonction qui s'occupe de la generation de la popup
function afficherPopup(feature, layer){
    if (feature.Nom)
        layer.bindPopup(feature.Nom);
    else 
        layer.bindPopup("Train");
}

//Définir le style de ce geojson
var styleTrain = L.icon({
    iconUrl : "/js/carte/Images_Maps/train.svg",
    iconSize : [20,20],
    iconAnchor : [10,20],
    popupAnchor : [0,-20]
});
            
//Définition de l'objet option de ce geojson
var optionsTrain = {
    pointToLayer : function(feature,latlng){
        return L.marker(latlng,{icon:styleTrain});
    },
    onEachFeature : afficherPopup,
	style : function(feature){
		return{
			color : "#FF1493",
			weight : 4
		};
	}
};
            
var train = geojsonMaker(geojsonTrains,optionsTrain);
var tab = [] ;
tab = tabMarkerNotPrecision(mymap,train);

//Definir le layer group
var layerGroupTrain = L.layerGroup(tab);
