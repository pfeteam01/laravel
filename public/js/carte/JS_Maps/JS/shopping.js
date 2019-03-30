//definir la fonction qui s'occupe de la generation de la popup
function afficherPopup(feature, layer){
    if (feature.Nom)
        layer.bindPopup(feature.Nom);
    else 
        layer.bindPopup("Shopping");
}

//Définir le style de ce geojson
var styleShop = L.icon({
    iconUrl : "js/carte/Images_Maps/shopping.svg",
    iconSize : [20,20],
    iconAnchor : [10,20],
    popupAnchor : [0,-20]
});
            
//Définition de l'objet option de ce geojson
var optionsShop = {
    pointToLayer : function(feature,latlng){
        return L.marker(latlng,{icon:styleShop});
    },
    onEachFeature : afficherPopup
};
            
var shop = geojsonMaker(geojsonShopping,optionsShop);
var tab = [] ;
tab = tabMarker(mymap,shop);

//Definir le layer group
var layerGroupShopping = L.layerGroup(tab);
