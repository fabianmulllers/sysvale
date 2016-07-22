function viewsolicitud(id){


    // Envio ajax

    var id=id;
    var url = $("#route_show").val().replace('id',id);
   var parameter={
        'id':id,
         '_token':$('#_token').val(),
    }
    $.ajax({
        data:parameter,
        url:url,
        type:'GET',

        BeforeSend :function(){

        },
        success: function(response){
            $('#view-modal').html(response);
            viewmodal(id);


        },

    });
}

function desbloquear (id){

    var id = id;
    var url = $('#route_desbloqueo').val().replace('id',id);
    var _token= $('#_token').val();
    var parameter= {
        'id': id,
        '_token': _token

};

$.ajax({
        data:parameter,
        url:url,
        type:'GET',
success:function(response){

    $('#fields_modal').modal('hide');

    }
    });

}


function viewmodal(id){

    $("#fields_modeal_header");
    $("#myModalLabel_fields").css({color: '#008b8b'});
  /*  $("#fiels_modal_footer").append(
        '<a class="btn btn-default" onclick="desbloquear('+id+')"> cancelar</a>'
    );*/
    $('#fields_modal').modal('show');


}

function aprobarvale(request,id){
    var request = request;
    var id = id;
    var url = $("#route_aprobarvale").val();
    var _token= $('#_token').val();
   var parameter={
        'request':request,
       'id':id,
       '_token':_token,

    }
    $.ajax({
        data:parameter,
         url:url,
        type:'POST',

     success:function (response) {
         actualizarPaneles();
         mensajeConfirmacion(response);
         $("#fields_modal").modal('hide');

     },

    });

}