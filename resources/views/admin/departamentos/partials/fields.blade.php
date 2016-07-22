


<div class="modal fade" id="fields_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="fields_modeal_header"class="modal-header" >
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h1 class="modal-title"  id="myModalLabel_fields">  </h1>
            </div>
            <div class="modal-body">
                <!-- name_departamento-->
                <div id="diverror_name_departamento" class="form-group row" >
                    <div class="col-md-3">
                        {{Form::label('namedepartamento','Nombre Departamento',['class'=>'control-label col-sm-2'])}}
                    </div>
                    <div class="col-md-6">
                        {{Form::text('name_departamento',null,['id'=>'name_departamento','class'=>'form-control','placeholder'=>'Ingrese Nombre Departamento'])}}
                        <span id="error_name_departamento"class="help-block" style="display: none;"></span>
                    </div>

                </div>
                <!-- fin name_departamento-->


            </div>
            <div  id="fiels_modal_footer"class="modal-footer">


            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>