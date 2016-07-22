
@extends('layouts.app')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-md-4 col-md-offset-4">
            <div class="login-panel panel panel-default">
                <div class="panel-heading">
                    <h3 class="panel-title">Por Favor Identificate</h3>
                </div>
                <div class="panel-body">
                    <form class="forml" role="form" method="POST" action="{{ url('/login') }}">
                        {{ csrf_field() }}
                        <fieldset>
                            <div class="form-group{{ $errors->has('email') ? ' has-error' : '' }}">

                                <input class="form-control" placeholder="Ingrese su correo" name="email" value="{{ old('email') }}" type="email" autofocus>

                                @if ($errors->has('email'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>


                            <div class="form-group{{ $errors->has('password') ? ' has-error' : '' }}">
                                <input class="form-control" placeholder="Password" name="password" type="password" value="">
                                @if ($errors->has('password'))
                                    <span class="help-block">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>

                            <!-- Change this to a button or input when using this as a form -->
                            <div class="form-group">
                                <div >
                                    <a class="btn btn-link" href="{{ url('/password/reset') }}">¿Olvidaste tu contraseña?</a>
                                    <button type="submit" class="btn btn-lg btn-info btn-block">
                                        <i class="fa fa-btn fa-sign-in"></i> Iniciar Sesión
                                    </button>


                                </div>
                            </div>
                        </fieldset>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
