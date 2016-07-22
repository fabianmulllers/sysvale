@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-5 col-md-offset-3">
                <div class="panel panel-default">
                    <div class="panel-heading">Editar usuario: {{$user->full_name}}</div>

                    <div class="panel-body">

                        @include('admin.partials.messages')

                        {{ Form:: model($user,['route' => ['admin.users.update',$user->id],'method' => 'PUT' ] ) }}

                        @include('admin.partials.fields')
                        <button type="submit" class="btn btn-warning">Actualizar usuario</button>
                        {{Form::close()}}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection