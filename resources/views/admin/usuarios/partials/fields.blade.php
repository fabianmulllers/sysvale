


<div class="modal fade" id="fields_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div id="fields_modeal_header"class="modal-header" >
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
                <h1 class="modal-title"  id="myModalLabel_fields">  </h1>
            </div>
            <div class="modal-body">
                <!-- name-->
                <div id="diverror_name" class="form-group row" >
                    <div class="col-md-3">
                        {{Form::label('firstname','Primer Nombre',['class'=>'control-label col-sm-2'])}}
                    </div>
                    <div class="col-md-6">
                        {{Form::text('name',null,['id'=>'name','class'=>'form-control','placeholder'=>'ingrese primer nombre'])}}
                        <span id="error_name"class="help-block" style="display: none;"></span>
                    </div>

                </div>
                <!-- fin name-->
                <!-- last_name-->
                <div id="diverror_last_name" class="form-group row">
                    <div class="col-md-3">
                        {{Form::label('lastname','Apellido',['class'=>'control-label col-sm-2'])}}
                    </div>
                    <div class="col-md-6">
                        {{Form::text('last_name',null,['id'=>'last_name','class'=>'form-control','placeholder'=>'ingrese apellido'])}}
                        <span id="error_last_name" class="help-block" style="display: none;"></span>
                    </div>

                </div>
                <!-- fin last_name>-->
                <!-- email -->
                <div id="diverror_email" class="form-group row ">
                    <div class="col-md-3">
                        {{ Form::label('labelemail','Correo Electronico',['class'=>'control-label col-sm-2']) }}
                    </div>
                    <div class="col-md-6">
                        {{Form::email('email',null,['id'=>'email','class'=> 'form-control' ,'placeholder' =>'correo electronico'])}}
                        <span id="error_email"class="help-block" style="display: none;"></span>
                    </div>

                </div>
                <!-- fin email -->
                <!-- password -->
                <div id="diverror_password" class="form-group row ">
                    <div class="col-md-3">
                        {{Form::label('labelpassword','Ingreso Password',['class'=>'control-label col-sm-2'])}}
                    </div>
                    <div class="col-md-6">
                        {{Form::password('password',['id'=>'password','class'=>'form-control','placeholder' => 'ingrese password'])}}
                        <span id="error_password" class="help-block" style="display: none;"></span>
                    </div>
                </div>

                <!-- fin password -->
                <!-- type -->
                <div id="diverror_type" class="form-group row">
                    <div class="col-md-3">
                        {{Form::label('type','Tipo Usuario',['class'=>'control-label col-sm-2'])}}
                    </div>
                    <div class="col-md-6">
                        {{Form::select('type',[''=>'seleccione tipo ','user'=>'usuario','admin'=>'administrador' ,'approver'=>'aprobador'],null,['id'=>'type','class'=>'form-control','onchange'=>'select_tipo("empresa")'])}}
                        <span id="error_type" class="help-block" style="display: none;"></span>
                    </div>

                </div>
                <!-- fin type -->
                <div id="contenedor_empresa">

                </div>
                <div id="contenedor_departamento"></div>
            </div>
            <div  id="fiels_modal_footer"class="modal-footer">


            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>