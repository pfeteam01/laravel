@extends('layouts.app',['title'=>'Creer une annonce'])
@section('content')
<h1>Deposer annonce</h1>
<div id="errors"></div>
<form method="post" enctype="multipart/form-data" id="annonce_form">
    {{ csrf_field() }}
    <div class="form-group">
        <label for="titre">Titre: </label>
        <input type="text" class="form-control" id="titre" value="{{$annonce->titre}}">
    </div>
    {{-- Apres on la transforme en liste deroulante et en filtrage --}}
    <div class="form-group">
        <label for="wilaya">Wilaya: </label>
        <input type="text" class="form-control" value="{{$annonce->wilaya}}" id="wilaya">
    </div>
    <div class="form-group">
        <label for="description">Description: </label>
        <textarea id="description" class="form-control">{{$annonce->description}}</textarea>
    </div>
    <div class="form-group">
        <label for="adresse">Addresse: </label>
        <input type="text" id="adresse" class="form-control" value="{{$annonce->adresse}}">
        <button id="btn">Afficher la carte</button>
        <div id="results"></div>
    </div>
    <div id="mapid" style="width: 400px; height: 200px;transform: translate(150%,0%);"></div>
    <div class="form-group">
        <label for="mail">Email: </label>
        <input type="email" class="form-control" value="{{$annonce->mail}}" id="mail">
    </div>
    <div class="form-group">
        <label for="tel">Telephone: </label>
        <input type="tel" class="form-control" value="{{$annonce->tel}}" id="tel">
    </div>
    <div class="form-group">
        <label for="superficie">Superficie: </label>
        <input type="number" class="form-control" value="{{$annonce->superficie}}" id="superficie">
    </div>
    <div class="form-group">
        <label for="typeaction">Type de l'action: </label>
        <select id="typeaction">
            <option {{$typeAction == 'vente' ? "selected" : "" }} value="vente">Vente</option>
            <option {{$typeAction == 'location' ? "selected" : "" }} value="location">Location</option>
            <option {{$typeAction == 'colocation' ? "selected" : "" }} value="colocation">Colocation</option>
        </select>
    </div>
    <div class="form-group" id="vente">
        <label for="prix">Prix: </label>
        <input type="number" id="prix" class="form-control" value="{{$typeActionObjet->prix ?? ''}}">
    </div>
    <div id="location">
        <div class="form-group">
            <label for="loyer">Loyer: </label>
            <input type="number" id="loyer" class="form-control" value="{{$typeActionObjet->loyer ?? ''}}">
        </div>
        <div class="form-group">
            <label for="charge">Charge: </label>
            <input type="number" id="charge" class="form-control" value="{{$typeActionObjet->charge ?? ''}}">
        </div>
        <div class="form-group">
            <label for="depotdegarantie">Dépot de garantie: </label>
            <input type="number" id="depotdegarantie" class="form-control" value="{{$typeActionObjet->depot_de_garantie ?? ''}}">
        </div>
        <div class="form-group">
            <label for="datededisponibilite">Date de disponibilité: </label>
            <input type="date" id="datededisponibilite" class="form-control" value="{{$typeActionObjet->date_de_disponibilite ?? ''}}">
        </div>
        <div class="form-group">
            <label for="dureemin">Dureé minimum: </label>
            <input type="number" id="dureemin" class="form-control" value="{{$typeActionObjet->duree_min ?? ''}}">
        </div>
    </div>
    <div id="colocation">
        <div class="form-group">
            <label for="superficiedelachambre">Superficie de la chambre : </label>
            <input type="number" id="superficiedelachambre" class="form-control" value="{{$typeActionObjet->superficie_de_la_chambre ?? ''}}">
        </div>
        <div class="form-group">
            <label for="nombrecolocataire">Nombre de colocataires:  </label>
            <input type="number" id="nombrecolocataire" class="form-control" value="{{$typeActionObjet->nombre_de_colocataires ?? ''}}">
        </div>
    </div>
    <div class="form-group">
        <label for="typebien">Type du bien: </label>
        <select id="typebien">
            <option {{$typeBien == 'appartement' ? "selected" : "" }} value="appartement">Appartement</option>
            <option {{$typeBien == 'maison' ? "selected" : "" }} value="maison">Maison</option>
            <option {{$typeBien == 'studio' ? "selected" : "" }} value="studio">Studio</option>
            <option {{$typeBien == 'terrain' ? "selected" : "" }} value="terrain">Terrain</option>
            <option {{$typeBien == 'garage' ? "selected" : "" }} value="garage">Garage</option>
        </select>
    </div>
    <div class="form-group" id="Appartement">
        <div class="form-group">
            <label for="nbpiece">Nombre de pièces: </label>
            <input type="number" class="form-control" value="{{$typeBienObjet->nb_pieces ?? ''}}" id="nbpiece">
        </div>
        <div class="form-group">
            <label for="nbchambre">Nombre de chambres: </label>
            <input type="number" class="form-control" value="{{$typeBienObjet->nb_chambres ?? ''}}" id="nbchambre">
        </div>
        <div class="form-group">
            <label for="nbwc">Nombre de toilettes: </label>
            <input type="number" class="form-control" value="{{$typeBienObjet->nb_toilettes ?? ''}}" id="nbwc">
        </div>
        <div class="form-group">
            <label for="nbbains">Nombre de salles de bain: </label>
            <input type="number" class="form-control" value="{{$typeBienObjet->nb_salles_de_bain ?? ''}}" id="nbbains">
        </div>
        <div class="form-group">
            <label for="nbbalcons">Nombre de balcons: </label>
            <input type="number" class="form-control" value="{{$typeBienObjet->nb_balcons ?? ''}}" id="nbbalcons">
        </div>
        <div class="form-group">
            <label for="numetage">Numero de l'étage: </label>
            <input type="number" class="form-control" value="{{$typeBienObjet->num_etage ?? ''}}" id="numetage">
        </div>
        <div class="form-group">
            <label for="meuble">Meublé: </label>
            <input type="checkbox" class="form-control" id="meuble" @if($typeBien == 'appartement'){{$typeBienObjet->meuble ? "checked" : "" }}@endif>
        </div>
        <div class="form-group">
            <label for="assenceur">Assenceur: </label>
            <input type="checkbox" class="form-control" id="assenceur" @if($typeBien == 'appartement'){{$typeBienObjet->assenceur ? "checked" : "" }}@endif>
        </div>
        <div class="form-group">
            <label for="parking">Parking: </label>
            <input type="checkbox" class="form-control" id="parking" @if($typeBien == 'appartement'){{$typeBienObjet->parking ? "checked" : "" }}@endif>
        </div>
        <div class="form-group">
            <label for="interphone">Interphone: </label>
            <input type="checkbox" class="form-control" id="interphone" @if($typeBien == 'appartement'){{$typeBienObjet->interphone ? "checked" : "" }}@endif>
        </div>
    </div>
    <div class="form-group" id="Maison">
        <label for="nbpiecemaison">Nombre de pièces: </label>
        <input type="number" class="form-control" value="{{$typeBienObjet->nb_pieces ?? ''}}" id="nbpiecemaison">

        <label for="nbchambremaison">Nombre de chambres: </label>
        <input type="number" class="form-control" value="{{$typeBienObjet->nb_chambres ?? ''}}" id="nbchambremaison">

        <label for="nbwcmaison">Nombre de toilettes: </label>
        <input type="number" class="form-control" value="{{$typeBienObjet->nb_toilettes ?? ''}}" id="nbwcmaison">

        <label for="nbbainsmaison">Nombre de salles de bain: </label>
        <input type="number" class="form-control" value="{{$typeBienObjet->nb_salles_de_bain ?? ''}}" id="nbbainsmaison">

        <label for="nbbalconsmaison">Nombre de balcons: </label>
        <input type="number" class="form-control" value="{{$typeBienObjet->nb_balcons ?? ''}}" id="nbbalconsmaison">

        <label for="nbetage">Nombre d'étages: </label>
        <input type="number" class="form-control" value="{{$typeBienObjet->nb_etage ?? ''}}" id="nbetage">

        <label for="meublemaison">Meublé: </label>
        <input type="checkbox" class="form-control" id="meublemaison" @if($typeBien == 'maison') {{$typeBienObjet->meuble ? "checked" : "" }}@endif>

        <label for="garagemaison">Garage: </label>
        <input type="checkbox" class="form-control" id="garagemaison" @if($typeBien == 'maison') {{$typeBienObjet->garage ? "checked" : "" }}@endif>

        <label for="jardinmaison">Jardin: </label>
        <input type="checkbox" class="form-control" id="jardinmaison"  @if($typeBien == 'maison') {{$typeBienObjet->jardin ? "checked" : "" }}@endif>
    </div>
    <div class="form-group" id="Studio">
        <label for="numetagestudio">Numero de l'étage: </label>
        <input type="number" class="form-control" value="{{$typeBienObjet->num_etage ?? ''}}" id="numetagestudio">

        <label for="meublestudio">Meublé: </label>
        <input type="checkbox" class="form-control" id="meublestudio"  @if($typeBien == 'studio'){{$typeBienObjet->meuble ? "checked" : "" }}@endif>
    </div>
    <div class="form-group" id="Terrain">
        <label for="acteprop">Acte de prop: </label>
        <input type="file" id="acteprop">
        <img src="/acte_de_prop/{{$typeBienObjet->acte_prop ?? ''}}" alt="Votre acte de prop" width="400" height="400"/>
        <br>
        <a href="/supprimeracteprop/{{$annonce->id_annonce}}" class="btn btn-success">Supprimer cet acte</a>
        <br><br><br><br>
        <label for="meubleterrain">Permis de construction: </label>
        <input type="checkbox" class="form-control" id="meubleterrain"  @if($typeBien == 'terrain'){{$typeBienObjet->permis_de_construction ? "checked" : "" }}@endif >
    </div>
    <div class="form-group" id="Garage"></div>

    <div class="form-group">
        <input type="file" id="file" multiple>
    </div>
    <ul id="charge">
        @foreach($tabAnnonceImage as $e)
            <li>
                <img src="/cover_img/{{$e->nom_image}}" alt="Image de l'annonce" width="70" height="70">
                <a href="{{url('/supprimerimageannonce/'.$e->id_image)}}" class="btn btn-link">Supprimer cette image</a>
                <br><br>
            </li>
        @endforeach
    </ul>
    <a class="btn btn-success" href="/changeetat/{{$annonce->id_annonce}}" id="changeretat">@if($annonce->etat == 1)Désactiver l'annonce @else Activer l'annonce @endif</a>
    <br><br>
    <a class="btn btn-danger" href="/supprimerannonce/{{$annonce->id_annonce}}">Supprimer l'annonce</a>
    <br><br>
    <div class="form-group">
        <input type="submit" id="valider" value="Valider" class="btn btn-success"/>
    </div>
