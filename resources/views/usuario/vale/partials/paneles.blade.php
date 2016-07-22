
<div class="col-md-12 text-right">
    <a class="btn btn-success" onclick="ingresarVale()" ><i aria-hidden="true" class="fa fa-location-arrow fa-2x"></i> Enviar Solicitud Vale Consumo</a>
</div>
<hr>

<div class="row">
    <!-- col-lg4-->
<?php $i = 1?>
    @foreach($departamentos as $dept )


    <div id="div_{{$dept->pivot->id}}" class="col-lg-4">
        <div class="panel ">
            <div class="panel-heading " style="background-color: #ffa500; color: #fff ">

                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-location-arrow " aria-hidden="true"></i> <strong>{{$dept->pivot->aprobacion_vale}}</strong>
                    </div>
                    <div class="col-xs-8 text-right">
                        <?php
                        $name='La solicitud '.$dept->pivot->name_vale;
                        $id='eliminarSolicitudAjax('.$dept->pivot->id.')'
                        ?>
                        <a class="btn  btn-circle"  style="background-color:#800080" onclick="editarSolicitud({{$dept->pivot->id}})"><i class="fa fa-pencil-square-o fa-2x"  style="color:#fff" aria-hidden="true"></i></a>
                        <a class="btn  btn-circle" style="background-color: #ff0000" onclick="mensajeDeletes ('{{ $name}}','{{$id}}')">
                            <i class="fa fa-trash-o fa-2x"  style="color:#fff" aria-hidden="true"></i>
                            <span class="sr-only">Delete</span>
                        </a>
                    </div>
                </div>

            </div>
            <div class="panel-body">
                <p><strong>Nombre Vale</strong> {{$dept->pivot->name_vale}}</p>
                <p><strong>Departamento</strong>{{$dept->name_departamento}}</p>

            </div>
            <div class="panel-footer">

            </div>
        </div>
    </div>
    <!-- mantener los paneles en una celda -->
             @if($i ===3 )
                 </div>
                    <?php $i= 1?>
                 @else
                     <?php $i++;?>
                @endif
    @endforeach

<div class="row col-md-12">
    <p> Hay la cantidad de {{ $departamentos->lastpage() }} con un total de registros {{$departamentos->total()}}</p>
    {!! $departamentos->render() !!}
</div>