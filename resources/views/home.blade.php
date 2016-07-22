@extends('layouts.app')

@section('content')

    <?php
            $header ='';
    switch(Auth::user()->type){

        case 'admin':
            $header="Tablero Administracion";
            break;
        case 'user':

            $header="Tablero Usuario";
            break;
        case 'approver':

            $header="Tablero Aprobador";
            break;

    } ?>
    <div class="row ">
        <div class="col-lg-12">
            <h1 class="page-header">{{$header}}</h1>
        </div>



                <div id="paneles-tablero" class="panel-body ">

                        @if(Auth::user()->type == 'admin')
                          @include('admin.partials.tablero')
                            @endif
                            @if(Auth::user()->type == 'user')
                                @include('usuario.partials.tablero')
                            @endif
                            @if(Auth::user()->type == 'approver')
                                @include('approver.partials.tablero')
                            @endif
                </div>


            </div>


@endsection

