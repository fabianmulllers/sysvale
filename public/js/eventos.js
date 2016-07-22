/*function lock_departamentos() {

    if($("#contenedor").is(":visible")){
        $("#name_departamento").hide();
        $("#contenedor").hide();
        $("#lock").html('<i class="fa fa-unlock-alt" aria-hidden="true"></i>');

    }else{
        $("#name_departamento").show();
        $("#contenedor").show();
        $("#lock").html('<i class="fa fa-lock" aria-hidden="true"></i>');

    }
}

/*function add_departamentos() {
    var x = $("#contenedor div").length;
    if(x===0){
        num=0;
    }else{
        num=x/5;
    }
    num++;
   alert(num);
    $("#contenedor").append(
        ' <div id="diverror_name_departamento" class="form-group row '+num+ ' ">'+
        '<div class="col-md-3">'+

        ' </div>'+
        '<div class="col-md-6">'+

        '</div>'+
        '<div class="col-md-1">'+
    '<a class="btn btn-danger" onclick="eliminarCampoDepartamento('+num+')"><i class="fa fa-times" aria-hidden="true"></i>'+
    '</a>'+
    '</div>'+
    '<div class="col-md-1">'+


    '</a>'+
    '</div>'+

    '</div>'



);
}*/
/*
function eliminarCampoDepartamento(num){

$("."+num).hide();
$("#select_"+num).html("");

}*/
//var totales = [22];
var productos = [22];
function select_tipo(tipo){

    var url =  $("#route_selecttype").val();
    if(tipo==='empresa'){
      var  valor=$("#type").val();
    }else{
      var  valor=$("#select_empresa").val();
    }
    var parametros= {
        'valor':valor,
        '_token' :$("#_token").val(),
        'tipo':tipo
}

    $.ajax({
        data:parametros,
        url: url,
        type: 'post',
        beforeSend: function () {

        },
        success: function (response) {
            $("#contenedor_"+tipo).html(response);
            $('.selectpicker').selectpicker('show');

        }, error: function(response){


        }
    });
}

function generarTablas(numero) {
    $('#tabla > tbody').children('tr:not(:first)').remove();
    total=numero;
    numero=numero-1;
    for (var i = 0; i <= numero; i++) {
        $('#tabla tr:last').after('<tr id="resultado' + i + '">' +
            '<td><div id="diverror_codproducto'+i+'"><input id="codproducto'+i+'" class="form-control" type="search"   name="codproducto[]" placeholder="EJ: 04008006"  required    onkeyup="buscarproductos(' + i + ')" > <span id="error_codproducto'+i+'"class="help-block" style="display: none;"></span></div></td> ' +
            '<td></td>' +
            '<td class="col-md-1"></td>' +
            '<td class="col-md-1"></td>' +
            '<td class="col-md-1"></td>' +
            '<td class="col-md-1"><a class="btn btn-danger btn-xs" onclick="eliminarFila(' + i + ')"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a></td></tr>');
    }
    $("#enviar").show();
    $("#totalproduct").val(total);
    if (numero >= 22) {
        $('#agregarfila').hide();


    } else {
        if ($('#agregarfila').is(':hidden')) {
            $('#agregarfila').show();
        }


    }

}
function productoingresado(codproducto) {

    var resultado = 0;

    for (i = 0; i < productos.length; i++) {

        if (productos[i] == codproducto) {

            resultado = 1;
        }

    }

    return resultado;
}

