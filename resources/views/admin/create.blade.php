@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Usuarios</div>

                    <div class="panel-body">

                        @include('admin.partials.messages')


                        {{ Form:: open(['route' => 'admin.users.store' ,'method' => 'POST' ] ) }}
                        @include('admin.partials.fields')
                        <button type="submit" class="btn btn-warning">Crear usuario</button>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