</form>
<script type="text/javascript">
    $(document).ready(function(){
        $('#vente').hide();
        $('#location').hide();
        $('#colocation').hide();
        $('#{{$typeAction}}').show();
        $('#Appartement').hide();
        $('#Maison').hide();
        $('#Studio').hide();
        $('#Terrain').hide();
        $('#Garage').hide();
        $('#{{ucfirst($typeBien)}}').show();
        $('#typeaction').change(function () {
            $('#vente').hide();
            $('#location').hide();
            $('#colocation').hide();
            var typeAction = $('#typeaction').val();
            if (typeAction == "vente")
                $('#vente').slideDown();
            if (typeAction == "location")
                $('#location').slideDown();
            if (typeAction == "colocation"){
                $('#location').slideDown();
                $('#colocation').slideDown();
            }
        });
        $('#typebien').change(function () {
            $('#Appartement').hide();
            $('#Maison').hide();
            $('#Studio').hide();
            $('#Terrain').hide();
            $('#Garage').hide();
            var typeBien = $('#typebien').val();
            if (typeBien == "appartement")
                $('#Appartement').slideDown();
            if (typeBien == "maison")
                $('#Maison').slideDown();
            if (typeBien == "studio")
                $('#Studio').slideDown();
            if (typeBien == "terrain")
                $('#Terrain').slideDown();
            if (typeBien == "garage")
                $('#Garage').slideDown();
        });
        var addr = document.getElementById("adresse");
        mymap = L.map('mapid').setView([{{$annonce->lat}},{{$annonce->lng}}], 18);
        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            id: 'mapbox.streets'
        }).addTo(mymap);
        myMarker = L.marker([{{$annonce->lat}},{{$annonce->lng}}],{draggable:true}).addTo(mymap);
        var btn = document.getElementById("btn");
        btn.addEventListener("click",function (e) {
            e.preventDefault();
            XMLRequest();
        });
        $('#annonce_form').on('submit', function(event){
            event.preventDefault();
            var titre = $('#titre').val();
            var wilaya = $('#wilaya').val();
            var description = $('#description').val();
            var adresse = $('#adresse').val();
            var lat = myMarker.getLatLng().lat;
            var lng = myMarker.getLatLng().lng;
            var mail = $('#mail').val();
            var tel = $('#tel').val();
            var superficie = $('#superficie').val();
            var fd = new FormData();
            fd.append('id_annonce',{{$annonce->id_annonce}});
            fd.append('titre',titre);
            fd.append('wilaya',wilaya);
            fd.append('description',description);
            fd.append('adresse',adresse);
            fd.append('lat',lat);
            fd.append('lng',lng);
            fd.append('mail',mail);
            fd.append('tel',tel);
            fd.append('superficie',superficie);
            var len = $('#file')[0].files.length;
            for (var i=0;i<len;i++)
                fd.append('image'+i,$('#file')[0].files[i]);
            fd.append('len',len);
            var typeAction = $('#typeaction').val();
            if (typeAction === 'vente'){
                fd.append('prix',$('#prix').val());
            }
            else if (typeAction === 'location'){
                fd.append('loyer',$('#loyer').val());
                fd.append('charge',$('#charge').val());
                fd.append('depotdegarantie',$('#depotdegarantie').val());
                fd.append('datededisponibilite',$('#datededisponibilite').val());
                fd.append('dureemin',$('#dureemin').val());
            }
            else if (typeAction === 'colocation'){
                fd.append('loyer',$('#loyer').val());
                fd.append('charge',$('#charge').val());
                fd.append('depotdegarantie',$('#depotdegarantie').val());
                fd.append('datededisponibilite',$('#datededisponibilite').val());
                fd.append('dureemin',$('#dureemin').val());
                fd.append('superficiedelachambre',$('#superficiedelachambre').val());
                fd.append('nombrecolocataire',$('#nombrecolocataire').val());
            }
            fd.append('typeAction',typeAction);
            var typeBien = $('#typebien').val();
            if (typeBien === 'appartement'){
                fd.append('nbpiece',$('#nbpiece').val());
                fd.append('nbchambre',$('#nbchambre').val());
                fd.append('nbwc',$('#nbwc').val());
                fd.append('nbbains',$('#nbbains').val());
                fd.append('nbbalcons',$('#nbbalcons').val());
                fd.append('numetage',$('#numetage').val());
                if ($('#meuble').prop("checked"))
                    fd.append('meuble',1);
                else
                    fd.append('meuble',0);
                if ($('#assenceur').prop("checked"))
                    fd.append('assenceur',1);
                else
                    fd.append('assenceur',0);
                if ($('#parking').prop("checked"))
                    fd.append('parking',1);
                else
                    fd.append('parking',0);
                if ($('#interphone').prop("checked"))
                    fd.append('interphone',1);
                else
                    fd.append('interphone',0);
            }
            else if (typeBien === 'maison'){
                fd.append('nbpiecemaison',$('#nbpiecemaison').val());
                fd.append('nbchambremaison',$('#nbchambremaison').val());
                fd.append('nbwcmaison',$('#nbwcmaison').val());
                fd.append('nbbainsmaison',$('#nbbainsmaison').val());
                fd.append('nbbalconsmaison',$('#nbbalconsmaison').val());
                fd.append('nbetage',$('#nbetage').val());
                if ($('#meublemaison').prop("checked"))
                    fd.append('meublemaison',1);
                else
                    fd.append('meublemaison',0);
                if ($('#garagemaison').prop("checked"))
                    fd.append('garagemaison',1);
                else
                    fd.append('garagemaison',0);
                if ($('#jardinmaison').prop("checked"))
                    fd.append('jardinmaison',1);
                else
                    fd.append('jardinmaison',0);
            }
            else if (typeBien === 'studio'){
                fd.append('numetagestudio',$('#numetagestudio').val());
                if ($('#meublestudio').prop("checked"))
                    fd.append('meublestudio',1);
                else
                    fd.append('meublestudio',0);
            }
            else if (typeBien == 'terrain'){
                fd.append('acteprop',$('#acteprop')[0].files[0]);
                if ($('#meubleterrain').prop("checked"))
                    fd.append('meubleterrain',1);
                else
                    fd.append('meubleterrain',0);
            }
            else if (typeBien == 'garage'){

            }
            fd.append('typeBien',typeBien);
            fd.append('_token','{{csrf_token()}}');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"{{ url('/update') }}",
                method:"POST",
                data:fd,
                contentType: false,
                processData: false,
                dataType:'JSON',
                success:function(data) {
                    console.log(data.status+" "+data.message);
                    if (data.status == 'Success'){
                        //on pourra plus tard mettre une modale avec bootsttrap
                        alert(data.message);
                        window.location.replace('/edit/{{$annonce->id_annonce}}');
                    }else{
                        /*$.each(data.message, function(key,value){
                            alert(key+' '+value);
                        });*/
                        alert(data.message);
                        alert(data.info);
                    }
                }
            });

        });
    });
