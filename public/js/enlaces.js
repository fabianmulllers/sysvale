/**
 * Created by fabian on 15-06-16.
 */

function dirigeme(param)
{

    window.location = $("#"+param).attr("href");

}

function mensajeDelete(user,id){
    var id = id;
    $("#mensaje_modal_header").css({backgroundColor: "#c9302c"});
    $("#mensaje_modal_title").html("Se eliminara el Usuario <strong>" + user +"</strong>").css({color:'#fff'});
    $("#mensaje_modal_body").html("<h4>¿Esta seguro de eliminar al usuario <strong>" + user +" </strong>?</h4>");
    $("#mensaje_modal_footer").html(
        '<a type="button" class="btn btn-danger" onclick="eliminarUsuarioAjax('+id+')" >Si, eliminar</a>' +
        '<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>');
    $('#mensaje_modal').modal('show')


}
///////////////////////////Usuarios//////////////////////////////////////////////

///// -> mensajes

function mensajeConfirmacionAgregar(user){
    $("#mensaje_modal_header").css({backgroundColor: "#358118"});
    $("#mensaje_modal_title").html('<i class="fa fa-check-circle-o fa-2x" aria-hidden="true"></i> Se Creo el Usuario <strong>' + user +'</strong>').css({color:'#fff'});
    $("#mensaje_modal_body").html("<h4>El Usuario <strong>"+user+"</strong> se creo Satisfactoriamente podras visualizarlo en el tablero de usuarios</h4>");
    $("#mensaje_modal_footer").html(
        '<button type="button" class="btn btn-success"  data-dismiss="modal">OK</button>');
    $('#mensaje_modal').modal('show')


}
function mensajeConfirmacionEditar(user){
    $("#mensaje_modal_header").css({backgroundColor: "#358118"});
    $("#mensaje_modal_title").html('<i class="fa fa-check-circle-o fa-2x" aria-hidden="true"></i> Se ha Editado el Usuario <strong>' + user +'</strong>').css({color:'#fff'});
    $("#mensaje_modal_body").html("<h4>El Usuario <strong>"+user+"</strong> se ha Editado Satisfactoriamente podras visualizarlo en el tablero de usuarios</h4>");
    $("#mensaje_modal_footer").html(
        '<button type="button" class="btn btn-success"  data-dismiss="modal">OK</button>');
    $('#mensaje_modal').modal('show')


}

function mensajeConfirmacionEliminar(user){
    $("#mensaje_modal_header").css({backgroundColor: "#358118"});
    $("#mensaje_modal_title").html('<i class="fa fa-check-circle-o fa-2x" aria-hidden="true"></i> Se ha Eliminado el Usuario <strong>' + user +'</strong>').css({color:'#fff'});
    $("#mensaje_modal_body").html("<h4>El Usuario <strong>"+user+"</strong> se ha Eliminado Satisfactoriamente el usuario</h4>");
    $("#mensaje_modal_footer").html(
        '<button type="button" class="btn btn-success" data-dismiss="modal">OK</button>');
    $('#mensaje_modal').modal('show')


}

/////------> acciones

function agregarUsuario() {
    $("#fields_modeal_header").css({backgroundColor: "#5bc0de"});
    $("#myModalLabel_fields").html('<i class="fa fa-user" aria-hidden="true"></i>  Agregar Usuario').css({color:'#fff'});
    $("#fiels_modal_footer").html(
        '<a class="btn btn-info" onclick="agregarUsuarioAjax()">Agregar</a>' +
        ' <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>');
    $('#form_create')[0].reset();
    select_tipo('empresa');
    select_tipo('departamento');
    $('#fields_modal').modal('show')
}

function editarUsuario(id) {

    $("#fields_modeal_header").css({backgroundColor: "#660066"});
    $("#myModalLabel_fields").html('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Editar Usuario').css({color: '#fff'});
    $("#fiels_modal_footer").html(
        '<a class="btn " style="background-color: #660066; color: #fff"  onclick="editarUsuarioAjax('+id+')"> Editar</a>' +
        ' <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>');

    $('#fields_modal').modal('show');


    var id = id;
    var url = $("#route_editar").attr('value').replace('id', id);
    $.ajax({
        data: id,
        url: url,
        type: 'get',
        beforeSend: function () {
            //$("#contador").html("<img class='img-responsive center-block' SRC='../img/cargando.gif'>");
        },
        success: function (response) {

            //select_tipo('departamento')
            $.each(response, function (index, value) {

             if(index=='empresa'){
                 if(value!='') {
                     select_tipo('empresa');
                     setTimeout(function () {
                         $('#select_empresa').selectpicker('val', value);
                     }, 100);
                 }else{
                     select_tipo('empresa');
                 }
             }

                if(index=='departamento') {
                    if (value != '') {
                        setTimeout(function () {
                            select_tipo('departamento');
                        }, 200);

                        setTimeout(function () {
                            $('#select_departamento').selectpicker('val', value);
                        }, 300);
                    }else{
                        select_tipo('departamento');
                    }
                }
                $("#" + index).val(value);

                //          $('#detallemodal').modal('show');


            });

        }
    });

}



function actualizarPaneles(){
    var _token = $("#_token").val();
    var url= $("#update_paneles").val();
    var parametros = {
        "_token": _token,
    };
    $.ajax({
        data: parametros,
        url: url,
        type: 'put',
        beforeSend: function () {

        },
        success: function (response) {
            $("#paneles").html(response);

        }, error: function(response){

            }

    });

}

function actualizarPanelesget(id){
    var _token = $("#_token").val();
    var url= $("#"+id).val();
    var parametros = {
        "_token": _token,
    };
    $.ajax({
        data: parametros,
        url: url,
        type: 'get',
        beforeSend: function () {

        },
        success: function (response) {
            $("#paneles-tablero").html(response);

        }, error: function(response){

        }

    });

}
//////////// acciones ajax

function agregarUsuarioAjax(){
    var form = $("#form_create")
    var url =  form.attr('action');

    $.each($('#form_create').serializeArray(), function(i, field) {
        if(field.name==='departamentos[]'){
            field.name='departamentos';
        }
        $("#diverror_"+field.name).removeClass("has-error");
        $("#error_"+field.name).hide().html();
    });

    $.ajax({
        data: $("#form_create").serialize(),
        url: url,
        type: 'post',
        beforeSend: function () {

        },
        success: function (response) {
            mensajeConfirmacionAgregar(response.name);
            $('#form_create')[0].reset();
            $("#fields_modal").modal("hide");
            actualizarPaneles();
        }, error: function(response){
            var errors = response.responseJSON;
            $.each(errors , function(index,value){
                $("#diverror_"+index).addClass("has-error")

                $("#error_"+index).show().html("<strong>"+value+"</strong>");
            });
        }
    });


}

function editarUsuarioAjax(id){
    var form = $("#form_edit");
    var id=id;
    var url =  form.attr('action').replace(':USER_ID',id);
    $.each($('#form_create').serializeArray(), function(i, field) {
        if(field.name==='departamentos[]'){
            field.name='departamentos';
        }
        $("#diverror_"+field.name).removeClass("has-error");
        $("#error_"+field.name).hide().html();
    });
    $.ajax({
        data: $("#form_create").serialize(),
        url: url,
        type: 'PUT',
        beforeSend: function () {

        },
        success: function (response) {
            mensajeConfirmacionEditar(response.name);
            $('#form_create')[0].reset();
            $("#fields_modal").modal("hide");
            actualizarPaneles();
        }, error: function(response){
            var errors = response.responseJSON;
            $.each(errors , function(index,value){
                $("#diverror_"+index).addClass("has-error")

                $("#error_"+index).show().html("<strong>"+value+"</strong>");
            });

        }
    });


}

function eliminarUsuarioAjax(id){

    var id = id;
    var form = $("#form-delete");
    var url =  form.attr('action').replace(':USER_ID',id);
    var data = form.serialize();
    $.ajax({
        data: data,
        url: url,
        type: 'DELETE',
        beforeSend: function () {

        },
        success: function (response) {
            //$("#mensaje_modal").modal("hide");
            mensajeConfirmacionEliminar(response.name);
            //$('#form_delete')[0].reset();

            $("#div_"+id).fadeOut();
            actualizarPaneles();


        }, error: function(response){

        }
    });


}
/////////////////// empresas //////////////////////////////////////



//////// Mensajes
function mensajeConfirmacionAgregarempresa(empresa){
    $("#mensaje_modal_header").css({backgroundColor: "#358118"});
    $("#mensaje_modal_title").html('<i class="fa fa-check-circle-o fa-2x" aria-hidden="true"></i> Se Creo la Empresa <strong>' + empresa +'</strong>').css({color:'#fff'});
    $("#mensaje_modal_body").html("<h4>La Empresa <strong>"+empresa+"</strong> se creo Satisfactoriamente podras visualizarlo en el tablero de Empresas</h4>");
    $("#mensaje_modal_footer").html(
        '<button type="button" class="btn btn-success"  data-dismiss="modal">OK</button>');
    $('#mensaje_modal').modal('show')


}
function mensajeDeleteEmpresa(empresa,id){
    var id = id;
    $("#mensaje_modal_header").css({backgroundColor: "#c9302c"});
    $("#mensaje_modal_title").html("Se eliminara el Usuario <strong>" + empresa +"</strong>").css({color:'#fff'});
    $("#mensaje_modal_body").html("<h4>¿Esta seguro de eliminar la Empresa <strong>" + empresa +" </strong>?</h4>");
    $("#mensaje_modal_footer").html(
        '<a type="button" class="btn btn-danger" onclick="eliminarEmpresaAjax('+id+')" >Si, eliminar</a>' +
        '<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>');
    $('#mensaje_modal').modal('show')


}

function mensajeConfirmacionEliminarEmpresa(empresa){
    $("#mensaje_modal_header").css({backgroundColor: "#358118"});
    $("#mensaje_modal_title").html('<i class="fa fa-check-circle-o fa-2x" aria-hidden="true"></i> Se ha Eliminado la Empresa <strong>' + empresa +'</strong>').css({color:'#fff'});
    $("#mensaje_modal_body").html("<h4>La Empresa <strong>"+empresa+"</strong> se ha Eliminado Satisfactoriamente </h4>");
    $("#mensaje_modal_footer").html(
        '<button type="button" class="btn btn-success" data-dismiss="modal">OK</button>');
    $('#mensaje_modal').modal('show')


}
function mensajeConfirmacionEditarEmpresa(empresa){
    $("#mensaje_modal_header").css({backgroundColor: "#358118"});
    $("#mensaje_modal_title").html('<i class="fa fa-check-circle-o fa-2x" aria-hidden="true"></i> Se ha Editado La empresa <strong>' + empresa +'</strong>').css({color:'#fff'});
    $("#mensaje_modal_body").html("<h4>La empresa <strong>"+empresa+"</strong> se ha Editado Satisfactoriamente podras visualizarlo en el tablero de Empresas</h4>");
    $("#mensaje_modal_footer").html(
        '<button type="button" class="btn btn-success"  data-dismiss="modal">OK</button>');
    $('#mensaje_modal').modal('show')


}



// --> accion
function agregarEmpresa() {
    $("#fields_modeal_header").css({backgroundColor: "#5bc0de"});
    $("#myModalLabel_fields").html('<i class="fa fa-building-o" aria-hidden="true"></i> Agregar Empresa').css({color:'#fff'});
    $("#fiels_modal_footer").html(
        '<a class="btn btn-info" onclick="agregarEmpresaAjax()">Agregar</a>' +
        ' <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>');
    $('#form_create')[0].reset();
    $('.selectpicker').selectpicker('deselectAll');
    $('#fields_modal').modal('show')
}

function editarEmpresa(id) {

    $("#fields_modeal_header").css({backgroundColor: "#660066"});
    $("#myModalLabel_fields").html('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Editar Empresa').css({color: '#fff'});
    $("#fiels_modal_footer").html(
        '<a class="btn " style="background-color: #660066; color: #fff"  onclick="editarEmpresaAjax('+id+')"> Editar</a>' +
        ' <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>');

    $('#fields_modal').modal('show');


    var id = id;
    var url = $("#route_editar").attr('value').replace('id', id);
    $.ajax({
        data: id,
        url: url,
        type: 'get',
        beforeSend: function () {
            //$("#contador").html("<img class='img-responsive center-block' SRC='../img/cargando.gif'>");
        },
        success: function (response) {




            $.each(response, function (index, value) {

          if(index==='departamentos') {
              $('.selectpicker').selectpicker('val', value);
          }

                $("#" + index).val(value);


                //          $('#detallemodal').modal('show');

            });
        }
    });
}


///// ----> accion ajax
function agregarEmpresaAjax(){
    var form = $("#form_create")
    var url =  form.attr('action');
    $.ajax({
        data: $("#form_create").serialize(),
        url: url,
        type: 'post',
        beforeSend: function () {

        },
        success: function (response) {
            mensajeConfirmacionAgregarempresa(response.name_empresa);
            $('#form_create')[0].reset();
            $("#fields_modal").modal("hide");
            actualizarPaneles();
        }, error: function(response){
            var errors = response.responseJSON;
            $.each(errors , function(index,value){
                $("#diverror_"+index).addClass("has-error")

                $("#error_"+index).show().html("<strong>"+value+"</strong>");
            });
        }
    });


}

