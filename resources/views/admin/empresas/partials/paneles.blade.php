

            <div class="col-md-12 text-right">
                <a class="btn btn-info" onclick="agregarEmpresa()" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar Empresa</a>
            </div>
            <hr>


<div class="row">
    <!-- col-lg4-->
<?php $i = 1?>
    @foreach($empresas as $empresa)
        @if($i==1)
         <div class="row">
         @endif


    <div id="div_{{$empresa->id}}" class="col-lg-4">
        <div class="panel panel-info " >
            <div class="panel-heading" style="background-color: #000080; color: #fff">

                <div class="row">
                    <div class="col-xs-4">
                        <i class="fa fa-building-o" aria-hidden="true"></i> <strong>{{$empresa->name_empresa}}</strong>
                    </div>
                    <div class="col-xs-8 text-right">
                        <a class="btn  btn-circle"  style="background-color:#800080" onclick="editarEmpresa({{$empresa->id}})"><i class="fa fa-pencil-square-o fa-2x"  style="color:#fff" aria-hidden="true"></i></a>
                        <a class="btn  btn-circle" style="background-color: #ff0000" onclick="mensajeDeleteEmpresa('{{$empresa->name_empresa }}',{{$empresa->id}})">
                            <i class="fa fa-trash-o fa-2x"  style="color:#fff" aria-hidden="true"></i>
                            <span class="sr-only">Delete</span>
                        </a>
                    </div>
                </div>

            </div>
            <div class="panel-body">
                <p><strong>Rut:</strong> {{$empresa->rut_empresa}}</p>
                <p><strong>Email:</strong> {{$empresa->direccion}}</p>
            </div>
            <div class="panel-footer">
               @foreach($empresa->departamentos as $dep )
                   {{$dep->name_departamento}}
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
    <p>Hay la cantidad de {{ $empresas->lastpage() }} con un total de registros {{$empresas->total()}}</p>
    {!! $empresas->render() !!}
    </div>