$('.find').change(function(){
    var fd = new FormData();
    if($('#vente').prop('checked')){
        fd.append('vente',1);
    }else{
        fd.append('vente',0);
    }
    if($('#location').prop('checked')){
        fd.append('location',1);
    }else{
        fd.append('location',0);
    }
    if($('#colocation').prop('checked')){
        fd.append('colocation',1);
    }else{
        fd.append('colocation',0);
    }
    if($('#appartement').prop('checked')){
        fd.append('appartement',1);
    }else{
        fd.append('appartement',0);
    }
    if($('#maison').prop('checked')){
        fd.append('maison',1);
    }else{
        fd.append('maison',0);
    }
    if($('#studio').prop('checked')){
        fd.append('studio',1);
    }else{
        fd.append('studio',0);
    }
    if($('#terrain').prop('checked')){
        fd.append('terrain',1);
    }else{
        fd.append('terrain',0);
    }
    if($('#garage').prop('checked')){
        fd.append('garage',1);
    }else{
        fd.append('garage',0);
    }
    var pMinVar = 0;
    var prixMin = $('#prixmin').val();
    if (prixMin == "pmin" || prixMin == "0"){
        pMinVar = 0 ;
    }else{
        pMinVar = parseInt(prixMin);
    }
    fd.append('prixmin',pMinVar);
    var pMaxVar = 0;
    var prixMax = $('#prixmax').val();
    if (prixMax == "pmax" || prixMax == "0"){
        pMaxVar = Number.MAX_VALUE ;
    }else{
        pMaxVar = parseInt(prixMax);
    }
    fd.append('prixmax',pMaxVar);
    var lMinVar = 0;
    var loyerMin = $('#loyermin').val();
    if (loyerMin == "lmin" || loyerMin == "0"){
        lMinVar = 0 ;
    }else{
        lMinVar = parseInt(loyerMin);
    }
    fd.append('loyermin',lMinVar);
    var lMaxVar = 0;
    var loyerMax = $('#loyermax').val();
    if (loyerMax == "lmax" || loyerMax == "0"){
        lMaxVar = Number.MAX_VALUE ;
    }else{
        lMaxVar = parseInt(loyerMax);
    }
    fd.append('loyermax',lMaxVar);
    if($('#one').prop("checked"))
        fd.append('onepiece',1);
    else
        fd.append('onepiece',0);
    if($('#two').prop("checked"))
        fd.append('twopieces',1);
    else
        fd.append('twopieces',0);
    if($('#three').prop("checked"))
        fd.append('threepieces',1);
    else
        fd.append('threepieces',0);
    if($('#four').prop("checked"))
        fd.append('fourpieces',1);
    else
        fd.append('fourpieces',0);
    if($('#five').prop("checked"))
        fd.append('fivepieces',1);
    else
        fd.append('fivepieces',0);
    if($('#six').prop("checked"))
        fd.append('sixpieces',1);
    else
        fd.append('sixpieces',0);
    if($('#seven').prop("checked"))
        fd.append('sevenpieces',1);
    else
        fd.append('sevenpieces',0);
    if($('#eightandmore').prop("checked"))
        fd.append('eightandmorepieces',1);
    else
        fd.append('eightandmorepieces',0);
    if($('#oneetage').prop("checked"))
        fd.append('oneetage',1);
    else
        fd.append('oneetage',0);
    if($('#twoetage').prop("checked"))
        fd.append('twoetages',1);
    else
        fd.append('twoetages',0);
    if($('#threeetage').prop("checked"))
        fd.append('threeetages',1);
    else
        fd.append('threeetages',0);
    if($('#fouretage').prop("checked"))
        fd.append('fouretages',1);
    else
        fd.append('fouretages',0);
    if($('#fiveetage').prop("checked"))
        fd.append('fiveetages',1);
    else
        fd.append('fiveetages',0);
    if($('#sixetage').prop("checked"))
        fd.append('sixetages',1);
    else
        fd.append('sixetages',0);
    if($('#sevenetage').prop("checked"))
        fd.append('sevenetages',1);
    else
        fd.append('sevenetages',0);
    if($('#eightandmoreetage').prop("checked"))
        fd.append('eightandmoreetages',1);
    else
        fd.append('eightandmoreetages',0);
    var sminvar = 0;
    var surfacemin = $('#surfacemin').val();
    if (surfacemin == 'smin' || surfacemin == 0){
        sminvar = 0 ;
    }else{
        sminvar = parseInt(surfacemin);
    }
    fd.append('surfacemin',sminvar);
    var smaxvar = 0;
    var surfacemax = $('#surfacemax').val();
    if (surfacemax == 'smax'){
        smaxvar = Number.MAX_VALUE ;
    }else{
        smaxvar = parseInt(surfacemax);
    }
    fd.append('surfacemax',smaxvar);
    var datevar;
    var date = $('#datedepublication').val();
    if (date == 'all')
        datevar = -1 ;
    else
        datevar = parseInt(date);
    fd.append('datedepublication',datevar);
    fd.append('_token','{{csrf_token()}}');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url:'/find',
        method:"POST",
        data:fd,
        contentType: false,
        processData: false,
        dataType:'JSON',
        success:function(data) {
            mymap.eachLayer(function (layer) {
                if (layer instanceof L.CircleMarker)
                    mymap.removeLayer(layer);
            });
            $('#annonces').empty();
            var tab = [];
            var annonces = '';
            for ( i = 0 ;i< data.annonce.length ; i++){
                if (data.mesfavoris[i] == 0){
                    var circleMarkerAnnonce = L.circleMarker( [data.annonce[i].lat , data.annonce[i].lng], {
                        radius: 15,
                        fillColor: "#ff0097",
                        color: "#000",
                        weight: 1,
                        opacity: 1,
                        fillOpacity: 0.8
                    });
                    trouvInFav = 0 ;
                }
                else{
                    var circleMarkerAnnonce = L.circleMarker( [data.annonce[i].lat , data.annonce[i].lng], {
                        radius: 15,
                        fillColor: "#fff",
                        color: "#000",
                        weight: 1,
                        opacity: 1,
                        fillOpacity: 0.8
                    });
                    trouvInFav = 1 ;
                }

                var bounds = mymap.getBounds();
                if (bounds.contains(circleMarkerAnnonce.getLatLng()) && data.annonce[i].etat == 1){
                    tab.push(circleMarkerAnnonce);
                    var nom_image = null ;
                    if (data.image[i].length != 0)
                        nom_image = data.image[i][0].nom_image;
                    else
                        nom_image = 'ImageAnnonceParDefault.jpg' ;
                    annonces +=
                        '<div ' +
                        ' style="background-color: #1b1e21; width: 300px; height: 400px; color: white" ' +
                        ' data-lat="'+data.annonce[i].lat+'" ' +
                        ' data-lng="'+data.annonce[i].lng+'" ' +
                        ' onmouseenter="activerMarker(this,mymap)" ' +
                        ' onmouseleave="resetMarker(this,mymap,'+trouvInFav+')"' +
                        ' data-toggle="modal"' +
                        ' data-target="#myModal" ' +
                        ' onclick="showDetails('+data.annonce[i].id_annonce+');">'+
                        '<img width="300" height="200" src="cover_img/'+nom_image+'"><br>'+
                        data.annonce[i].titre+'<br>'+
                        data.annonce[i].description+'<br>'+
                        data.typebien[i]+'<br>'+
                        data.typeaction[i]+'<br>'+
                        '</div>' +
                        '<br/>';
                    //Il faut pas oublier de personaliser cette grille de div et d'ajouter les infos tirées des autres tableaux.
                }
            }
            var lg = new L.LayerGroup(tab);
            mymap.addLayer(lg);
            if (tab.length == 0)
                annonces = 'Nothing to show ...';
            document.getElementById('annonces').innerHTML = annonces;
        }
    });
});
