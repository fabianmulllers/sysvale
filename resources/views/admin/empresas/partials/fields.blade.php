


<div class="modal fade" id="fields_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="fields_modeal_header"class="modal-header" >
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h1 class="modal-title"  id="myModalLabel_fields">  </h1>
            </div>
            <div class="modal-body">
                <!-- name_empresa-->
                <div id="diverror_name_empresa" class="form-group row" >
                    <div class="col-md-3">
                        {{Form::label('nameempresa','Nombre empresa',['class'=>'control-label col-sm-2'])}}
                    </div>
                    <div class="col-md-6">
                        {{Form::text('name_empresa',null,['id'=>'name_empresa','class'=>'form-control','placeholder'=>'Ingrese Nombre Empresa'])}}
                        <span id="error_name_empresa"class="help-block" style="display: none;"></span>
                    </div>

                </div>
                <!-- fin name_empresa-->
                <!-- rut_empresa-->
                <div id="diverror_rut_empresa" class="form-group row">
                    <div class="col-md-3">
                        {{Form::label('rutempresa','Rut Empresa',['class'=>'control-label col-sm-2'])}}
                    </div>
                    <div class="col-md-6">
                        {{Form::text('rut_empresa',null,['id'=>'rut_empresa','class'=>'form-control','placeholder'=>'ingrese Rut Empresa'])}}
                        <span id="error_rut_empresa" class="help-block" style="display: none;"></span>
                    </div>

                </div>
                <!-- fin rut_empresa>-->
                <!-- direccion -->
                <div id="diverror_direccion" class="form-group row ">
                    <div class="col-md-3">
                        {{ Form::label('direccionempresa','Direccion Empresa',['class'=>'control-label col-sm-2']) }}
                    </div>
                    <div class="col-md-6">
                        {{Form::email('direccion',null,['id'=>'direccion','class'=> 'form-control' ,'placeholder' =>'Ingrese Direccion Empresa'])}}
                        <span id="error_direccion"class="help-block" style="display: none;"></span>
                    </div>

                </div>

                <!-- fin direccion -->
                <!-- Departamentos -->
                <div id="diverror_name_departamento" class="form-group row ">
                    <div class="col-md-3">
                        {{ Form::label('namedepartamento','Departamento',['class'=>'control-label col-sm-2']) }}
                    </div>
                    <div class="col-md-6">
                        {{Form::select('name_departamento[]',$departamentos,null,['id'=>'name_departamento','class'=>'selectpicker','multiple data-actions-box'=>'true','multiple data-selected-text-format'=>'count > 2'])}}
                        <span id="error_direccion"class="help-block" style="display: none;"></span>

                    </div>
                    <div class="col-md-1">
                        <a class="btn btn-success" onclick="add_departamentos()"><i class="fa fa-plus" aria-hidden="true"></i>
                        </a>
                    </div>
                    <div class="col-md-1">
                        <a id="lock" class="btn btn-danger" onclick="lock_departamentos()"><i class="fa fa-lock" aria-hidden="true"></i>


                        </a>
                    </div>

                </div>
                  <div id="contenedor"></div>
                <!--fin Departamento-->


            </div>
            <div  id="fiels_modal_footer"class="modal-footer">


            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>

<script>


    function add_departamentos() {
        var max= parseInt("{{count($departamentos)}}");
        max= max-1;
        var x = $("#contenedor div").length;
        var j= $("#contenedor div:visible").length+5;
        j=j/5;
        if(x===0){
            num=0;
        }else{
            num=x/5;

        }
        num++;
         if(j<max) {
             $("#contenedor").append(
                     ' <div id="diverror_name_departamento" class="form-group row ' + num + ' ">' +
                     '<div class="col-md-3">' +

                     ' </div>' +
                     '<div id="select_' + num + '" class="col-md-6">' +
                     ' {{Form::select("name_departamento[]",$departamentos,null,["id"=>"name_departamento" ,"class"=>"form-control"])}}' +

                     '</div>' +
                     '<div class="col-md-1">' +
                     '<a class="btn btn-danger" onclick="eliminarCampoDepartamento(' + num + ')"><i class="fa fa-times" aria-hidden="true"></i>' +
                     '</a>' +
                     '</div>' +
                     '<div class="col-md-1">' +


                     '</a>' +
                     '</div>' +

                     '</div>'
             );
         }
    }

</script>