function buscarproductos( id) {
    var codproducto= $("#codproducto"+id).val();
    if (productoingresado(codproducto) == 0) {

        var link = $("#url").val();
        var token = $("#_token").val();
        var parametros = {

            "id": codproducto,
            "_token": token
        };
        $.ajax({
            data: parametros,
            url: link,
            type: 'post',
            beforeSend: function () {
                //$("#resultado").html("Procesando, espere por favor...");
            },
            success: function (response) {
                //alert(response.name_product);

                if (response.message === "no") {
                    productos[id] = null;
                    $("#resultado" + id).find("td:gt(0)").remove();
                    $('#resultado' + id + ' td:last')
                        .after('<td></td>' +
                               '<td class="col-md-1"></td>' +
                               '<td class="col-md-1"></td>' +
                               '<td class="col-md-1"></td>' +
                               '<td class="col-md-1"><a class="btn btn-danger btn-xs"onclick="eliminarFila(' + id + ')"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a></td>');
                } else {
                    productos[id] = codproducto;
                    $("#resultado" + id).find("td:gt(0)").remove();
                    // $('#resultado' + id + ' td:last').after(response + '<td><a class="btn btn-link btn-xs"onclick="eliminarFila(' + id + ')"><font color ="red">Eliminar</font><span class="glyphicon glyphicon-remove" style="color:red"></span></a></td>');
                    $('#resultado' + id + ' td:last').after('<td><input id="nameproduct'+id+'"    class="form-control input-sm" OnFocus="this.blur()" name="nameproduct'+id+'"   value= '+response.name_product+' ></div></td>' +
                        '<td class="col-md-1"><input id="stockproduct'+id+'"    class="form-control input" OnFocus="this.blur()" name="stockproduct'+id+'"   value= '+response.stock_product+' ></div></td> ' +
                        '<td class="col-md-1"><input id="precioproduct'+id+'"    class="form-control input-sm" OnFocus="this.blur()" name="precioproduct'+id+'"   value= '+response.precio_product+' ></div></td>' +
                        '<td class="col-md-1"><input id="cantidad'+id+'"    class="form-control input-sm"  name="cantidad'+id+'"  required ></div></td>' +
                        '<td class="col-md-1"><a class="btn btn-danger btn-xs"onclick="eliminarFila(' + id + ')"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a></td>');
                    //$("#resultado").html(response);
                }
            }
        });
    } else {
      
    }
}

function enviarValeConsumo() {

    var  link = $("#urlingreso").val();
    var _token = $("#_token").val();
    var x=0;
    $.each($('#form').serializeArray(), function(i, field) {

        if(field.name==='codproducto[]'){
            field.name='codproducto'+x;
            x++;
        }
        $("#diverror_"+field.name).removeClass("has-error");
        $("#error_"+field.name).hide().html();
    });


    $.ajax({
        data: $("#form").serialize(),
        url: link,
        type: 'post',
        beforeSend: function () {
            //$("#resultado").html("Procesando, espere por favor...");
        },
        success: function (response) {

            var parameter = {
                'tipo':'confirmacion',
                'id':response.id,
                'name_vale':response.name_vale
            }
           actualizarPaneles();
            mensajeConfirmacion(response);
            $('#fields_modal').modal('hide');
        }, error:function(response){
            var errors = response.responseJSON;
            $.each(errors , function(index,value){
                index=index.replace('.','');
                $("#diverror_"+index).addClass("has-error")

                $("#error_"+index).show().html("<strong>"+value+"</strong>");
            });

        }
    });

}


function eliminarFila(numero) {
    $("#resultado" + numero + "").hide();
    $("#codproducto"+numero).val('').removeAttr('required');
    $("#descripcion" + numero).remove();
    $("#precio" + numero).remove();
    $("#cantidad" + numero).remove();
    $("#saldo" + numero).remove();
    productos[numero] = null;
    totales[numero] = "";
    totalessuma();

    var tablasvicibles = $('#tabla > tbody > tr:visible').length
    if (tablasvicibles < 22) {
        $('#agregarfila').show();

    }

}
function ingresarVale(){
    $("#fields_modeal_header").css({backgroundColor: "#74d600"});
    $("#myModalLabel_fields").html('<i class="fa fa-location-arrow" aria-hidden="true"></i> Enviar Solicitud Vale Consumo').css({color:'#fff'});
    $("#fiels_modal_footer").html(
        '<a class="btn btn-primary "  onclick="enviarValeConsumo()" submit" style="display: none ;background-color: #009900" id="enviar">enviar </a>'+
       '<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>');
    $('#form')[0].reset();
    eliminartabla();
    $('#fields_modal').modal('show')
    $('.selectpicker').selectpicker('refresh');
}


