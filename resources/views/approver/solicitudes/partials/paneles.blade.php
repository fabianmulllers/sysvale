

<div class="row">
    <!-- col-lg4-->
<?php $i = 1?>
    @foreach($vales as $vale )


    <div id="div_{{$vale->id}}" class="col-lg-4">
        <div class="panel ">
            <div class="panel-heading " style="background-color: #66cd00; color: #fff ">

                <div class="row">
                    <div class="col-xs-6">
                        <i class="fa fa-location-arrow fa-2x " aria-hidden="true"></i> <strong>{{$vale->name_departamento}}</strong>
                    </div>
                    <div class="col-xs-6 text-right">
                        <a class="btn  btn-circle"  style="background-color:#008b8b" onclick="viewsolicitud({{$vale->pivot->id}})"><i class="fa fa-wpforms fa-2x"  style="color:#fff" aria-hidden="true"></i></a>
                    </div>
                </div>


            </div>
            <div class="panel-body">
                <p><strong>Nombre Vale : </strong> {{$vale->pivot->name_vale}}</p>
                <p><strong>Solicitante : </strong>{{$vale->name}}  {{$vale->last_name}}</p>
                <p><strong>Total producto : </strong>{{$vale->pivot->total_product}}</p>

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
                     <?php $i++?>
                @endif
    @endforeach

<div class="row col-md-12">
    <p> Hay la cantidad de {{ $vales->lastpage() }} con un total de registros {{$vales->total()}}</p>
    {!! $vales->render() !!}
</div>