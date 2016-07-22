/**
 * Created by fabian on 01-07-16.
 */





function mensajeConfirmacion(parameter){
    $("#mensaje_modal_header").css({backgroundColor: "#358118"});
    $("#mensaje_modal_title").html('<i class="fa fa-check-circle-o fa-2x" aria-hidden="true"></i>'+parameter["titulo"]+'').css({color:'#fff'});
    $("#mensaje_modal_body").html(parameter["body"]);
    $("#mensaje_modal_footer").html(
        '<button type="button" class="btn btn-success"  data-dismiss="modal">OK</button>');
    $('#mensaje_modal').modal('show')


}

function mensajeAdvertencia(parameter){

    $("#mensaje_modal_header").css({backgroundColor: "#ffb90f"});
    $("#mensaje_modal_title").html('<i class="fa fa-exclamation-circle fa-2x" aria-hidden="true"></i>'+parameter["titulo"]+'').css({color:'#fff'});
    $("#mensaje_modal_body").html(parameter["body"]);
    $("#mensaje_modal_footer").html(
        '<button type="button" class="btn btn-warning"  data-dismiss="modal">OK</button>');
    $('#mensaje_modal').modal('show')



}

function mensajeDeletes(name,id){
    var id = id;
    $("#mensaje_modal_header").css({backgroundColor: "#c9302c"});
    $("#mensaje_modal_title").html("Se eliminara <strong>" + name +"</strong>").css({color:'#fff'});
    $("#mensaje_modal_body").html("<h4>¿Esta seguro de eliminar <strong>" + name +" </strong>?</h4>");
    $("#mensaje_modal_footer").html(
        '<a type="button" class="btn btn-danger" onclick="'+id+'" >Si, eliminar</a>' +
        '<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>');
    $('#mensaje_modal').modal('show')


}


function mensajeAprobacion(name,id,request){
    if(request==='si'){
        var color ={backgroundColor: "#46b8da"}
        var titulo = "Aprobacion solicitud <strong>" + name +"</strong>"
        var body = "<h4>¿Esta seguro de aprobar la solicitud <strong>" + name +" </strong>?</h4>";
        var aprobacion = "'"+request+"'"
        var boton ='<a type="button" class="btn btn-info" onclick="aprobarvale('+aprobacion+','+id+')" >Si, Aprobar</a>' +
            '<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>'
    }

if(request==='no'){
    var color = {backgroundColor: "#d43f3a"}
    var titulo = "Desaprobar solicitud <strong>" + name +"</strong>"
    var body = "<h4>¿Esta seguro de desaaprobar la solicitud <strong>" + name +" </strong>?</h4>";
    var aprobacion = "'"+request+"'"
    var boton ='<a type="button" class="btn btn-danger" onclick="aprobarvale('+aprobacion+','+id+')" >Si, Desaprobar</a>' +
    '<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>'
}

    $("#mensaje_modal_header").css(color);
    $("#mensaje_modal_title").html(titulo).css({color:'#fff'});
    $("#mensaje_modal_body").html(body);
    $("#mensaje_modal_footer").html(boton);
    $('#mensaje_modal').modal('show');



}