function eliminarEmpresaAjax(id){

    var id = id;
    var form = $("#form-delete");
    var url =  form.attr('action').replace(':EMPRESAS_ID',id);
    var data = form.serialize();
    $.ajax({
        data: data,
        url: url,
        type: 'DELETE',
        beforeSend: function () {

        },
        success: function (response) {
            //$("#mensaje_modal").modal("hide");
            mensajeConfirmacionEliminarEmpresa(response.name_empresa);
            //$('#form_delete')[0].reset();

            $("#div_"+id).fadeOut();
            actualizarPaneles();


        }, error: function(response){

        }
    });


}

function editarEmpresaAjax(id){
    var form = $("#form_edit");
    var id=id;
    var url =  form.attr('action').replace(':EMPRESAS_ID',id);
    $.ajax({
        data: $("#form_create").serialize(),
        url: url,
        type: 'PUT',
        beforeSend: function () {

        },
        success: function (response) {
            mensajeConfirmacionEditarEmpresa(response.name_empresa);
            $('#form_create')[0].reset();
            $("#fields_modal").modal("hide");
            actualizarPaneles();
        }, error: function(response){
            var errors = response.responseJSON;
            $.each(errors , function(index,value){
                $("#diverror_"+index).addClass("has-error")

                $("#error_"+index).show().html("<strong>"+value+"</strong>");
            });
        }
    });


}

////////////////// Departamentos //////////////////////////////////////////




//--> mensajes

function mensajeConfirmacionAgregarDepartamento(departamento){
    $("#mensaje_modal_header").css({backgroundColor: "#358118"});
    $("#mensaje_modal_title").html('<i class="fa fa-check-circle-o fa-2x" aria-hidden="true"></i> Se Creo el Departamento<strong>' + departamento +'</strong>').css({color:'#fff'});
    $("#mensaje_modal_body").html("<h4>El Departamento <strong>"+departamento+"</strong> se creo Satisfactoriamente podras visualizarlo en el tablero de Departamentos</h4>");
    $("#mensaje_modal_footer").html(
        '<button type="button" class="btn btn-success"  data-dismiss="modal">OK</button>');
    $('#mensaje_modal').modal('show')


}
function mensajeConfirmacionEditarDepartamento(departamento){
    $("#mensaje_modal_header").css({backgroundColor: "#358118"});
    $("#mensaje_modal_title").html('<i class="fa fa-check-circle-o fa-2x" aria-hidden="true"></i> Se ha Editado El Departamento <strong>' + departamento +'</strong>').css({color:'#fff'});
    $("#mensaje_modal_body").html("<h4>El Departamento <strong>"+departamento+"</strong> se ha Editado Satisfactoriamente podras visualizarlo en el tablero de Departamentos</h4>");
    $("#mensaje_modal_footer").html(
        '<button type="button" class="btn btn-success"  data-dismiss="modal">OK</button>');
    $('#mensaje_modal').modal('show')


}
function mensajeDeleteDepartamento(departamento,id){
    var id = id;
    $("#mensaje_modal_header").css({backgroundColor: "#c9302c"});
    $("#mensaje_modal_title").html("Se eliminara el Departamento <strong>" + departamento +"</strong>").css({color:'#fff'});
    $("#mensaje_modal_body").html("<h4>¿Esta seguro de eliminar el Departamento <strong>" + departamento +" </strong>?</h4>");
    $("#mensaje_modal_footer").html(
        '<a type="button" class="btn btn-danger" onclick="eliminarDepartamentoAjax('+id+')" >Si, eliminar</a>' +
        '<button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>');
    $('#mensaje_modal').modal('show')


}
function mensajeConfirmacionEliminarDepartamento(departamento){
    $("#mensaje_modal_header").css({backgroundColor: "#358118"});
    $("#mensaje_modal_title").html('<i class="fa fa-check-circle-o fa-2x" aria-hidden="true"></i> Se ha Eliminado el Departamento <strong>' + departamento +'</strong>').css({color:'#fff'});
    $("#mensaje_modal_body").html("<h4>El Departamento<strong>"+departamento+"</strong> se ha Eliminado Satisfactoriamente </h4>");
    $("#mensaje_modal_footer").html(
        '<button type="button" class="btn btn-success" data-dismiss="modal">OK</button>');
    $('#mensaje_modal').modal('show')


}






