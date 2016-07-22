<table class="table table-striped">
    <tr>
        <th>#</th>
        <th>nombre de solicitud</th>
        <th>total de productos</th>
        <th>aprobacion</th>
        <th>nombre aprobador </th>
        <th>solicitante </th>
        <th>Fecha solicitud</th>
    </tr>
    @foreach($vales as $vale)
        <tr data-id="{{ $vale->id }}">
            <td>{{ $vale->id }}</td>
            <td> {{ $vale->name_vale }}</td>
            <td>{{$vale->total_product}}</td>
            <td>{{$vale->aprobacion_vale}}</td>
            <td>{{$vale->name_aprobador}}</td>
            <td>{{$vale->name}}</td>
            <td>{{$vale->date_vale}}</td>
            <td>  <a href="{{route('approver.approver.edit',$vale->id)}}">Detalle</a> </td>

            </td>

        </tr>
    @endforeach
</table>
