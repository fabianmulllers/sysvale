@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-lg-12">
                <h1 class="page-header">Tablero Empresas</h1>
            </div>
        <div class="row">
            <div id="paneles" class="col-md-12 ">

                    @include("admin.empresas.partials.paneles")



                </div>

            </div>
        </div>
    </div>

    <!-- formulario -->
    {{ Form:: open(['route' => 'admin.empresas.store' ,'method' => 'POST' ,'id'=>'form_create' ] ) }}
        @include("admin.empresas.partials.fields")
    {{Form::close()}}

    {{ Form:: open(['route' => ['admin.empresas.update',':EMPRESAS_ID'],'method' => 'PUT','id'=>'form_edit' ] ) }}
    {{Form::close()}}

    {{ Form::open(['route'=> ['admin.empresas.destroy',':EMPRESAS_ID'],'method' => 'DELETE','id' => 'form-delete']) }}
    {{Form::close()}}
<!-- fin formulario -->

    <!--rutas -->
    <input id="route_editar" style="display: none" value="{{route('admin.empresas.edit','id')}}">
    <input id="update_paneles" style="display: none" value="{{route("admin.empresas.updatepaneles")}}">
    <!--token--><input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
    <!-- -->

@endsection

 @include("admin.empresas.partials.mensajes")
