mymap.on("move",function(){
    tab = tabMarker(mymap,alimentaion);
    layerGroupAlimentations = L.layerGroup(tab);
    if (document.getElementById("ali").checked){
        mymap.addLayer(layerGroupAlimentations);
    }
    tab = tabMarker(mymap,banque);
    layerGroupBanque = L.layerGroup(tab);
    if(document.getElementById("ban").checked){
        mymap.addLayer(layerGroupBanque);
    }
    tab = tabMarker(mymap,bibliotheque);
    layerGroupBibio = L.layerGroup(tab);
    if(document.getElementById("bib").checked){
        mymap.addLayer(layerGroupBibio);
    }
    tab = tabMarker(mymap,boucher);
    layerGroupBoucherie = L.layerGroup(tab);
    if(document.getElementById("bouch").checked){
        mymap.addLayer(layerGroupBoucherie);
    }
    tab = tabMarker(mymap,boulangerie);
    layerGroupBoulangerie = L.layerGroup(tab);
    if(document.getElementById("boul").checked){
        mymap.addLayer(layerGroupBoulangerie);
    }
    tab = tabMarker(mymap,bus);
    layerGroupBus = L.layerGroup(tab);
    if(document.getElementById("bus").checked){
        mymap.addLayer(layerGroupBus);
    }
    tab = tabMarker(mymap,cafe);
    layerGroupCafeteria = L.layerGroup(tab);
    if(document.getElementById("cafe").checked){
        mymap.addLayer(layerGroupCafeteria);
    }
    tab = tabMarker(mymap,cem);
    layerGroupCEM = L.layerGroup(tab);
    if(document.getElementById("coll").checked){
        mymap.addLayer(layerGroupCEM);
    }
    tab = tabMarker(mymap,centrecommer);
    layerGroupCentreCommerce = L.layerGroup(tab);
    if(document.getElementById("cencom").checked){
        mymap.addLayer(layerGroupCentreCommerce);
    }
    tab = tabMarker(mymap,restaurant);
    layerGroupfastfood = L.layerGroup(tab);
    if(document.getElementById("res").checked){
        mymap.addLayer(layerGroupfastfood);
    }
    tab = tabMarker(mymap,hopital);
    layerGroupHopitaux = L.layerGroup(tab);
    if(document.getElementById("hop").checked){
        mymap.addLayer(layerGroupHopitaux);
    }
    tab = tabMarker(mymap,librai);
    layerGroupLibrairie = L.layerGroup(tab);
    if(document.getElementById("lib").checked){ 
        mymap.addLayer(layerGroupLibrairie);
    }
    tab = tabMarker(mymap,lycee);
    layerGroupLycee = L.layerGroup(tab);
    if(document.getElementById("lyc").checked){
        mymap.addLayer(layerGroupLycee);
    }
    tab = tabMarkerNotPrecision(mymap,metro);
    console.log(tab);
    LayerGroupMetro = L.layerGroup(tab);
    if(document.getElementById("met").checked){
        mymap.addLayer(LayerGroupMetro);
    }
    tab = tabMarker(mymap,mosquee);
    layerGroupMosque = L.layerGroup(tab);
    if(document.getElementById("mosq").checked){
        mymap.addLayer(layerGroupMosque);
    }
    tab = tabMarker(mymap,musee);
    layerGroupMusee = L.layerGroup(tab);
    if(document.getElementById("muse").checked){
        mymap.addLayer(layerGroupMusee);
    }
    tab = tabMarker(mymap,phar);
    layerGroupPharmacie = L.layerGroup(tab);
    if(document.getElementById("phar").checked){
        mymap.addLayer(layerGroupPharmacie);
    }
    tab = tabMarker(mymap,piscine);
    layerGroupPiscine = L.layerGroup(tab);
    if(document.getElementById("pisc").checked){
        mymap.addLayer(layerGroupPiscine);
    }
    tab = tabMarker(mymap,poste);
    layerGroupPoste = L.layerGroup(tab);
    if(document.getElementById("poste").checked){
        mymap.addLayer(layerGroupPoste);
    }
    tab = tabMarker(mymap,primaire);
    layerGroupPrimaire = L.layerGroup(tab);
    if(document.getElementById("prim").checked){
        mymap.addLayer(layerGroupPrimaire);
    }
    tab = tabMarker(mymap,sport);
    layerGroupSport = L.layerGroup(tab);
    if(document.getElementById("sport").checked){ 
        mymap.addLayer(layerGroupSport);
    }
    tab = tabMarker(mymap,shop);
    layerGroupShopping = L.layerGroup(tab);
    if(document.getElementById("shop").checked){
        mymap.addLayer(layerGroupShopping);
    }
    tab = tabMarker(mymap,taxis);
    layerGroupTaxis = L.layerGroup(tab);
    if(document.getElementById("taxi").checked){
        mymap.addLayer(layerGroupTaxis);
    }
    tab = tabMarkerNotPrecision(mymap,train);
    layerGroupTrain = L.layerGroup(tab);
    if(document.getElementById("train").checked){
        mymap.addLayer(layerGroupTrain);
    }
    tab = tabMarkerNotPrecision(mymap,tram);
    layerGroupTramway = L.layerGroup(tab);
    if(document.getElementById("tram").checked){
        mymap.addLayer(layerGroupTramway);
    }
    tab = tabMarker(mymap,universite);
    layerGroupUniversite = L.layerGroup(tab);
    if(document.getElementById("uni").checked){
        mymap.addLayer(layerGroupUniversite);
    }
});
