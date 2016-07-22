



                        {{ Form:: open(['route' => ['admin.users.update',2],'method' => 'PUT','class'=>'form-horizontal','style'] ) }}

                        @include('admin.partials.fields')
                        <button type="submit" class="btn btn-warning">Actualizar usuario</button>
                        <a onclick="actualizame()">actualizame </a>
                        {{Form::close()}}