@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Usuarios</div>

                    @if(Session::has('message'))


                        <p class="alert alert-success">{{ Session::get('message')  }}</p>
                    @endif

                    <div class="panel-body">
                        {{ Form:: open(['route' => ['approver.approver.update',Session::get('id')],'method' => 'PUT' ] ) }}
                        <input type="hidden" name="nombreapprover" id="nombreapprover" value="  {{ Auth::user()->full_name }}">
                        <button type="submit" class="btn btn-success">Aprobar Solicitud</button>
                        {{Form::close()}}


                        @include("approver.partials.fields")





                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ Form::open(['route'=> ['admin.users.destroy',':USER_ID'],'method' => 'DELETE','id' => 'form-delete']) }}



    {{Form::close()}}




@endsection