</script>
<script type="text/javascript">
    function XMLRequest() {
        var inp = document.getElementById("adresse");
        var xmlhttp = new XMLHttpRequest();
        var url = "https://nominatim.openstreetmap.org/search?format=json&limit=100&q=" + inp.value+" ,algérie";
        xmlhttp.onreadystatechange = function() {
            if (this.readyState == 4 && this.status == 200) {
                var myArr = JSON.parse(this.responseText);
                afficherResultat(myArr);
            }
        };
        xmlhttp.open("GET", url, true);
        xmlhttp.send(null);
    }
    function afficherResultat(arr){
        var out = "<br />";
        if(arr.length > 0){
            for(var i = 0; i < arr.length; i++){
                out += "<div style='cursor: pointer ;' class='address' " +
                    "title='Afficher les coordonnées de cette position'" +
                    " onclick='afficherMarqueur(" + arr[i].lat + ", " + arr[i].lon + ");return false;'>"
                    + arr[i].display_name + "</div>";
            }
            document.getElementById('results').innerHTML = out;
            afficherMarqueur(arr[0].lat,arr[0].lon);
        }
        else {
            document.getElementById('results').innerHTML = "Désolé, mais l'addresse que vous avez tapée n'a pas été trouvée, etes-vous surs que vous l'avez bien tapée ?";
        }
    }
    function afficherMarqueur(lat1, lng1){
        mymap.removeLayer(myMarker);
        myMarker = L.marker([lat1,lng1],{draggable:true}).addTo(mymap).on('dragend', function() {
            lat = myMarker.getLatLng().lat.toFixed(8);
            lon = myMarker.getLatLng().lng.toFixed(8);
            mymap.setView([lat,lon]);
        });
        mymap.setView([lat1, lng1],18);
        myMarker.setLatLng([lat1, lng1]);
    }
</script>
@endsection
