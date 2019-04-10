function showDetails(id) {
    myid = null ;
    mylat = null ;
    mylng = null ;
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
            $('.typebien').empty().prepend(data.typebien);
            $('.typeaction').empty().prepend(data.typeaction);
            $('.description').empty().prepend(data.annonce.description);
            $('.addremove').html(data.titreBoutton);
            console.log(data.titreBoutton);
            myid = data.annonce.id_annonce ;
            mylat = data.annonce.lat ;
            mylng = data.annonce.lng ;
        }
    });
}
