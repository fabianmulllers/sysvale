<table class="table table-striped">
    <tr>
        <th>#</th>
        <th>nombre</th>
        <th>email</th>
        <th>privilegio</th>
        <th> </th>
    </tr>
    @foreach($users as $user)
        <tr data-id="{{ $user->id }}">
        <td>{{ $user->id }}</td>
        <td> {{ $user->fullname }}</td>
        <td>{{$user->email}}</td>
        <td>{{$user->type}}</td>
        <td>

            <a href="{{route('admin.users.edit',$user->id)}}">Editar</a>
            <a onclick="editar()" > editame</a>
            <a href="#" class="btn btn-delete">Eliminar</a>
        </td>

        </tr>
    @endforeach
    <input id="encuentrame"  value="{{route('admin.users.edit',2)}}">
    <input id="actualizame" value="{{route('admin.users.update','id')}}"  >
    <input type="hidden" name="_token" id="_token" value="{{ csrf_token() }}">
</table>

