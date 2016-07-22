@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-10 col-md-offset-1">
                <div class="panel panel-default">
                    <div class="panel-heading">Aprovador</div>

                    @if(Session::has('message'))


                        <p class="alert alert-success">{{ Session::get('message')  }}</p>
                    @endif

                    <div class="panel-body">

                        @include("approver.partials.table")


                    </div>
                </div>
            </div>
        </div>
    </div>





@endsection