function showDetails(id) {
    // j'aurais besoin de cette variable quand je detaille l'annonce car je doit envoyer cet id, idem pour quand j'ajoute une annonce à mes favoris.
    myid = null ;
    mylat = null ;
    mylng = null ;
    var fd = new FormData();
    fd.append('id',id);
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $.ajax({
        url:'/afficherdetail',
        method:"POST",
        data:fd,
        contentType: false,
        processData: false,
        dataType:'JSON',
        success:function(data) {
            console.log(data.annonce);
            $('.typebien').empty().prepend(data.typebien);
            $('.typeaction').empty().prepend(data.typeaction);
            $('.description').empty().prepend(data.annonce.description);
            if (data.personneAuth == 'web'){
                $('.addremove').html(data.titreBoutton);
            }
            else{
                $('#favoris').remove();
                $('#commander').remove();
                $('#commanderAnnonce').remove();
            }
            if (data.typeProp == 'user'){
                console.log(data.typePropObjet.id_user);
                console.log(data.typePropObjet.username);
                console.log(data.typePropObjet.mail);
            }
            else{
                console.log(data.typePropObjet.name);
                console.log(data.typePropObjet.email);
                console.log(data.typePropObjet.description);
                console.log(data.typePropObjet.wilaya);
                console.log(data.typePropObjet.adresse);
                console.log(data.typePropObjet.web_site);
                var addBtn = '<button id="contact-agence" type="button" class="btn btn-light">Contacter l\'agence</button><br>' ;
                $('#commanderAnnonce').after(addBtn);
            }
            myid = data.annonce.id_annonce ;
            mylat = data.annonce.lat ;
            mylng = data.annonce.lng ;
            //document.getElementById('cache').setAttribute('value',myid);
        }
    });
}
$('body').on('click', '#contact-agence', function() {
    alert('ggggggg');
    //Ici ca devrai nous mener vers la page de l'agence sans pouvoir faire grand chose bien sure !!!!
});
