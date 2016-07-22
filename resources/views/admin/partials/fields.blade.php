<div id="diverror_name" class="form-group" >
    {{Form::label('firstname','primer nombre',['class'=>'control-label col-sm-2'])}}
    <div class="col-xs-7">
    {{Form::text('name',null,['id'=>'name','class'=>'form-control','placeholder'=>'ingrese primer nombre'])}}
    </div>
        <span id="error_name"class="help-block" style="display: none;"></span>
</div>



<div id="diverror_last_name" class="form-group ">
    {{Form::label('lastname','apellido',['class'=>'control-label col-sm-2'])}}
    <div class="col-xs-7">
    {{Form::text('last_name',null,['id'=>'last_name','class'=>'form-control','placeholder'=>'ingrese apellido'])}}
    </div>
    <span id="error_last_name" class="help-block" style="display: none;"></span>
     </div>
<div id="diverror_email" class="form-group ">
    {{ Form::label('labelemail','Correo electronico',['class'=>'control-label col-sm-2']) }}
    <div class="col-xs-7">
    {{Form::email('email',null,['id'=>'email','class'=> 'form-control' ,'placeholder' =>'correo electronico'])}}
    </div>
        <span id="error_email"class="help-block" style="display: none;"></span>
</div>
<div id="diverror_password" class="form-group ">
    {{Form::label('labelpassword','ingreso password',['class'=>'control-label col-sm-2'])}}
    <div class="col-xs-7">
    {{Form::password('password',['id'=>'password','class'=>'form-control','placeholder' => 'ingrese password'])}}
    </div>
        <span id="error_password" class="help-block" style="display: none;"></span>
</div>

<div id="diverror_type" class="form-group ">
    {{Form::label('type','tipo usuario',['class'=>'control-label col-sm-2'])}}
    <div class="col-xs-7">
    {{Form::select('type',[''=>'seleccione tipo ','user'=>'usuario','admin'=>'administrador' ,'approver'=>'aprobador'],null,['id'=>'type','class'=>'form-control'])}}
    </div>
        <span id="error_type" class="help-block" style="display: none;"></span>
</div>
