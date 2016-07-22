<table class="table table-striped">
    <tr>
        <th>#</th>
        <th>Codigo producto</th>
        <th>Nombre producto</th>
        <th>Cantidad</th>
        <th>Precio</th>

    </tr>
    @foreach($detail as $det)
        <tr data-id="{{ $det->vale_id }}">
            <td>{{$det->vale_id}}</td>
            <td>{{ $det->product_id}}</td>
            <td> {{ $det->name_product }}</td>
            <td>{{$det->cantidad}}</td>
            <td>{{$det->precio}}</td>


            </td>

        </tr>
    @endforeach
</table>