//--> acciones
function agregarDepartamento() {
    $("#fields_modeal_header").css({backgroundColor: "#5bc0de"});
    $("#myModalLabel_fields").html('<i class="fa fa-building" aria-hidden="true"></i> </i> Agregar Departamento').css({color:'#fff'});
    $("#fiels_modal_footer").html(
        '<a class="btn btn-info" onclick="agregarDepartamentoAjax()">Agregar</a>' +
        ' <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>');
    $('#form_create')[0].reset();
    $('#fields_modal').modal('show')
}


function editarDepartamento(id) {

    $("#fields_modeal_header").css({backgroundColor: "#660066"});
    $("#myModalLabel_fields").html('<i class="fa fa-pencil-square-o" aria-hidden="true"></i>  Editar Departamento').css({color: '#fff'});
    $("#fiels_modal_footer").html(
        '<a class="btn " style="background-color: #660066; color: #fff"  onclick="editarDepartamentoAjax('+id+')"> Editar</a>' +
        ' <button type="button" class="btn btn-default" data-dismiss="modal">Cancelar</button>');

    $('#fields_modal').modal('show');


    var id = id;
    var url = $("#route_editar").attr('value').replace('id', id);
    $.ajax({
        data: id,
        url: url,
        type: 'get',
        beforeSend: function () {
            //$("#contador").html("<img class='img-responsive center-block' SRC='../img/cargando.gif'>");
        },
        success: function (response) {
            $.each(response, function (index, value) {
                $("#" + index).val(value);

                //          $('#detallemodal').modal('show');

            });
        }
    });
}







// --> accion ajax
function agregarDepartamentoAjax(){
    var form = $("#form_create")
    var url =  form.attr('action');

    $.each($('#form_create').serializeArray(), function(i, field) {
        if(field.name==='departamentos[]'){
            field.name='departamentos';
        }
        $("#diverror_"+field.name).removeClass("has-error");
        $("#error_"+field.name).hide().html();
    });
    $.ajax({
        data: $("#form_create").serialize(),
        url: url,
        type: 'post',
        beforeSend: function () {

        },
        success: function (response) {
            mensajeConfirmacionAgregarDepartamento(response.name_departamento);
            $('#form_create')[0].reset();
            $("#fields_modal").modal("hide");
            actualizarPaneles();
        }, error: function(response){
            var errors = response.responseJSON;
            $.each(errors , function(index,value){
                $("#diverror_"+index).addClass("has-error")

                $("#error_"+index).show().html("<strong>"+value+"</strong>");
            });
        }
    });


}

function editarDepartamentoAjax(id){
    var form = $("#form_edit");
    var id=id;
    var url =  form.attr('action').replace(':DEPARTAMENTOS_ID',id);
    $.ajax({
        data: $("#form_create").serialize(),
        url: url,
        type: 'PUT',
        beforeSend: function () {

        },
        success: function (response) {
            mensajeConfirmacionEditarDepartamento(response.name_departamento);
            $('#form_create')[0].reset();
            $("#fields_modal").modal("hide");
            actualizarPaneles();
        }, error: function(response){
            var errors = response.responseJSON;
            $.each(errors , function(index,value){
                $("#diverror_"+index).addClass("has-error")

                $("#error_"+index).show().html("<strong>"+value+"</strong>");
            });
        }
    });


}


function eliminarDepartamentoAjax(id){

    var id = id;
    var form = $("#form-delete");
    var url =  form.attr('action').replace(':DEPARTAMENTOS_ID',id);
    var data = form.serialize();
    $.ajax({
        data: data,
        url: url,
        type: 'DELETE',
        beforeSend: function () {

        },
        success: function (response) {
            //$("#mensaje_modal").modal("hide");
            mensajeConfirmacionEliminarDepartamento(response.name_departamento);
            //$('#form_delete')[0].reset();

            $("#div_"+id).fadeOut();
            actualizarPaneles();


        }, error: function(response){

        }
    });


}


function mensajeConfirmacionInsertVale(Vale){
    $("#mensaje_modal_header").css({backgroundColor: "#358118"});
    $("#mensaje_modal_title").html('<i class="fa fa-check-circle-o fa-2x" aria-hidden="true"></i> Se Ingreso<strong>' + user +'</strong>').css({color:'#fff'});
    $("#mensaje_modal_body").html("<h4>El Usuario <strong>"+user+"</strong> se creo Satisfactoriamente podras visualizarlo en el tablero de usuarios</h4>");
    $("#mensaje_modal_footer").html(
        '<button type="button" class="btn btn-success"  data-dismiss="modal">OK</button>');
    $('#mensaje_modal').modal('show')


}