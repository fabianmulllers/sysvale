

            <div class="col-md-12 text-right">
                <a class="btn btn-info" onclick="agregarDepartamento()" ><i class="fa fa-plus-circle" aria-hidden="true"></i> Agregar Departamentos</a>
            </div>
            <hr>


<div class="row">
    <!-- col-lg4-->

    <table class="table table-striped">
        <thead>
        <tr>
            <th>id</th>
            <th>Nombre Departamento</th>

        </tr>
        </thead>
        <tbody>
        <?php $i=1; ?>
        @foreach($departamentos as $departamento)
        <tr>
            <td>{{$i}}</td>
            <td>{{$departamento->name_departamento}}</td>
            <td>
                <a class="btn  btn-circle"  style="background-color:#800080" onclick="editarDepartamento({{$departamento->id}})">
                    <i class="fa fa-pencil-square-o fa-2x"  style="color:#fff" aria-hidden="true"></i></a>
                </td>
            <td> <a class="btn  btn-circle" style="background-color: #ff0000" onclick="mensajeDeleteDepartamento('{{$departamento->name_departamento }}',{{$departamento->id}})">
                    <i class="fa fa-trash-o fa-2x"  style="color:#fff" aria-hidden="true"></i>
                    <span class="sr-only">Delete</span>
                </a></td>
            <?php $i++; ?>
            @endforeach
        </tbody>
    </table>
</div>
<div class="row">
    <p>Hay la cantidad de {{ $departamentos->lastpage() }} con un total de registros {{$departamentos->total()}}</p>
    {!! $departamentos->render() !!}
    </div>