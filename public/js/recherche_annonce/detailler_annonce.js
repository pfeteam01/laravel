function showDetails(id) {
    myid = null ;
    var fd = new FormData();
    fd.append('id',id);
    fd.append('_token','{{csrf_token()}}');
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
            console.log(data.typeaction);
            console.log(data.typeactionobj);
            console.log(data.typebien);
            console.log(data.typebienobj);
            console.log(data.images);
            //Maintemant c'est le coté design qui va determiner comment et où vont s'afficher chaque donnée que on a recolté et comment va etre organiser notre affichage de details.
            // j'aimerais bien réussir à l'invoquer dans un modal
            $('.typebien').empty().prepend(data.typebien);
            $('.typeaction').empty().prepend(data.typeaction);
            $('.description').empty().prepend(data.annonce.description);
            var titreButton = "Ajouter à mes favoris" ; //null
            //if (ca existe dans la table favoris ==> titreButton = retirer de mes favoris sinon Ajouter à mes favoris)
            $('.addremove').empty().prepend(titreButton);
            document.getElementById('commander').setAttribute('onclick',"alert("+data.annonce.id_annonce+");");
            //ce boutton affiche le formulaire qui est par défault cachée.
            myid = data.annonce.id_annonce ;
        }
    });
}
