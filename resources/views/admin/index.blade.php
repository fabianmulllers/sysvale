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
                        <p>

                            <a class="btn btn-info" href="{{route('admin.users.create')}}" role="button">
                                Nuevo Usuario
                            </a>
                        </p>

                        @include("admin.partials.table")
                        <!-- Se incluye formulario editar-->
                             <div id="divedit" class="emergente" style="display: none">
                                 @include("admin.edit2")
                        </div>

                        <p>Hay la cantidad de {{ $users->lastpage() }} con un total de registros {{$users->total()}}</p>
                        {!! $users->render() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{ Form::open(['route'=> ['admin.users.destroy',':USER_ID'],'method' => 'DELETE','id' => 'form-delete']) }}



    {{Form::close()}}




@endsection


@section('scripts')

    <script >

        $(document).ready(function () {

            $('.btn-delete').click(function (e) {
                e.preventDefault();
                var row = $(this).parents('tr');
                var id = row.data('id');
                var form = $("#form-delete");
                var url =  form.attr('action').replace(':USER_ID',id);
                var data = form.serialize();


                $.post(url,data,function(result){
                    row.fadeOut();

                    alert(result.message);

                }).fail(function (){

                    alert("El usuario no fue eliminado");
                    row.show();
                });


            });

        });

        function editar(){

            $("#overlay").show();
            $("#divedit").show();
            var id = 2;
            var url= $("#encuentrame").val();
            $.ajax({
                data: id,
                url: url,
                type: 'get',
                beforeSend: function () {
                    //$("#contador").html("<img class='img-responsive center-block' SRC='../img/cargando.gif'>");
                },
                success: function (response) {
                    $("#name").val(response.name);
                    $("#last_name").val(response.last_name);
                    $( "#head" ).replaceWith( response.name );

                    //          $('#detallemodal').modal('show');
                }
            });
        }

        function actualizame() {

            var link = $("#actualizame").val();
            var token = $("#_token").val();
            var name = $("#name").val();
            var last_name = $("#last_name").val();
            var email = $("#email").val();
            var password = $("#password").val();
            var type = $("#type").val()

            var parametros = {

                "id": 2,
                "_token": token,
                "name" : name,
                "last_name" : last_name,
                "email" : email,
                "password" : password,
                "type":type,
            };


            $.ajax({


                data: parametros,
                url: link,

                type: 'PUT',
                beforeSend: function () {
                    //$("#contador").html("<img class='img-responsive center-block' SRC='../img/cargando.gif'>");
                },
                success: function (response) {


                },
                    error: function(response){
                        var errors = response.responseJSON;;
                        $.each(errors , function(index,value){
                            $("#diverror_"+index).addClass("has-error")

                            $("#error_"+index).show().html("<strong>"+value+"</strong>");
                        });
                    },

            });
        }

    </script>


@endsection