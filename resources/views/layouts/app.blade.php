<!DOCTYPE html>
<html lang="en" xmlns="http://www.w3.org/1999/html">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="token" id="token" value="{{ csrf_token() }}">

    <title>Laravel</title>

    <!-- Fonts -->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css" integrity="sha384-XdYbMnZ/QjLh6iI4ogqCTaIjrFk87ip+ekIjefZch0Y+PvJ8CDYtEs1ipDmPorQ+" crossorigin="anonymous">-->
    <!--<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Lato:100,300,400,700">-->

    <!-- Styles -->
    <!--<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">-->
    {{-- <link href="{{ elixir('css/app.css') }}" rel="stylesheet"> --}}
    <!--<link href="{{--asset('css/bootstrap.min.css') --}}" rel="stylesheet">-->
    <link href="{{asset("css/app.css")}}" rel="stylesheet">
    <link href="{{asset("css/all.css")}}" rel="stylesheet">
    <link href="{{asset("css/bootstrap-select.css")}}" rel="stylesheet">


    <style>
        body {
            font-family: 'Lato';
        }

        .fa-btn {
            margin-right: 6px;
        }
    </style>
</head>
<body id="app-layout">
<div id="overlay" class="overlay"></div>

@include('partials.navbar.navbar')


            <div @if (auth::check()) id="page-wrapper"  @else id="margin-top"    @endif>

                @yield('content')
                </div>

    <!-- JavaScripts -->
    <!--<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.3/jquery.min.js" integrity="sha384-I6F5OKECLVtK/BL+8iSLDEHowSAfUo76ZL9+kGAgTRdiByINKJaqTPH/QVNS1VDb" crossorigin="anonymous"></script>-->
  <!--  <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.6/js/bootstrap.min.js" integrity="sha384-0mSbJDEHialfmuBBQP6A4Qrprq5OVfW37PRR3j5ELqxss1yVqOtnepnHVP9aJ7xS" crossorigin="anonymous"></script>-->
<input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
<input type="hidden" id="notificationurl" value="{{route('user.vales.vernotificacion')}}">
<script src="{{ asset('js/jquery.js') }}" ></script>
     <script src="{{ asset('js/all.js') }}" ></script>
    <script src="{{asset('js/funciones.js')}}"></script>
     <script src="{{asset('js/bootstrap.js')}}"></script>
     <script src="{{asset("js/sb-admin-2.js")}}"></script>
     <script src="{{asset("js/enlaces.js")}}"></script>
     <script src="{{asset("js/eventos.js")}}"></script>
     <script src="{{asset("js/bootstrap-select.js")}}"></script>
     <script src="{{asset("js/mensajes.js")}}"></script>
     <script src="{{asset("js/aprobar.js")}}"></script>
     <script src="{{asset("js/appvue.js")}}"></script>
    {{-- <script src="{{asset("js/main.js")}}"></script>--}}

         {{-- <script src="{{ elixir('js/app.js') }}"></script> --}}

@yield('scripts')

<!--token-->
@if(auth::check())
    {{--<script>setInterval(vernotificacion, 3000);</script>--}}
@endif

</body>
</html>
