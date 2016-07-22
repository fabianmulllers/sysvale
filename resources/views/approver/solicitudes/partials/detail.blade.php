<div class="container-fluid">
    <div class="row-fluid">
    <div class="col-xs-12 col-md-12">

        <div class="row">
            <div class="col-xs-10 text-center"> <h4>{{$details->name_vale}}</h4></div>
            <div class="col-xs-2 text-right">  {{$empresa->name_empresa}}</div>
        </div>

        <div class="row">
            <div class="col-md-6"> Departamento: {{$departamento}}</div>
            <div class="col-md-offset-3 col-md-3 text-left"> Fecha: {{$details->date_vale}} </div>
            </div>
        <div class="row">
            <div class="col-md-6"> Nombre Solicitante: {{$nombreuser}}</div>
        </div>
<hr>
        <div class="row">
                <div class="col-md-12">
                        <table class="table tab-content">
                            <thead>
                                <th>codigo </th>
                                <th>Nombre </th>
                                <th>Stock </th>
                                <th>Cantidad pedida</th>
                                <th>Monto total</th>
                            </thead>

                            <tbody>
                            @foreach($details->details_product as $detail)
                                <tr>
                                    <th>{{$detail->id}}</th>
                                    <th>{{$detail->name_product}}</th>
                                    <th>{{$detail->stock_product}}</th>
                                    <th>{{$detail->pivot->cantidad}}</th>
                                    <th>{{$detail->pivot->precio}}</th>
                                </tr>
                              @endforeach
                            </tbody>
                        </table>
                </div>
        </div>


        </div>
    </div>
</div>