function eliminartabla(){

   $("#tabla tbody>").remove();
    $("#tabla tbody").html('<tr></tr>')
}


function eliminarSolicitudAjax(id) {

    var id = id;
    var form = $("#form-delete");
    var url = form.attr('action').replace(':VALE_ID', id);
    var data = form.serialize();
    $.ajax({
        data: data,
        url: url,
        type: 'DELETE',
        beforeSend: function () {

        },
        success: function (response) {
            //$("#mensaje_modal").modal("hide");
            //mensajeConfirmacionEliminar(response.name);
            //$('#form_delete')[0].reset();
            // $('#mensaje_modal').modal('hide');
            mensajeConfirmacion(response);
            //$("#div_"+id).fadeOut();
            actualizarPaneles();


        }, error: function (response) {
            var array=[];
            var errors = response.responseJSON;
            $.each(errors , function(index,value){
              array[index]=value;
            });

           mensajeAdvertencia(array);

        }
    });

}

    function editarSolicitud(id){

        var id = id;
        var url = $("#route_editar").attr('value').replace('id', id);
        $.ajax({
            data: id,
            url: url,
            type: 'get',
            beforeSend: function () {
            },
            success: function (response) {

                $("#fields_modeal_header").css({backgroundColor: "#660066"});
                $("#myModalLabel_fields").html('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Editar Solicitud').css({color: '#fff'});
                $("#fiels_modal_footer").html(
                    '<a class="btn " style="background-color: #660066; color: #fff"  onclick="editarSolicitudAjax('+id+')"> Editar</a>' +
                    ' <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>');

                $('#fields_modal').modal('show');


                $.each(response, function (index, value) {
                    if(index == 'tbody'){
                     $("#"+index).html(value);
                    }
                    if(index=='departamentos') {
                        if (value != '') {

                            setTimeout(function () {
                                $('#select_departamento').selectpicker('val', value);
                            }, 300);

                        }
                    }
                    $("#" + index).val(value);


                });

            },
            error:function(response){
                var array=[];
                var errors = response.responseJSON;
                $.each(errors , function(index,value){
                    array[index]=value;
                });

                mensajeAdvertencia(array);

            }
        });

    }

function editarSolicitudAjax(id){
    var form = $("#form_edit");
    var id=id;
    var url =  form.attr('action').replace(':VALE_ID',id);
    var x=0;
    $.each($('#form').serializeArray(), function(i, field) {

        if(field.name==='codproducto[]'){
            field.name='codproducto'+x;
            x++;
        }
        $("#diverror_"+field.name).removeClass("has-error");
        $("#error_"+field.name).hide().html();
    });
    $.ajax({
        data: $("#form").serialize(),
        url: url,
        type: 'PUT',
        beforeSend: function () {

        },
        success: function (response) {
            mensajeConfirmacion(response);
            $('#form')[0].reset();
            $("#fields_modal").modal("hide");
            actualizarPaneles();
        }, error: function(response){
            var errors = response.responseJSON;
            $.each(errors , function(index,value){
                index=index.replace('.','');
                $("#diverror_"+index).addClass("has-error")

                $("#error_"+index).show().html("<strong>"+value+"</strong>");
            });

        }
    });


}

function vernotificacion(){

    var _token=$('#_token').val();
    var url = $('#route_notificacion').val();
    var parameter={
        '_token':_token,
    }

    $.ajax({
        data:parameter,
        url:url,
        type:'POST',
        success :function(response){
            if(response != ''){

                alert(response.mensaje);

            }


        }
    })  ;

}

