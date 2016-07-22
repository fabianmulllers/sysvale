

            <div class="col-md-12 text-right">
                <a class="btn btn-info" onclick="agregarUsuario()" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar Usuario</a>
            </div>
            <hr>


<div class="row">
    <!-- col-lg4-->
<?php $i = 1?>
    @foreach($users as $user)
        @if($i==1)
         <div class="row">
         @endif
        @if($user->type==='user')
            <?php   $color = 'green'?>
        @endif
        @if($user->type==='approver')
            <?php $color = 'yellow' ?>
           @endif
        @if($user->type==='admin')
                <?php $color = 'red' ?>
        @endif

    <div id="div_{{$user->id}}" class="col-lg-4">
        <div class="panel panel-{{$color}}">
            <div class="panel-heading">

                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-user" aria-hidden="true"></i> <strong>{{$user->type}}</strong>
                    </div>
                    <div class="col-xs-8 text-right">
                        <a class="btn  btn-circle"  style="background-color:#800080" onclick="editarUsuario({{$user->id}})"><i class="fa fa-pencil-square-o fa-2x"  style="color:#fff" aria-hidden="true"></i></a>
                        <a class="btn  btn-circle" style="background-color: #ff0000" onclick="mensajeDelete('{{$user->full_name ,$user->id }}',{{$user->id}})">
                            <i class="fa fa-trash-o fa-2x"  style="color:#fff" aria-hidden="true"></i>
                            <span class="sr-only">Delete</span>
                        </a>
                    </div>
                </div>

            </div>
            <div class="panel-body">
                <p><strong>Nombre:</strong> {{$user->full_name}}</p>
                <p><strong>Email:</strong> {{$user->email}}</p>
            </div>
            <div class="panel-footer">

                <?php $nombres=array(); ?>
                @foreach($user->user_empresas as $empresa)
                    <?php
                        $nombres[]= $empresa->name_empresa;
                        ?>
                    @endforeach
                    <?php $nom = array_unique($nombres)?>
                 @foreach($nom as $name_empresa)
                     {{$name_empresa}}
                     @endforeach
            </div>
        </div>
    </div>
             @if($i ===3 )
                 </div>
            <?php $i= 1?>
             @else
           <?php $i++;?>
           @endif
    @endforeach
    </div>
<div class="row">
    <p>Hay la cantidad de {{ $users->lastpage() }} con un total de registros {{$users->total()}}</p>
    {!! $users->render() !!}
    </div>