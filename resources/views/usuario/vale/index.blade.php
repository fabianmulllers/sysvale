@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"> Vale de consumo</h1>
            </div>
            <div class="row">
                <div id="paneles" class="col-md-12 ">

                      @include("usuario.vale.partials.paneles")

                </div>
            </div>
        </div>
    </div>
@include('usuario.vale.partials.fields')
@include('usuario.vale.partials.mensajes')
<input id="update_paneles" style="display: none" value="{{route("user.vales.valeingresados")}}">
<input id="route_editar" style="display: none" value="{{route('user.vales.edit','id')}}">
<input id="route_notificacion" style="display: none" value="{{route("user.vales.vernotificacion")}}">
    {{ Form::open(['route'=> ['user.vales.destroy',':VALE_ID'],'method' => 'DELETE','id' => 'form-delete']) }}

    {{Form::close()}}
    {{ Form:: open(['route' => ['user.vales.update',':VALE_ID'],'method' => 'PUT','id'=>'form_edit' ] ) }}
    {{Form::close()}}

@endsection




