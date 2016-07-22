var totales = [22];
var productos = [22];

function logout() {

    var parametros = {
        "action": 'logout'
    };
    $.ajax({
        data: parametros,
        url: '../controlador/usuario.php',
        type: 'post',
        beforeSend: function () {
            $("#resultado").html("Procesando, espere por favor...");
        },
        success: function (response) {
            location.href = "index.php";
            $("#resultado").html(response);

        }
    });
}


function buscarproducto(codproducto, id) {
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
                    $('#resultado' + id + ' td:last').after('<td></td><td><div class="col-xs-8"></div></td><div class="col-xs-8"></div><td><div class="col-xs-8"></div></td><div class="col-xs-8"></div><td><div class="col-xs-8"></div></td><td><a class="btn btn-link btn-xs"onclick="eliminarFila(' + id + ')"><font color ="red">Eliminar</font><span class="glyphicon glyphicon-remove" style="color:red"></span></a></td>');
                } else {
                    productos[id] = codproducto;
                    $("#resultado" + id).find("td:gt(0)").remove();
                   // $('#resultado' + id + ' td:last').after(response + '<td><a class="btn btn-link btn-xs"onclick="eliminarFila(' + id + ')"><font color ="red">Eliminar</font><span class="glyphicon glyphicon-remove" style="color:red"></span></a></td>');
                    $('#resultado' + id + ' td:last').after('<td><input id="nameproduct'+id+'"    class="form-control input-sm" OnFocus="this.blur()" name="nameproduct'+id+'"   value= '+response.name_product+' ></div></td>' +
                        '<td><input id="stockproduct'+id+'"    class="form-control input" OnFocus="this.blur()" name="stockproduct'+id+'"   value= '+response.stock_product+' ></div></td> ' +
                        '<td><input id="precioproduct'+id+'"    class="form-control input-sm" OnFocus="this.blur()" name="precioproduct'+id+'"   value= '+response.precio_product+' ></div></td>' +
                        '<td><input id="cantidad'+id+'"    class="form-control input-sm"  name="cantidad'+id+'"  required ></div></td>' +
                        '</td><div class="col-xs-9"><td><a class="btn btn-danger btn-xs"onclick="eliminarFila(' + id + ')">Eliminar</a></td></div></td>');
                    //$("#resultado").html(response);
                }
            }
        });
    } else {
        alert("este producto ya fue ingresado");
    }
}


function generarTabla(numero) {
    $('#tabla > tbody').children('tr:not(:first)').remove();

    for (var i = 1; i <= numero; i++) {
        var id = "document.getElementsByName('codproducto[]')[" + i + "].value";
        //$("#tabla tbody tr:eq(0)").clone().show().removeClass('fila-base').appendTo("#tabla tbody");
        $('#tabla tr:last').after('<tr id="resultado' + i + '"><td> <div class="col-xs-10"><input id="codproducto[]" class="form-control input-sm" type="search"   name="codproducto[]" placeholder="EJ: 04008006"  required    onkeyup="buscarproducto(' + id + ',' + i + ')"     > </div></td> <td></td><td></td> <td></td> <td></td><td><a class="btn btn-danger btn-xs" onclick="eliminarFila(' + i + ')"><i class="fa fa-trash fa-2x" aria-hidden="true"></i></a></td></tr>');
    }
    $("#enviar").show();
    $("#totalproduct").val(numero);
    if (numero >= 22) {
        $('#agregarfila').hide();


    } else {
        if ($('#agregarfila').is(':hidden')) {
            $('#agregarfila').show();
        }


    }

}


/*function eliminarFila(numero) {
    $("#resultado" + numero + "").hide();
    document.getElementsByName('codproducto[]')[numero].value = "";
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

}*/

function agregarFila() {


    var i = $('#tabla > tbody > tr').length;
    var id = "document.getElementsByName('codproducto[]')[" + i + "].value";

    $('#tabla tr:last').after('<tr id="resultado' + i + '"><td> <div class="col-xs-8"><input id="codproducto[]" class="form-control input-sm" type="search"   name="codproducto[]" placeholder="EJ: 04008006"      onkeyup="buscarproducto(' + id + ',' + i + ')"     > </div></td> <td></td><td></td> <td></td> <td></td><td></td><td><a class="btn btn-link btn-xs" onclick="eliminarFila(' + i + ')"><font color ="red">Eliminar</font><span class="glyphicon glyphicon-remove" style="color:red"></span></a></td></tr>');
    var tablasvicibles = $('#tabla > tbody > tr:visible').length
    if (tablasvicibles >= 22) {
        $('#agregarfila').hide();

    }
}

/*function enviarValeConsumo() {

   var  link = $("#urlingreso").val();
    var _token = $("#_token").val();

            $.ajax({
                data: $("#form").serialize(),
                url: link,
                type: 'post',
                beforeSend: function () {
                    //$("#resultado").html("Procesando, espere por favor...");
                },
                success: function (response) {
                   /* abrirHome();
                    $("#modalbody").html(response);
                    $('#modal').modal('show');
                    location.reload();

                }
            });

}*/

function buscarDepartamento() {
    var idempresa = $("#empresas option:selected").val()

    if (idempresa > 0) {
        var parametros = {
            "action": 'buscardepartamento',
            "idempresa": idempresa,
        };
        $.ajax({
            data: parametros,
            url: '../controlador/departamento.php',
            type: 'post',
            beforeSend: function () {
                $("#resultado").html("Procesando, espere por favor...");
            },
            success: function (response) {
                if (response != "no") {
                    $("#departamentos").show();
                    $("#departamentos").html(response);
                } else {
                    $("#departamentos").hide();
                    $("#departamentos").html("");
                }
            }
        });
    }
}



