@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Solicitudes Vale Consumo</h1>
            </div>
            <div class="row">
                <div id="paneles" class="col-md-12 ">

                      @include("approver.solicitudes.partials.paneles")

                </div>
            </div>
        </div>
    </div>

<div id="view-modal">

</div>

<input id="update_paneles" style="display: none" value="{{route("approver.approver.updatepaneles")}}">
<input id="route_show" style="display: none" value="{{route('approver.approver.show','id')}}">
<input id="route_desbloqueo" style="display: none" value="{{route("approver.approver.desbloquear",'id')}}">
 <input id="route_aprobarvale"  style="display: none" value="{{route('approver.approver.aprobarvale')}}">

    <!-- borrar-->
    {{ Form::open(['route'=> ['user.vales.destroy',':VALE_ID'],'method' => 'DELETE','id' => 'form-delete']) }}

    {{Form::close()}}
    <!-- editar -->
    {{ Form:: open(['route' => ['user.vales.update',':VALE_ID'],'method' => 'PUT','id'=>'form_edit' ] ) }}
    {{Form::close()}}
    @include('approver.solicitudes.partials.mensajes')

@endsection

@section('script')



@endsection



