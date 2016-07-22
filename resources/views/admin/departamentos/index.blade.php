@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-lg-12">
                <h1 class="page-header">Tablero Departamento</h1>
            </div>
        <div class="row">
            <div id="paneles" class="col-md-12 ">

                    @include("admin.departamentos.partials.paneles")



                </div>

            </div>
        </div>
    </div>

    <!-- formulario -->
    {{ Form:: open(['route' => 'admin.departamentos.store' ,'method' => 'POST' ,'id'=>'form_create' ] ) }}
        @include("admin.departamentos.partials.fields")
    {{Form::close()}}

    {{ Form:: open(['route' => ['admin.departamentos.update',':DEPARTAMENTOS_ID'],'method' => 'PUT','id'=>'form_edit' ] ) }}
    @include("admin.departamentos.partials.fields")
    {{Form::close()}}

    {{ Form::open(['route'=> ['admin.departamentos.destroy',':DEPARTAMENTOS_ID'],'method' => 'DELETE','id' => 'form-delete']) }}
    {{Form::close()}}
<!-- fin formulario -->

    <!--rutas -->
    <input id="route_editar" style="display: none" value="{{route('admin.departamentos.edit','id')}}">
    <input id="update_paneles" style="display: none" value="{{route("admin.departamentos.updatepaneles")}}">
    <!--token--><input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
    <!-- -->

@endsection

 @include("admin.usuarios.partials.mensajes")