function calcularsubtotal(id) {

    var cantidad = parseInt($("#cantidad" + id).val());
    var saldo = parseInt($("#saldo" + id).val());
    var precio = parseInt($("#precio" + id).val())
    var resta = 0;
    var subtotal = 0;
    if (cantidad < 0) {
        cantidad = 0;

    }
    resta = saldo - cantidad;
    subtotal = precio * cantidad;


    if (resta < 0) {
        subtotal = precio * saldo;
        $("#cantidad" + id).val(saldo);
    }

    if (cantidad < 0) {
        $("#cantidad" + id).val(0);
    }
    totales[id] = subtotal;
    $("#subtotaldiv" + id).html(subtotal);
    $("#subtotal" + id).val(subtotal);
    totalessuma();
    /* if(!isNaN(cantidad)){   
     totalsuma=totalsuma+subtotal;
     
     $("#total").val(totalsuma);
     $("#totalp").html(totalsuma);
     
     }*/

}

function totalessuma() {
    var sumatotal = 0;
    var contadorsubtotal = 0;
    for (i = 1; i < totales.length; i++) {
        if (!isNaN(totales[i]) && totales[i] != "" && totales[i] != null) {
            sumatotal = sumatotal + totales[i];
            contadorsubtotal++;
        }

    }
    if (sumatotal > 0) {
        $("#total").val(sumatotal);
        $("#totalp").html(sumatotal);
        $("#totallabel").show();
        $("#enviar").show();
    }
    $("#cantidadproductos").val(contadorsubtotal);

}

function productoingresado(codproducto) {

    var resultado = 0;

    for (i = 1; i < productos.length; i++) {

        if (productos[i] == codproducto) {

            resultado = 1;
        }

    }

    return resultado;
}

function abrirTable() {

    var parametros = {
        "action": "table"

    };
    $.ajax({
        data: parametros,
        url: '../controlador/interfaz.php',
        type: 'post',
        beforeSend: function () {

            $("#contenido").html("<img class='img-responsive center-block' SRC='../img/cargando.gif'>");
        },
        success: function (response) {
            $("#contenido").html(response);
        }
    });


}

function abrirHome() {
    var parametros = {
        "action": "home"

    };
    $.ajax({
        data: parametros,
        url: '../controlador/interfaz.php',
        type: 'post',
        beforeSend: function () {
            $("#contenido").html("<img class='img-responsive center-block' SRC='../img/cargando.gif'>");
        },
        success: function (response) {
            $("#contenido").html(response);
        }
    });
}


function abrirSolicitudVale(numero) {
    var parametros = {
        "action": "solicitudVale",
        "numero": numero

    };
    $.ajax({
        data: parametros,
        url: '../controlador/interfaz.php',
        type: 'post',
        beforeSend: function () {
            $("#contenido").html("<img class='img-responsive center-block' SRC='../img/cargando.gif'>");
        },
        success: function (response) {
            $("#contenido").html(response);
        }
    });



}

/**
 * Comment
 */
function abrirAprobadospormi() {

    var parametros = {
        "action": "solicitudVale"

    };
    $.ajax({
        data: parametros,
        url: '../controlador/interfaz.php',
        type: 'post',
        beforeSend: function () {
            $("#contenido").html("<img class='img-responsive center-block' SRC='../img/cargando.gif'>");
        },
        success: function (response) {
            $("#contenido").html(response);
        }
    });



}



function totalvaleconsumo(numero) {
    var parametros = {
        "action": "totalvale",
        "numero": numero


    };
    $.ajax({
        data: parametros,
        url: '../controlador/valeconsumo.php',
        type: 'post',
        beforeSend: function () {
            //$("#contador").html("<img class='img-responsive center-block' SRC='../img/cargando.gif'>");
        },
        success: function (response) {
            $("#contador").html(response);
        }
    });



}
function detalleConsumo(idconsumo) {

    var parametros = {
        "action": "detalleconsumo",
        "idconsumo": idconsumo


    };
    $.ajax({
        data: parametros,
        url: '../controlador/valeconsumo.php',
        type: 'post',
        beforeSend: function () {
            //$("#contador").html("<img class='img-responsive center-block' SRC='../img/cargando.gif'>");
        },
        success: function (response) {
            $("#detallemodalbody").html(response);
            $('#detallemodal').modal('show');
            $("#cancelarmensaje").show();
            $("#apruebo").show();
            $("#cerrarmensaje").hide();
        }
    });



}

function mensaje(mensaje, idconsumo) {

    $('#apruebo').attr('onclick', 'aprobar(' + idconsumo + ')');
    $("#mensajesmodalbody").html(mensaje);

    $('#mensajesmodal').modal('show');

}

function aprobar(idconsumo) {
    var parametros = {
        "action": "aprobarconsumo",
        "idconsumo": idconsumo


    };
    $.ajax({
        data: parametros,
        url: '../controlador/valeconsumo.php',
        type: 'post',
        beforeSend: function () {
            //$("#contador").html("<img class='img-responsive center-block' SRC='../img/cargando.gif'>");
        },
        success: function (response) {
            $("#mensajesmodalbody").html(response);
            abrirSolicitudVale(2);
            $("#cerrarmensaje").show();
            $("#cancelarmensaje").hide();
            $("#apruebo").hide();
            $('#detallemodal').modal('hide');
            $("#titulo").html("Vale consumo fue Aprobado con exito");


            //          $('#detallemodal').modal('show');
        }
    });

}

function detalleaprobador(mensaje){
    
    alert(mensaje);
}

function generarpdf(){
    
    $("#pdf").val($("#htmlpdf").html());
     $('#html').submit();
}
 
    
    
