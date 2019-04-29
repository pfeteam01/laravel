@extends('layouts.app',['title'=>'Carte'])
@section('content')
    <div id="annonces"></div>
    <div id="mapid" style="width: 850px; height: 600px; position: fixed; top: 50% ; left: 60% ;transform: translate(-50%,-50%);"></div>
    {{-- C'est le partial qui contient le formulaire de cases à cocher qui permet de faire apparaitre les musées, les trains etc... --}}
    @include('layouts.partials._filter_search_carte')
    <script>
        mymap = L.map('mapid').setView([36.752089156946326,3.065185546875], 13);
        L.tileLayer('https://api.tiles.mapbox.com/v4/{id}/{z}/{x}/{y}.png?access_token=pk.eyJ1IjoibWFwYm94IiwiYSI6ImNpejY4NXVycTA2emYycXBndHRqcmZ3N3gifQ.rJcFIG214AriISLbB6B5aw', {
            maxZoom: 18,
            id: 'mapbox.streets'
        }).addTo(mymap);
    </script>
    {{-- C'est le partial qui contient le formulaire de recherche --}}
    @include('layouts.partials._form_de_recherche')
     {{--C'est le partial qui contient le chargement des scripts qui permette de gerer la carte (filtrer et faire apparaitre les éléments etc...) --}}
    @include('layouts.partials._load_files_script_filter_map')

    <script src="js/recherche_annonce/script_load.js"></script>
    <script src="js/recherche_annonce/script_change.js"></script>
    <script src="js/recherche_annonce/script_move.js"></script>
    <script src="js/recherche_annonce/detailler_annonce.js"></script>
    {{--C'est le partial qui permet d'afficher le modale qui detaille l'annonce--}}
    @include('layouts.partials._modale_for_detailler_annonce')
    <script>
        {{--La gestion des évènements du formulaire de commander concernant le modale pour afficher les informations d'une annonce--}}
        $('#myModal').on('hidden.bs.modal',function(){
            $('#message').removeClass('is-invalid').val("");
            $('#mail').removeClass('is-invalid').val("");
            $('#tel').removeClass('is-invalid').val("");
            $('.typebien').empty();
            $('.typeaction').empty();
            $('.description').empty();
        });
        //La gestion de la fonction de commande
        $('#commanderAnnonce').on('submit',function (e) {
            e.preventDefault();
            var fd = new FormData();
            fd.append('id_annonce',myid);
            fd.append('mail',$('#mail').val());
            fd.append('tel',$('#tel').val());
            fd.append('message',$('#message').val());
            fd.append('_token','{{csrf_token()}}');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"{{url('/commander')}}",
                method:"POST",
                data:fd,
                contentType: false,
                processData: false,
                dataType:'JSON',
                success:function(data) {
                    if (data.status == 'Success')
                        console.log(data.message);
                    else{
                        $.each(data.message, function(key,value){
                            console.log(key+" "+value);
                        });
                        if (data.message.hasOwnProperty('message')){
                            $('#message').addClass('is-invalid');
                        }
                        if (data.message.hasOwnProperty('mail')){
                            $('#mail').addClass('is-invalid');
                        }
                        if(data.message.hasOwnProperty('tel')){
                            $('#tel').addClass('is-invalid');
                        }
                    }
                }
            });
        });
        //La gestion des facoris.
        $('#favoris').on('click',function () {
            var fd = new FormData();
            fd.append('id_annonce',myid);
            fd.append('_token','{{csrf_token()}}');
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                url:"{{ url('/ajouterfavoris') }}",
                method:"POST",
                data:fd,
                contentType: false,
                processData: false,
                dataType:'JSON',
                success:function(data) {
                    $('.addremove').html(data.titreBouton);
                    var c = recupererItem(mymap,mylat,mylng);
                    if (data.status == 0){
                        c.setStyle({
                            radius: 15,
                            fillColor: "#ff0097",
                            color: "#000",
                            weight: 1,
                            opacity: 1,
                            fillOpacity: 0.8
                        });
                    }
                    else{
                        c.setStyle({
                            radius: 15,
                            fillColor: "#fff",
                            color: "#000",
                            weight: 1,
                            opacity: 1,
                            fillOpacity: 0.8
                        });
                    }
                }
            });
        });
    </script>
@stop
