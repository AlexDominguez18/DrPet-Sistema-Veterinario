@extends('layouts.sbadmin')
@section('content')

<script>
    document.title = "Usuarios | Dr. Pet"
</script>

<script src="{{asset('libs/jquery/jquery.min.js')}}"></script>
<link rel="stylesheet" type="text/css" href="{{ asset('libs/datatables/dataTables.bootstrap4.min.css') }}">

<div class="text-right">
    <a class="btn btn-primary btn-icon-split" href="{{ url('/user/create') }}">
        <span class="icon">
            <i class="fas fa-user-plus"></i>
        </span>
    <span class="text"> Registrar nuevo usuario</span>
</a>
</div> 

<div class="card-shadow mb-4">
    <div class="card-header py-3">
        <h3 class="m-0 font-weight-bold text-primary">Lista de usuarios</h3>
    </div>
<div class="card-body">
    <div class="table-responsive">
        <table id="table" class="table table-striped table-bordered" style="width:100%">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Tipo</th>
                    <th class="text-center">Acciones</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    @auth
                        @if ($user->admin === 0)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email}}</td>
                            @if ($user->admin === 1)
                            <td>Administrador</td>
                            @else
                            <td>Empleado</td>
                            @endif
                            <td class="text-center">
                                <!--Boton de editar-->
                                <a class="btn btn-circle btn-warning" href="{{ route('user.edit', $user) }}">
                                    <i class="fas fa-edit"></i>
                                </a>
                                <!--Boton de eliminar-->
                                <a class="btn btn-circle btn-danger" href="#" id="deleteUser" data-toggle="modal" data-target="#deleteUserModal{{ $user->id}}">
                                    <i class="fas fa-trash"></i>
                                </a>
                                <!-- Eliminar usuario Modal-->
                                <div class="modal fade" id="deleteUserModal{{ $user->id }}" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog" role="document">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="exampleModalLabel">¿Seguro que quiere eliminar a {{ $user->name }}?</h5>
                                                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">×</span>
                                                </button>
                                            </div>
                                            <div class="modal-body">Presione "Eliminar" para confirmar.
                                                @if(isset($user))
                                                    <form method="POST" action="{{ route('user.destroy',$user) }}">
                                                        @csrf
                                                        @method('DELETE')
                                                        <div class="modal-footer">
                                                            <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                                                            <button class="btn btn-secondary" type="submit">Eliminar</button>                     
                                                        </div>
                                                    </form>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @endif
                    @endauth
                @endforeach
            </tbody>
        </table>
    </div>
</div>
</div>

@endsection