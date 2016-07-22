@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row ">
            <div class="col-lg-12">
                <h1 class="page-header">Tablero Usuarios</h1>
            </div>
        <div class="row">
            <div id="paneles" class="col-md-12 ">

                    @include("admin.usuarios.partials.paneles")



                </div>

            </div>
        </div>
    </div>

    <!-- formulario -->
    {{ Form:: open(['route' => 'admin.users.store' ,'method' => 'POST' ,'id'=>'form_create' ] ) }}
        @include("admin.usuarios.partials.fields")
    {{Form::close()}}

    {{ Form:: open(['route' => ['admin.users.update',':USER_ID'],'method' => 'PUT','id'=>'form_edit' ] ) }}
    @include("admin.usuarios.partials.fields")
    {{Form::close()}}

    {{ Form::open(['route'=> ['admin.users.destroy',':USER_ID'],'method' => 'DELETE','id' => 'form-delete']) }}
    {{Form::close()}}
<!-- fin formulario -->

    <!--rutas -->
    <input id="route_editar" style="display: none" value="{{route('admin.users.edit','id')}}">
    <input id="update_paneles" style="display: none" value="{{route("admin.users.updatepaneles")}}">
    <input id="route_selecttype" style="display: none" value="{{route("admin.users.selecttype")}}">
    <!--token--><input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
    <!-- -->

@endsection

 @include("admin.usuarios.partials.mensajes")
